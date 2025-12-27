<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'departure_time',
        'pick_up_location',
        'price',
        'is_recommended',
        'starting_point',
        'return_destination',
        'direction',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:0',
        'is_recommended' => 'boolean',
        'is_active' => 'boolean',
    ];
}
