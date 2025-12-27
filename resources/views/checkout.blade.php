@extends('layouts.app')

@section('title', 'Checkout - Hà Giang Loop Tours')

@section('content')
<section class="py-8 lg:py-12 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8 text-center">Checkout</h1>

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>
                        
                        <!-- Tour Info -->
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $tour->name }}</h3>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>Start Date:</strong> {{ $tourStartDate ? \Carbon\Carbon::parse($tourStartDate)->format('d/m/Y') : 'Not selected' }}</p>
                                <p><strong>Adults:</strong> {{ $adults }}</p>
                                @if($children > 0)
                                    <p><strong>Children:</strong> {{ $children }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Bus Services -->
                        @if($useBusService)
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Bus Services</h4>
                                @if($outboundBus)
                                    <div class="text-sm text-gray-600 mb-2">
                                        <p><strong>Outbound:</strong> {{ $outboundBus->name }} - {{ $outboundBus->departure_time }}</p>
                                        <p class="text-pink-600 font-medium">{{ number_format($outboundBus->price, 0, ',', '.') }} VND</p>
                                    </div>
                                @endif
                                @if($returnBus)
                                    <div class="text-sm text-gray-600">
                                        <p><strong>Return:</strong> {{ $returnBus->name }} - {{ $returnBus->departure_time }}</p>
                                        <p class="text-pink-600 font-medium">{{ number_format($returnBus->price, 0, ',', '.') }} VND</p>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Gift -->
                        @if($gift)
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Gift</h4>
                                <div class="flex items-center gap-3">
                                    @if($gift->image)
                                        <img src="{{ Storage::url($gift->image) }}" alt="{{ $gift->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <span class="text-sm text-gray-600">{{ $gift->name }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Total -->
                        <div class="pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total:</span>
                                <span class="text-2xl font-bold text-pink-600">{{ number_format($totalPrice, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Form -->
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Customer Information</h2>
                        
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            
                            <!-- Hidden fields -->
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <input type="hidden" name="tour_start_date" value="{{ $tourStartDate }}">
                            <input type="hidden" name="adults_count" value="{{ $adults }}">
                            <input type="hidden" name="children_count" value="{{ $children }}">
                            <input type="hidden" name="outbound_bus_service_id" value="{{ $outboundBus ? $outboundBus->id : '' }}">
                            <input type="hidden" name="return_bus_service_id" value="{{ $returnBus ? $returnBus->id : '' }}">
                            <input type="hidden" name="gift_id" value="{{ $gift ? $gift->id : '' }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="customer_name" id="customer_name" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_name') border-red-500 @enderror"
                                        value="{{ old('customer_name') }}" required>
                                    @error('customer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="customer_email" id="customer_email" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_email') border-red-500 @enderror"
                                        value="{{ old('customer_email') }}" required>
                                    @error('customer_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="customer_phone" id="customer_phone" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_phone') border-red-500 @enderror"
                                        value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                                        Address (Optional)
                                    </label>
                                    <input type="text" name="customer_address" id="customer_address" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_address') border-red-500 @enderror"
                                        value="{{ old('customer_address') }}">
                                    @error('customer_address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Additional Notes (Optional)
                                </label>
                                <textarea name="notes" id="notes" rows="4" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex gap-4">
                                <button type="submit" 
                                    class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                                    Confirm Order
                                </button>
                                <a href="{{ route('tours.show', $tour->slug) }}" 
                                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                    Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 sticky top-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Booking Details</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tour:</span>
                                <span class="font-medium text-gray-900">{{ $tour->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium text-gray-900">{{ $tourStartDate ? \Carbon\Carbon::parse($tourStartDate)->format('d/m/Y') : 'Not selected' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">People:</span>
                                <span class="font-medium text-gray-900">{{ $adults }} Adult(s){{ $children > 0 ? ', ' . $children . ' Child(ren)' : '' }}</span>
                            </div>
                            @if($useBusService)
                                <div class="pt-3 border-t border-gray-200">
                                    <p class="text-gray-600 mb-2">Bus Services:</p>
                                    @if($outboundBus)
                                        <p class="text-xs text-gray-500">• {{ $outboundBus->name }}</p>
                                    @endif
                                    @if($returnBus)
                                        <p class="text-xs text-gray-500">• {{ $returnBus->name }}</p>
                                    @endif
                                </div>
                            @endif
                            <div class="pt-3 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900">Total:</span>
                                    <span class="text-xl font-bold text-pink-600">{{ number_format($totalPrice, 0, ',', '.') }} VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@endsection

