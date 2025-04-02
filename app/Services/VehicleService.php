<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class VehicleService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected VehicleRepository $vehicleRepository) {}

    public function create(Request $request)
    {
        // estraggo l'immagine dalla request
        $imageFile = $request->file('image');

        // salvo i dati ricevuti dalla request nel db
        $vehicle = $this->vehicleRepository->save($request);

        // controllo se la request contiene un file
        if ($imageFile) {
            // se esiste carico l'immagine nello storage (locale)
            $imagePath = $this->uploadImage($vehicle, $imageFile);

            // aggiorno il record del veicolo con l'image path relativo all'immagine caricata
            $this->vehicleRepository->updateImage($vehicle, $imagePath);
        }
        return $vehicle;
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $imageFile = $request->file('image');
        $vehicle = $this->vehicleRepository->update($request, $vehicle);
    }

    public function uploadImage(Vehicle $vehicle, UploadedFile $image)
    {
        // Elimino l'immagine corrente nel caso esiste già per quel veicolo
        if ($vehicle->image_path) {
            $this->deleteImage($vehicle->image_path);
        }

        // Salvo l'immagine caricata all'interno della cartella vehicles nel disk public
        $imagePath = $image->storePublicly('vehicles', 'public');

        return $imagePath;
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
