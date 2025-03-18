<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehicleController;

Route::apiResource('vehicles', VehicleController::class);
