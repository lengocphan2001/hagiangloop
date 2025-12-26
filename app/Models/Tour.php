<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Tour extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'duration',
        'nights',
        'days',
        'description',
        'price',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tour) {
            if (empty($tour->slug)) {
                $tour->slug = Str::slug($tour->name);
            }
        });
    }

    /**
     * Get the tour days for the tour.
     */
    public function tourDays(): HasMany
    {
        return $this->hasMany(TourDay::class)->orderBy('day_number');
    }

    /**
     * Alias for tourDays() for backward compatibility
     */
    public function days(): HasMany
    {
        return $this->tourDays();
    }

    /**
     * Get all locations for the tour.
     */
    public function locations()
    {
        return $this->hasManyThrough(TourLocation::class, TourDay::class)
            ->orderBy('tour_days.day_number')
            ->orderBy('tour_locations.sort_order');
    }
}
