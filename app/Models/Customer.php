<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'rentals')->using(Rental::class)->withPivot('start_time', 'end_time', 'total_cost', 'status');
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }
}
