<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'rentals')->using(Rental::class)->withPivot('start_time', 'end_time', 'total_cost');
    }
}
