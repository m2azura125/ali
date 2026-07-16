<?php

use App\Models\SensorData;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('set-locale');

Route::middleware('auth')->group(function () {
    Route::get('/resident', function () {
        $resident = auth()->user();
        $latestData = SensorData::query()
            ->where('user_id', $resident->id)
            ->latest()
            ->first();

        $relayCount = 0;
        $safeCount = 0;
        $unsafeCount = 0;

        $history = SensorData::where('user_id', $resident->id)->orderBy('created_at')->get(['ph', 'ntu', 'relay_status']);
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
                        $safeCount++;
                    } elseif ($lastQualityState === 'aman' && $currentQualityState === 'tidak_aman') {
                        $unsafeCount++;
                    }
                } else {
                    if ($currentQualityState === 'aman') {
                        $safeCount = 1;
                    } else {
                        $unsafeCount = 1;
                    }
                }
                $lastQualityState = $currentQualityState;
            }
        }
        if ($history->isNotEmpty() && (int)$history->first()->relay_status === 1) {
            $relayCount = max(1, $relayCount);
        }

        return view('resident.dashboard', [
            'latestData' => $latestData,
            'sensorUsername' => $resident->username,
            'relayCount' => $relayCount,
            'safeCount' => $safeCount,
            'unsafeCount' => $unsafeCount,
        ]);
    });

    Route::get('/admin', function () {
        $residents = User::where('role', 'warga')->get();
        foreach ($residents as $resident) {
            $resident->latestData = SensorData::where('user_id', $resident->id)->latest()->first();
        }
        return view('admin.dashboard', compact('residents'));
    });

    Route::post('/admin/residents', function (Request $request) {
        if (auth()->user()->role !== 'rt') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username',
            'pin' => 'required|string|min:4|max:20',
        ]);

        $resident = User::create([
            'name' => $validated['name'],
            'username' => strtolower($validated['username']),
            'role' => 'warga',
            'password' => $validated['pin'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Warga '{$resident->name}' berhasil ditambahkan.",
            'resident' => $resident->only(['id', 'name', 'username']),
        ]);
    });

    Route::get('/admin/house/{id}', function (Request $request, $id) {
        $selectedResident = User::query()
            ->where('role', 'warga')
            ->where(function ($query) use ($id) {
                $identity = strtolower((string) $id);
                $query->whereRaw('LOWER(username) = ?', [$identity])
                    ->orWhereRaw('LOWER(name) = ?', [$identity]);
            })
            ->first();

        $residentSensorQuery = SensorData::query();

        if ($selectedResident) {
            $residentSensorQuery->where('user_id', $selectedResident->id);
        } else {
            $residentSensorQuery->whereRaw('1 = 0');
        }

        $latestData = (clone $residentSensorQuery)->latest()->first();

        $relayCount = 0;
        $safeCount = 0;
        $unsafeCount = 0;
        if ($selectedResident) {
            $relayHistory = SensorData::where('user_id', $selectedResident->id)->orderBy('created_at')->get(['ph', 'ntu', 'relay_status']);
            $lastStatus = null;
            $lastQualityState = null;
            foreach ($relayHistory as $row) {
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
                            $safeCount++;
                        } elseif ($lastQualityState === 'aman' && $currentQualityState === 'tidak_aman') {
                            $unsafeCount++;
                        }
                    } else {
                        if ($currentQualityState === 'aman') {
                            $safeCount = 1;
                        } else {
                            $unsafeCount = 1;
                        }
                    }
                    $lastQualityState = $currentQualityState;
                }
            }
            if ($relayHistory->isNotEmpty() && (int)$relayHistory->first()->relay_status === 1) {
                $relayCount = max(1, $relayCount);
            }
        }

        $range = $request->query('range', '24h');
        $rangeOptions = [
            '24h' => ['label' => '24 Jam', 'fallback_limit' => 24],
            '7d' => ['label' => '7 Hari', 'fallback_limit' => 28],
            '30d' => ['label' => '30 Hari', 'fallback_limit' => 30],
        ];

        if (! isset($rangeOptions[$range])) {
            $range = '24h';
        }

        $historyQuery = (clone $residentSensorQuery)->whereNotNull('ph');

        if ($range === '24h') {
            $historyQuery->where('created_at', '>=', now()->subDay());
        } elseif ($range === '7d') {
            $historyQuery->where('created_at', '>=', now()->subDays(7));
        } else {
            $historyQuery->where('created_at', '>=', now()->subDays(30));
        }

        $sensorHistory = $historyQuery
            ->orderBy('created_at')
            ->get(['ph', 'ntu', 'created_at']);

        if ($sensorHistory->isEmpty()) {
            $sensorHistory = (clone $residentSensorQuery)
                ->whereNotNull('ph')
                ->latest()
                ->take($rangeOptions[$range]['fallback_limit'])
                ->get(['ph', 'ntu', 'created_at'])
                ->reverse()
                ->values();
        }

        $chartWidth = 800;
        $chartHeight = 300;
        $chartTopPadding = 18;
        $chartBottomPadding = 34;
        $chartDrawableHeight = $chartHeight - $chartTopPadding - $chartBottomPadding;
        $phValues = $sensorHistory->pluck('ph')->map(fn ($value) => (float) $value)->values();
        $hasChartData = $phValues->isNotEmpty();

        if ($hasChartData) {
            $rawMin = $phValues->min();
            $rawMax = $phValues->max();
            $spread = max($rawMax - $rawMin, 0.4);
            $padding = max($spread * 0.2, 0.2);
            $chartMin = max(0, floor(($rawMin - $padding) * 10) / 10);
            $chartMax = min(14, ceil(($rawMax + $padding) * 10) / 10);

            if ($chartMax <= $chartMin) {
                $chartMax = min(14, $chartMin + 1);
            }
        } else {
            $chartMin = 0;
            $chartMax = 14;
        }

        $pointCount = $sensorHistory->count();
        $chartPoints = $sensorHistory->values()->map(function ($item, $index) use (
            $pointCount,
            $chartWidth,
            $chartHeight,
            $chartTopPadding,
            $chartBottomPadding,
            $chartDrawableHeight,
            $chartMin,
            $chartMax
        ) {
            $x = $pointCount === 1
                ? $chartWidth / 2
                : ($index / max($pointCount - 1, 1)) * $chartWidth;
            $normalized = ((float) $item->ph - $chartMin) / max($chartMax - $chartMin, 0.1);
            $y = ($chartHeight - $chartBottomPadding) - ($normalized * $chartDrawableHeight);

            return [
                'x' => round($x, 2),
                'y' => round($y, 2),
                'ph' => round((float) $item->ph, 2),
                'ntu' => $item->ntu !== null ? round((float) $item->ntu, 2) : null,
                'time' => optional($item->created_at)->format('H:i'),
                'timestamp' => optional($item->created_at)->format('d M Y H:i'),
            ];
        });

        $linePath = null;
        $areaPath = null;
        $latestPoint = null;

        if ($chartPoints->isNotEmpty()) {
            $linePath = $chartPoints->map(
                fn ($point, $index) => ($index === 0 ? 'M' : 'L').$point['x'].','.$point['y']
            )->implode(' ');

            $firstPoint = $chartPoints->first();
            $lastPoint = $chartPoints->last();
            $baseline = $chartHeight - $chartBottomPadding;

            $areaPath = $linePath
                .' L'.$lastPoint['x'].','.$baseline
                .' L'.$firstPoint['x'].','.$baseline
                .' Z';

            $latestPoint = $lastPoint;
        }

        $yLabels = collect(range(0, 4))->map(function ($step) use ($chartMin, $chartMax) {
            $value = $chartMax - (($chartMax - $chartMin) * ($step / 4));
            return number_format($value, 1);
        });

        $xLabels = collect(range(0, 4))->map(function ($step) use ($sensorHistory) {
            if ($sensorHistory->isEmpty()) {
                return '';
            }

            $index = $sensorHistory->count() === 1
                ? 0
                : (int) round(($step / 4) * ($sensorHistory->count() - 1));

            return optional($sensorHistory->values()->get($index)->created_at)->format('H:i');
        });

        return view('admin.house', compact(
            'id',
            'selectedResident',
            'latestData',
            'range',
            'rangeOptions',
            'sensorHistory',
            'hasChartData',
            'chartPoints',
            'linePath',
            'areaPath',
            'latestPoint',
            'yLabels',
            'xLabels',
            'relayCount',
            'safeCount',
            'unsafeCount'
        ));
    });

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    });

    Route::post('/admin/clear-data', function (Request $request) {
        // Only allow RT (admin) role
        if (auth()->user()->role !== 'rt') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $query = SensorData::query();

        // Filter by username if provided
        if ($request->filled('username') && $request->username !== 'all') {
            $identity = strtolower((string) $request->username);
            $residentId = User::query()
                ->where('role', 'warga')
                ->where(function ($q) use ($identity) {
                    $q->whereRaw('LOWER(username) = ?', [$identity])
                      ->orWhereRaw('LOWER(name) = ?', [$identity]);
                })
                ->value('id');

            if ($residentId) {
                $query->where('user_id', $residentId);
            } else {
                return response()->json(['success' => false, 'message' => 'Warga tidak ditemukan'], 404);
            }
        }

        // Filter by date range if provided
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        $deletedCount = $query->count();
        $query->delete();

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus {$deletedCount} data sensor.",
            'deleted_count' => $deletedCount,
        ]);
    });
});
