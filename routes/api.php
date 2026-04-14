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
