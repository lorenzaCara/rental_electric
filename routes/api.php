<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehicleController;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', 'user');
        Route::post('/logout', 'logout');
        Route::post('/logout-all', 'logoutAll');
        Route::get('/tokens', 'tokens');
    });
});


Route::apiResource('vehicles', VehicleController::class)->middleware('auth:sanctum');
