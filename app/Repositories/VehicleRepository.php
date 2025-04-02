<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VehicleRepository
{

    public function save(Request $request)
    {
        // creo il record sul database relativo al veicolo
        // $vehicle = Vehicle::create($request->merge([
        //     'user_id' => $request->user()->id
        // ])->get());

        $vehicle = $request->user()->vehicles()->create($request->all());

        // assegno i tags al veicolo creando un record nella pivot table tag_vehicle
        $vehicle->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $vehicle;
    }

    /**
     * Aggiorna l'immagine del veicolo
     */
    public function updateImage(Vehicle $vehicle, string $imagePath)
    {
        // Aggiorno il record del veicolo con il nuovo file_path
        $vehicle->update([
            'image_path' => $imagePath
        ]);
    }
}
