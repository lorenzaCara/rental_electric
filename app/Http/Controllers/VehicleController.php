<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Tag;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
        protected $vehicleService;

        /**
         * Create a new class instance.
         */
        public function __construct(VehicleService $vehicleService)
        {
                $this->vehicleService = $vehicleService;
        }

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
        public function store(UpdateVehicleRequest $request): JsonResponse
        {
                $validated = $request->validated();
                $image = $request->file('image');

                $vehicle = $this->vehicleService->create($validated, $image);

                return response()->json([
                        'message' => 'Veicolo creato con successo',
                        'vehicle' => $vehicle
                ], 201);
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
        public function update(UpdateVehicleRequest $request, Vehicle $vehicle): JsonResponse
        {
                $validated = $request->validated();
                $image = $request->file('image');

                $this->vehicleService->update($vehicle, $validated, $image);

                return response()->json([
                        'message' => 'Veicolo aggiornato con successo',
                        'vehicle' => $vehicle->fresh()
                ]);
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
