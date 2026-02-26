<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/resident', function () {
        $latestData = \App\Models\SensorData::latest()->first();
        return view('resident.dashboard', compact('latestData'));
    });

    Route::get('/admin', function () {
        $latestData = \App\Models\SensorData::latest()->first();
        return view('admin.dashboard', compact('latestData'));
    });

    Route::get('/admin/house/{id}', function ($id) {
        $latestData = \App\Models\SensorData::latest()->first();
        return view('admin.house', compact('id', 'latestData'));
    });

    Route::get('/admin/settings', function () {
        return view('admin.settings');
    });
});
