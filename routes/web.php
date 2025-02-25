<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.homepage');
})->name('homepage');


Route::resource('vehicles', VehicleController::class);

Route::resource('customers', CustomerController::class)->except('edit', 'update', 'destroy');

Route::resource('rentals', RentalController::class)->except('show', 'edit', 'update', 'destroy');

Route::get('/complete/{id}', function ($id) {
    $rental = DB::table('rentals')->find($id);
    return view('layouts.rentals.complete', ['rental' => $rental]);
})->name('rentals.complete');

Route::post('/complete/{id}', function ($id) {
    $validated = request()->validate([
        'end_time' => 'required',
        'status' => 'required',
    ]);
    DB::table('rentals')->where('id', $id)->update([
        'end_time' => request()->end_time,
        'status' => request()->status,
        'updated_at' => now(),
    ]);
    return redirect()->route('rentals.index');
})->name('rentals.complete.store');
