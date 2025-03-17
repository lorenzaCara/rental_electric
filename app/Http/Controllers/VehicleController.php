<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Tag;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
                $newVehicles = Vehicle::whereRelation('tags', 'name', 'New')->get();

                $vehicles = Vehicle::whereDoesntHave('tags', function (Builder $query) {
                        $query->where('name', 'New');
                })->get();

                return view('pages.vehicles.index', ['vehicles' => $vehicles, 'newVehicles' => $newVehicles]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
                $tags = Tag::all();
                return view('pages.vehicles.create', compact('tags'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreVehicleRequest $request)
        {

                // DB::table('vehicles')->insert([
                //     'model' => $request->model,
                //     'type' => $request->type,
                //     'battery_capacity' => $request->battery_capacity,
                //     'status' => $request->status,
                //     'hourly_rate' => $request->hourly_rate,
                //     'created_at' => now(),
                //     'updated_at' => now(),
                // ]);

                // $vehicle = new Vehicle();

                // $vehicle->model = $request->model;
                // $vehicle->type = $request->type;
                // $vehicle->battery_capacity = $request->battery_capacity;
                // $vehicle->status = $request->status;
                // $vehicle->hourly_rate = $request->hourly_rate;

                // // salvo il nuovo record sul db
                // $vehicle->save();

                // creo il record sul database relativo al veicolo
                $vehicle = Vehicle::create($request->all());

                // assegno i tags al veicolo creando un record nella pivot table tag_vehicle
                $vehicle->tags()->attach($request->tags, [
                        'created_at' => now(),
                        'updated_at' => now()
                ]);

                return redirect()->route('vehicles.index')->with('success', 'Veicolo creato con successo!');
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
                //$vehicle = DB::table('vehicles')->find($id);
                $vehicle = Vehicle::find($id);
                return view('pages.vehicles.show', compact('vehicle'));
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Vehicle $vehicle)
        {
                return view('pages.vehicles.edit', ['vehicle' => $vehicle, 'tags' => Tag::all()]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Vehicle $vehicle)
        {
                $request->validate([
                        'model' => ['required', 'string'],
                        'type' => ['required', Rule::in(['car', 'scooter', 'bike'])],
                        'battery_capacity' => ['required', 'integer'],
                        'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
                        'hourly_rate' => ['required', 'decimal:2'],
                ]);

                // DB::table('vehicles')->where('id', $id)->update([
                //     'model' => $request->model,
                //     'type' => $request->type,
                //     'battery_capacity' => $request->battery_capacity,
                //     'status' => $request->status,
                //     'hourly_rate' => $request->hourly_rate,
                //     'updated_at' => now(),
                // ]);

                $vehicle->update([
                        'model' => $request->model,
                        'type' => $request->type,
                        'battery_capacity' => $request->battery_capacity,
                        'status' => $request->status,
                        'hourly_rate' => $request->hourly_rate
                ]);

                $vehicle->tags()->syncWithPivotValues($request->tags, [
                        'updated_at' => now()
                ]);

                return redirect()->route('vehicles.index')->with('success', 'Veicolo ' . $vehicle->model . ' aggiornato con successo');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
                Vehicle::destroy($id);
                return redirect()->route('vehicles.index');
        }
}
