<?php

namespace App\Repositories;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Vehicle;

class VehicleRepository
{

    public function save(StoreVehicleRequest $request)
    {
        // creo il record sul database relativo al veicolo
        $vehicle = Vehicle::create($request->all());

        // assegno i tags al veicolo creando un record nella pivot table tag_vehicle
        $vehicle->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $vehicle;
    }
}
