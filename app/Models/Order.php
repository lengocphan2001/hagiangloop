<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'tour_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'additional_passengers',
        'tour_start_date',
        'adults_count',
        'children_count',
        'outbound_bus_service_id',
        'return_bus_service_id',
        'gift_id',
        'accommodation_id',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'tour_start_date' => 'date',
        'total_price' => 'decimal:0',
        'additional_passengers' => 'array',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_code)) {
                $order->order_code = static::generateOrderCode();
            }
        });
    }

    /**
     * Generate unique order code
     * Format: HG-YYYYMMDD-XXXX (e.g., HG-20241229-0001)
     */
    protected static function generateOrderCode(): string
    {
        $prefix = 'HG';
        $date = now()->format('Ymd');
        
        // Get the last order code for today
        $lastOrder = static::where('order_code', 'like', "{$prefix}-{$date}-%")
            ->orderBy('order_code', 'desc')
            ->first();
        
        if ($lastOrder && preg_match('/-(\d+)$/', $lastOrder->order_code, $matches)) {
            $sequence = intval($matches[1]) + 1;
        } else {
            $sequence = 1;
        }
        
        return sprintf('%s-%s-%04d', $prefix, $date, $sequence);
    }

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

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
