<?php

use App\Models\SensorData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sensor-data', function (Request $request) {
    try {
        $resolvedUserId = null;

        if ($request->filled('user_id')) {
            $resolvedUserId = User::query()->whereKey($request->user_id)->value('id');
        } elseif ($request->filled('username')) {
            $identity = strtolower((string) $request->username);
            $resolvedUserId = User::query()
                ->where('role', 'warga')
                ->where(function ($query) use ($identity) {
                    $query->whereRaw('LOWER(username) = ?', [$identity])
                        ->orWhereRaw('LOWER(name) = ?', [$identity]);
                })
                ->value('id');
        }

        if (! $resolvedUserId) {
            $resolvedUserId = User::query()->where('role', 'warga')->value('id');
        }

        $data = new SensorData();
        $data->user_id = $resolvedUserId;
        $data->temperature = $request->temperature;
        $data->ph = $request->ph;
        $data->ntu = $request->ntu;
        $data->fuzzy = $request->fuzzy;
        $data->relay_status = $request->relay_status;
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Data from ESP32 saved successfully'
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::get('/latest-sensor-data', function (Request $request) {
    $query = SensorData::query();

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    } elseif ($request->filled('username')) {
        $identity = strtolower((string) $request->username);
        $residentId = User::query()
            ->where('role', 'warga')
            ->where(function ($userQuery) use ($identity) {
                $userQuery->whereRaw('LOWER(username) = ?', [$identity])
                    ->orWhereRaw('LOWER(name) = ?', [$identity]);
            })
            ->value('id');

        if ($residentId) {
            $query->where('user_id', $residentId);
        } else {
            $query->whereRaw('1 = 0');
        }
    }

    $latestData = $query->latest()->first();
    
    if ($latestData) {
        $history = SensorData::query()
            ->where('user_id', $latestData->user_id)
            ->orderBy('created_at', 'asc')
            ->get(['ph', 'ntu', 'relay_status']);
        
        $relayCount = 0;
        $amanCount = 0;
        $tidakAmanCount = 0;
        
        $lastStatus = null;
        $lastQualityState = null;
        
        foreach ($history as $row) {
            $currentStatus = (int)$row->relay_status;
            if ($lastStatus !== null && $lastStatus === 0 && $currentStatus === 1) {
                $relayCount++;
            }
            $lastStatus = $currentStatus;

            $phVal = $row->ph !== null ? (float)$row->ph : null;
            $ntuVal = $row->ntu !== null ? (float)$row->ntu : null;

            if ($phVal !== null && $ntuVal !== null) {
                $isAman = ($phVal >= 6.5 && $phVal <= 8.5 && $ntuVal <= 5);
                $currentQualityState = $isAman ? 'aman' : 'tidak_aman';

                if ($lastQualityState !== null) {
                    if ($lastQualityState === 'tidak_aman' && $currentQualityState === 'aman') {
                        $amanCount++;
                    } elseif ($lastQualityState === 'aman' && $currentQualityState === 'tidak_aman') {
                        $tidakAmanCount++;
                    }
                } else {
                    if ($currentQualityState === 'aman') {
                        $amanCount = 1;
                    } else {
                        $tidakAmanCount = 1;
                    }
                }
                $lastQualityState = $currentQualityState;
            }
        }
        if ($history->isNotEmpty() && (int)$history->first()->relay_status === 1) {
            $relayCount = max(1, $relayCount);
        }
        
        $latestDataArray = $latestData->toArray();
        $latestDataArray['created_at'] = $latestData->created_at->setTimezone('Asia/Makassar')->toDateTimeString();
        $latestDataArray['relay_count'] = $relayCount;
        $latestDataArray['aman_count'] = $amanCount;
        $latestDataArray['tidak_aman_count'] = $tidakAmanCount;
        return response()->json($latestDataArray);
    }
    
    return response()->json(null);
});

