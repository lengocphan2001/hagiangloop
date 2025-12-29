<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accommodation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity_min',
        'capacity_max',
        'bed_type',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:0',
        'is_active' => 'boolean',
    ];
}
