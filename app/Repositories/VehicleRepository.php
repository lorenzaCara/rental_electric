<?php

namespace App\Repositories;

use App\Http\Requests\StoreVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VehicleRepository
{
    public function __construct(
        private Vehicle $model
    ) {}

    /**
     * Get all vehicles.
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find a vehicle by ID.
     */
    public function find(int $id): ?Vehicle
    {
        return $this->model->find($id);
    }

    /**
     * Create a new vehicle.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Vehicle
    {
        return $this->model->create($data);
    }

    /**
     * Update a vehicle.
     *
     * @param Vehicle $vehicle
     * @param array<string, mixed> $data
     */
    public function update(Vehicle $vehicle, array $data): bool
    {
        return $vehicle->update($data);
    }

    /**
     * Delete a vehicle.
     */
    public function delete(Vehicle $vehicle): bool
    {
        // Delete the vehicle's image if it exists
        if ($vehicle->image_path) {
            $this->deleteImage($vehicle->image_path);
        }

        return $vehicle->delete();
    }

    /**
     * Upload a vehicle image and return its path.
     */
    private function uploadImage(UploadedFile $image, string $path = 'images'): string
    {
        return $image->store($path, 'public');
    }

    /**
     * Delete an image from storage.
     */
    private function deleteImage(?string $imagePath): void
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    /**
     * Update vehicle's image.
     */
    public function updateImage(Vehicle $vehicle, UploadedFile $image): void
    {
        // Delete old image if exists
        if ($vehicle->image_path) {
            $this->deleteImage($vehicle->image_path);
        }

        // Upload new image and update vehicle
        $imagePath = $this->uploadImage($image);
        $vehicle->update(['image_path' => $imagePath]);
    }

    public function save(StoreVehicleRequest $request)
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
}
