<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Rental;
use App\Models\Vehicle;

class Customer extends Model
{
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'rentals')->using(Rental::class)->withPivot('start_time', 'end_time', 'total_cost');
    }
}
