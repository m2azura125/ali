<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sensor-data', function (Request $request) {
    $data = new \App\Models\SensorData();
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

Route::get('/latest-sensor-data', function () {
    $latestData = \App\Models\SensorData::latest()->first();
    return response()->json($latestData);
});
