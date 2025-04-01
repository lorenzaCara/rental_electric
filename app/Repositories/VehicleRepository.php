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
    public function updateImage(Vehicle $vehicle, UploadedFile $image)
    {

        // Elimino l'immagine corrente nel caso esiste già per quel veicolo
        if ($vehicle->image_path) {
            $this->deleteImage($vehicle->image_path);
        }

        // Salvo l'immagine caricata all'interno della cartella vehicles nel disk public
        $imagePath = $image->storePublicly('vehicles', 'public');

        // Aggiorno il record del veicolo con il nuovo file_path
        $vehicle->update([
            'image_path' => $imagePath
        ]);
    }

    /**
     * Eliminare un file immagine dallo storage
     */
    public function deleteImage(string $imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
