<?php

use App\Models\SensorData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sensor-data', function (Request $request) {
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

    if (! $resolvedUserId && User::query()->where('role', 'warga')->count() === 1) {
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
    return response()->json($latestData);
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

    $records = $timeQuery->orderBy('created_at', 'asc')->get(['ph', 'created_at']);
    
    // Fallback if empty
    if ($records->isEmpty()) {
        $limit = $range === '24h' ? 24 : ($range === '7d' ? 28 : 30);
        $records = $query->latest()->take($limit)->get(['ph', 'created_at'])->reverse()->values();
    }

    $labels = $records->map(fn($r) => $r->created_at->format('d M H:i'));
    $data = $records->map(fn($r) => round((float) $r->ph, 2));

    return response()->json([
        'labels' => $labels,
        'data' => $data
    ]);
});