Route::get('/sensor-history', function (Request $request) {
    $query = SensorData::query();
    $limit = min((int) ($request->query('limit', 20)), 50);

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    } elseif ($request->filled('username')) {
        $identity = strtolower((string) $request->username);
        $residentId = User::query()
            ->where('role', 'warga')
            ->where(function ($userQuery) use ($identity) {
                $userQuery->whereRaw('LOWER(username) = ?', [$identity])
                    ->orWhereRaw('LOWER(name) = ?', [$identity]);
            })
            ->value('id');

        if ($residentId) {
            $query->where('user_id', $residentId);
        } else {
            $query->whereRaw('1 = 0');
        }
    }

    $records = $query->latest()->take($limit)->get();
    // Convert timestamps to Asia/Makassar timezone
    $records->transform(function ($record) {
        $record->created_at = $record->created_at->setTimezone('Asia/Makassar');
        return $record;
    });
    if ($records->isNotEmpty()) {
        $firstRecord = $records->first();
        $history = SensorData::query()
            ->where('user_id', $firstRecord->user_id)
            ->orderBy('created_at', 'asc')
            ->get(['ph', 'ntu', 'relay_status']);
        
        $relayCount = 0;
        $amanCount = 0;
        $tidakAmanCount = 0;
        
        $lastStatus = null;
        $lastQualityState = null;
        
        foreach ($history as $row) {
            $currentStatus = (int)$row->relay_status;
            if ($lastStatus !== null && $lastStatus === 0 && $currentStatus === 1) {
                $relayCount++;
            }
            $lastStatus = $currentStatus;

            $phVal = $row->ph !== null ? (float)$row->ph : null;
            $ntuVal = $row->ntu !== null ? (float)$row->ntu : null;

            if ($phVal !== null && $ntuVal !== null) {
                $isAman = ($phVal >= 6.5 && $phVal <= 8.5 && $ntuVal <= 5);
                $currentQualityState = $isAman ? 'aman' : 'tidak_aman';

                if ($lastQualityState !== null) {
                    if ($lastQualityState === 'tidak_aman' && $currentQualityState === 'aman') {
                        $amanCount++;
                    } elseif ($lastQualityState === 'aman' && $currentQualityState === 'tidak_aman') {
                        $tidakAmanCount++;
                    }
                } else {
                    if ($currentQualityState === 'aman') {
                        $amanCount = 1;
                    } else {
                        $tidakAmanCount = 1;
                    }
                }
                $lastQualityState = $currentQualityState;
            }
        }
        if ($history->isNotEmpty() && (int)$history->first()->relay_status === 1) {
            $relayCount = max(1, $relayCount);
        }
        
        $records[0]->relay_count = $relayCount;
        $records[0]->aman_count = $amanCount;
        $records[0]->tidak_aman_count = $tidakAmanCount;
    }
    return response()->json($records);
});

Route::get('/chart-data', function (Request $request) {
    $query = SensorData::query();
    
    if ($request->filled('username')) {
        $identity = strtolower((string) $request->username);
        $residentId = User::query()
            ->where('role', 'warga')
            ->where(function ($userQuery) use ($identity) {
                $userQuery->whereRaw('LOWER(username) = ?', [$identity])
                    ->orWhereRaw('LOWER(name) = ?', [$identity]);
            })
            ->value('id');

        if ($residentId) {
            $query->where('user_id', $residentId);
        } else {
            $query->whereRaw('1 = 0');
        }
    }

    $range = $request->query('range', '24h');
    $query->whereNotNull('ph');

    $timeQuery = clone $query;

    if ($range === '24h') {
        $timeQuery->where('created_at', '>=', now()->subDay());
    } elseif ($range === '7d') {
        $timeQuery->where('created_at', '>=', now()->subDays(7));
    } elseif ($range === '30d') {
        $timeQuery->where('created_at', '>=', now()->subDays(30));
    }

    $records = $timeQuery->orderBy('created_at', 'asc')->get(['ph', 'ntu', 'temperature', 'relay_status', 'created_at']);
    
    // Fallback if empty
    if ($records->isEmpty()) {
        $limit = $range === '24h' ? 24 : ($range === '7d' ? 28 : 30);
        $records = $query->latest()->take($limit)->get(['ph', 'ntu', 'temperature', 'relay_status', 'created_at'])->reverse()->values();
    }

    $labels = $records->map(fn($r) => $r->created_at->setTimezone('Asia/Makassar')->format('d M H:i'));
    $phData = $records->map(fn($r) => round((float) $r->ph, 2));
    $ntuData = $records->map(fn($r) => round((float) $r->ntu, 2));
    $tempData = $records->map(fn($r) => round((float) $r->temperature, 2));
    $relayData = $records->map(fn($r) => (int) $r->relay_status);

    return response()->json([
        'labels' => $labels,
        'ph_data' => $phData,
        'ntu_data' => $ntuData,
        'temp_data' => $tempData,
        'relay_data' => $relayData
    ]);
});
