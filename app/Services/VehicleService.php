<?php

namespace App\Services;

use App\Http\Requests\StoreVehicleRequest;
use App\Repositories\VehicleRepository;

class VehicleService
{
    protected $vehicleRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function create(StoreVehicleRequest $request)
    {
        $imageFile = $request->file('image');
        $vehicle = $this->vehicleRepository->save($request);
        if ($imageFile) {
            $this->vehicleRepository->updateImage($vehicle, $imageFile);
        }
        return $vehicle;
    }
}
