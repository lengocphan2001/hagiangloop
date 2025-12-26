<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourDay extends Model
{
    protected $fillable = [
        'tour_id',
        'day_number',
        'title',
        'route',
        'breakfast_time',
        'departure_time',
        'notes',
        'sort_order',
    ];

    protected $casts = [
        'breakfast_time' => 'datetime:H:i',
        'departure_time' => 'datetime:H:i',
    ];

    /**
     * Get the tour that owns the day.
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the locations for the day.
     */
    public function locations(): HasMany
    {
        return $this->hasMany(TourLocation::class)->orderBy('sort_order');
    }
}
