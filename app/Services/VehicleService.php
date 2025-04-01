<?php

namespace App\Services;

use App\Models\Vehicle;
use App\Repositories\VehicleRepository;
use Illuminate\Http\UploadedFile;

class VehicleService
{
    public function __construct(
        private VehicleRepository $vehicleRepository
    ) {}

    /**
     * Update a vehicle with optional image.
     *
     * @param Vehicle $vehicle
     * @param array<string, mixed> $data
     * @param UploadedFile|null $image
     */
    public function update(Vehicle $vehicle, array $data, ?UploadedFile $image = null): bool
    {
        $updated = $this->vehicleRepository->update($vehicle, $data);

        if ($image) {
            $this->vehicleRepository->updateImage($vehicle, $image);
        }

        return $updated;
    }

    /**
     * Create a new vehicle with optional image.
     *
     * @param array<string, mixed> $data
     * @param UploadedFile|null $image
     */
    public function create(array $data, ?UploadedFile $image = null): Vehicle
    {
        $vehicle = $this->vehicleRepository->create($data);

        if ($image) {
            $this->vehicleRepository->updateImage($vehicle, $image);
        }

        return $vehicle;
    }
}
