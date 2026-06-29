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
        $history = SensorData::where('user_id', $resident->id)->orderBy('created_at')->get(['relay_status']);
        $lastStatus = null;
        foreach ($history as $row) {
            $currentStatus = (int)$row->relay_status;
            if ($lastStatus !== null && $lastStatus === 0 && $currentStatus === 1) {
                $relayCount++;
            }
            $lastStatus = $currentStatus;
        }
        if ($history->isNotEmpty() && (int)$history->first()->relay_status === 1) {
            $relayCount = max(1, $relayCount);
        }

        return view('resident.dashboard', [
            'latestData' => $latestData,
            'sensorUsername' => $resident->username,
            'relayCount' => $relayCount,
        ]);
    });

    Route::get('/admin', function () {
        $residents = User::where('role', 'warga')->get();
        foreach ($residents as $resident) {
            $resident->latestData = SensorData::where('user_id', $resident->id)->latest()->first();
        }
        return view('admin.dashboard', compact('residents'));
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
        if ($selectedResident) {
            $relayHistory = SensorData::where('user_id', $selectedResident->id)->orderBy('created_at')->get(['relay_status']);
            $lastStatus = null;
            foreach ($relayHistory as $row) {
                $currentStatus = (int)$row->relay_status;
                if ($lastStatus !== null && $lastStatus === 0 && $currentStatus === 1) {
                    $relayCount++;
                }
                $lastStatus = $currentStatus;
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
            'relayCount'
        ));
    });

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    });
});
