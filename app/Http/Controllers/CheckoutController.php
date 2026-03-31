<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\Tour;
use App\Models\BusService;
use App\Models\Gift;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function show(Request $request)
    {
        $tourId = $request->get('tour_id');
        $tourStartDate = $request->get('tour_start_date');
        $adults = $request->get('adults', 2);
        $children = $request->get('children', 0);
        $outboundBusId = $request->get('outbound_bus');
        $returnBusId = $request->get('return_bus');
        $giftId = $request->get('gift');
        $accommodationId = $request->get('accommodation');
        $useBusService = $request->get('use_bus') === '1' || $request->get('use_bus') === true;

        if (!$tourId) {
            return redirect()->route('tours.index')->with('error', 'Please select a tour first.');
        }

        // Ensure tour_start_date is in YYYY-MM-DD format (already should be from JS)
        // Just validate format, don't parse with timezone
        if ($tourStartDate) {
            try {
                // If already in YYYY-MM-DD format, use it directly
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tourStartDate)) {
                    // Already correct format, use as is
                } else {
                    // Parse and format without timezone conversion
                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $tourStartDate);
                    if (!$date) {
                        $date = \Carbon\Carbon::parse($tourStartDate);
                    }
                    $tourStartDate = $date->format('Y-m-d');
                }
            } catch (\Exception $e) {
                // Keep original if parsing fails
            }
        }

        $tour = Tour::findOrFail($tourId);
        $outboundBus = ($useBusService && $outboundBusId) ? BusService::find($outboundBusId) : null;
        $returnBus = ($useBusService && $returnBusId) ? BusService::find($returnBusId) : null;
        $gift = $giftId ? Gift::find($giftId) : null;
        $accommodation = $accommodationId ? Accommodation::find($accommodationId) : null;
        $totalPrice = $this->calculateTotalPrice($tour, (int) $adults, $outboundBus, $returnBus, $accommodation);

        return view('checkout', compact(
            'tour',
            'tourStartDate',
            'adults',
            'children',
            'outboundBus',
            'returnBus',
            'gift',
            'accommodation',
            'totalPrice',
            'useBusService'
        ));
    }

    /**
     * Store order
     */
    public function store(CheckoutRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Ensure tour_start_date is in correct format
            if (isset($validated['tour_start_date'])) {
                try {
                    $date = \Carbon\Carbon::parse($validated['tour_start_date']);
                    $validated['tour_start_date'] = $date->format('Y-m-d');
                } catch (\Exception $e) {
                    Log::error('Invalid date format', [
                        'date' => $validated['tour_start_date'],
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Process additional passengers if provided
            // Laravel will automatically encode to JSON due to the 'array' cast in the model
            if (isset($validated['additional_passengers']) && is_array($validated['additional_passengers'])) {
                // Ensure it's a valid array (Laravel will handle JSON encoding via cast)
                $validated['additional_passengers'] = array_values($validated['additional_passengers']);
            } else {
                $validated['additional_passengers'] = null;
            }

            // Always recalculate total on server to avoid stale/tampered client totals.
            $tour = Tour::findOrFail($validated['tour_id']);
            $outboundBus = !empty($validated['outbound_bus_service_id']) ? BusService::find($validated['outbound_bus_service_id']) : null;
            $returnBus = !empty($validated['return_bus_service_id']) ? BusService::find($validated['return_bus_service_id']) : null;
            $accommodation = !empty($validated['accommodation_id']) ? Accommodation::find($validated['accommodation_id']) : null;
            $validated['total_price'] = $this->calculateTotalPrice(
                $tour,
                (int) $validated['adults_count'],
                $outboundBus,
                $returnBus,
                $accommodation
            );

            // Create order
            $order = Order::create($validated);

            // Send confirmation email
            try {
                Mail::to($order->customer_email)
                    ->cc('lengocphan503@gmail.com')
                    ->send(new OrderConfirmationMail($order));
                
                Log::info('Order confirmation email sent', ['order_id' => $order->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send order confirmation email', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                ->with('error', 'There was an error processing your order. Please try again.');
        }
    }

    /**
     * Show success page
     */
    public function success($id)
    {
        $order = Order::with(['tour', 'outboundBusService', 'returnBusService', 'gift', 'accommodation'])->findOrFail($id);
        return view('checkout-success', compact('order'));
    }

    private function calculateTotalPrice(
        Tour $tour,
        int $adults,
        ?BusService $outboundBus,
        ?BusService $returnBus,
        ?Accommodation $accommodation
    ): float {
        $safeAdults = max(1, $adults);
        $tourPrice = (float) ($tour->price ?? 0);
        $outboundPrice = (float) ($outboundBus?->price ?? 0);
        $returnPrice = (float) ($returnBus?->price ?? 0);
        $tourNights = max(0, (int) ($tour->nights ?? 0));
        $accommodationPerNight = (float) ($accommodation?->price_per_night ?? 0);
        $accommodationTotal = $accommodationPerNight * $tourNights;

        return $tourPrice * $safeAdults + $outboundPrice + $returnPrice + $accommodationTotal;
    }
}
