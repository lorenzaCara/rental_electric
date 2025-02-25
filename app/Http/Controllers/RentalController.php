<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rentals = DB::table('rentals')->get();
        return view('layouts.rentals.index', ['rentals' => $rentals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $vehicles = DB::table('vehicles')->get();
        $customers = DB::table('customers')->get();
        return view('layouts.rentals.create', ['vehicles' => $vehicles, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'vehicle_id' => 'required',
            'customer_id' => 'required',
            'start_time' => 'required',
            'total_cost' => 'required',
            'status' => 'required',
        ]);
        DB::table('rentals')->insert([
            'vehicle_id' => $request->vehicle_id,
            'customer_id' => $request->customer_id,
            'start_time' => $request->start_time,
            'total_cost' => $request->total_cost,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('rentals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
