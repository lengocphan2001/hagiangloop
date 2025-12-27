<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\Tour;
use App\Models\BusService;
use App\Models\Gift;
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
        $totalPrice = $request->get('total_price', 0);
        $useBusService = $request->get('use_bus') === '1' || $request->get('use_bus') === true;

        if (!$tourId) {
            return redirect()->route('tours.index')->with('error', 'Please select a tour first.');
        }

        $tour = Tour::findOrFail($tourId);
        $outboundBus = ($useBusService && $outboundBusId) ? BusService::find($outboundBusId) : null;
        $returnBus = ($useBusService && $returnBusId) ? BusService::find($returnBusId) : null;
        $gift = $giftId ? Gift::find($giftId) : null;

        return view('checkout', compact(
            'tour',
            'tourStartDate',
            'adults',
            'children',
            'outboundBus',
            'returnBus',
            'gift',
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
        $order = Order::with(['tour', 'outboundBusService', 'returnBusService', 'gift'])->findOrFail($id);
        return view('checkout-success', compact('order'));
    }
}
