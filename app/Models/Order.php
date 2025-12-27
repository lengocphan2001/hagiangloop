<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tour_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'tour_start_date',
        'adults_count',
        'children_count',
        'outbound_bus_service_id',
        'return_bus_service_id',
        'gift_id',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'tour_start_date' => 'date',
        'total_price' => 'decimal:0',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function outboundBusService()
    {
        return $this->belongsTo(BusService::class, 'outbound_bus_service_id');
    }

    public function returnBusService()
    {
        return $this->belongsTo(BusService::class, 'return_bus_service_id');
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}
