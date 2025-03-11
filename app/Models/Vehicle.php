<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'model',
        'type',
        'battery_capacity',
        'status',
        'hourly_rate'
    ];

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'rentals')->using(Rental::class)->withPivot('id', 'start_time', 'end_time', 'total_cost', 'status');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
