@extends('layouts.app')

@section('title', 'Order Confirmed - Hà Giang Loop Tours')

@section('content')
<section class="py-16 lg:py-20 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8 text-center">
                <!-- Success Icon -->
                <div class="mb-6">
                    <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Order Confirmed!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    Thank you for your booking. We have sent a confirmation email to <strong>{{ $order->customer_email }}</strong>
                </p>

                <!-- Order Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Order Details</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Code:</span>
                            <span class="font-medium text-gray-900">{{ $order->order_code }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tour:</span>
                            <span class="font-medium text-gray-900">{{ $order->tour->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Start Date:</span>
                            <span class="font-medium text-gray-900">{{ $order->tour_start_date->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">People:</span>
                            <span class="font-medium text-gray-900">{{ $order->adults_count }} Adult(s){{ $order->children_count > 0 ? ', ' . $order->children_count . ' Child(ren)' : '' }}</span>
                        </div>
                        @if($order->outboundBusService || $order->returnBusService)
                            <div class="pt-3 border-t border-gray-200">
                                <p class="text-gray-600 mb-2">Bus Services:</p>
                                @if($order->outboundBusService)
                                    <p class="text-xs text-gray-500">• {{ $order->outboundBusService->name }}</p>
                                @endif
                                @if($order->returnBusService)
                                    <p class="text-xs text-gray-500">• {{ $order->returnBusService->name }}</p>
                                @endif
                            </div>
                        @endif
                        <div class="pt-3 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total:</span>
                                <span class="text-xl font-bold text-pink-600">{{ number_format($order->total_price, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('tours.index') }}" 
                        class="px-6 py-4 sm:py-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-lg transition-colors min-h-[48px] sm:min-h-0 flex items-center justify-center break-words">
                        Browse More Tours
                    </a>
                    <a href="{{ route('home') }}" 
                        class="px-6 py-4 sm:py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors min-h-[48px] sm:min-h-0 flex items-center justify-center break-words">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

