<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourLocation extends Model
{
    protected $fillable = [
        'tour_day_id',
        'name',
        'description',
        'type',
        'arrival_time',
        'sort_order',
        'thumbnail_image',
        'detail_images',
    ];

    protected $casts = [
        'arrival_time' => 'datetime:H:i',
        'detail_images' => 'array',
    ];

    /**
     * Get the tour day that owns the location.
     */
    public function tourDay(): BelongsTo
    {
        return $this->belongsTo(TourDay::class);
    }
}
