<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $vehicles = DB::table('vehicles')->get();
        $vehicles = Vehicle::all();
        return view('layouts.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.vehicles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'model' => 'required',
            'type' => 'required',
            'battery_capacity' => 'required',
            'status' => 'required',
            'hourly_rate' => 'required',
        ]);
        DB::table('vehicles')->insert([
            'model' => $request->model,
            'type' => $request->type,
            'battery_capacity' => $request->battery_capacity,
            'status' => $request->status,
            'hourly_rate' => $request->hourly_rate,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $vehicle = DB::table('vehicles')->find($id);
        $vehicle = Vehicle::find($id);
        return view('layouts.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $vehicle = DB::table('vehicles')->find($id);
        return view('layouts.vehicles.edit', ['vehicle' => $vehicle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'model' => ['required', 'string'],
            'type' => ['required', Rule::in(['car', 'scooter', 'bike'])],
            'battery_capacity' => ['required', 'integer'],
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
            'hourly_rate' => ['required', 'decimal:2'],
        ]);

        $vehicle = new Vehicle();
        $vehicle->model = $request->model;
        $vehicle->type = $request->type;
        $vehicle->battery_capacity = $request->battery_capacity;
        $vehicle->status = $request->status;
        $vehicle->hourly_rate = $request->hourly_rate;
        $vehicle->save();

        return redirect()->route('vehicles.show', ['vehicle' => $id]);
        // DB::table('vehicles')->where('id', $id)->update([
        //     'model' => $request->model,
        //     'type' => $request->type,
        //     'battery_capacity' => $request->battery_capacity,
        //     'status' => $request->status,
        //     'hourly_rate' => $request->hourly_rate,
        //     'updated_at' => now(),
        // ]);
        // return redirect()->route('vehicles.show', ['vehicle' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
