@extends('layouts.app')

@section('title', __('checkout.title') . ' - Hà Giang Loop Tours')

@section('content')
<section class="py-8 lg:py-12 bg-gray-50 overflow-x-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="w-full">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 py-8 text-center">{{ __('checkout.title') }}</h1>

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h3 class="text-red-800 font-semibold mb-2">{{ __('checkout.please_fix_errors') }}</h3>
                    <ul class="list-disc list-inside text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2 w-full min-w-0">
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 sm:p-6 mb-6 w-full">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ __('checkout.order_summary') }}</h2>
                        
                        <!-- Tour Info -->
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $tour->name }}</h3>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p><strong>{{ __('checkout.start_date') }}:</strong> {{ $tourStartDate ? \Carbon\Carbon::parse($tourStartDate)->format('d/m/Y') : __('checkout.not_selected') }}</p>
                                <p><strong>{{ __('checkout.adults') }}:</strong> {{ $adults }}</p>
                                @if($children > 0)
                                    <p><strong>{{ __('checkout.children') }}:</strong> {{ $children }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Bus Services -->
                        @if($useBusService)
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('checkout.bus_services') }}</h4>
                                @if($outboundBus)
                                    <div class="text-sm text-gray-600 mb-2">
                                        <p><strong>{{ __('checkout.outbound') }}:</strong> {{ $outboundBus->name }} - {{ $outboundBus->departure_time }}</p>
                                        <p class="text-pink-600 font-medium">{{ number_format($outboundBus->price, 0, ',', '.') }} VND</p>
                                    </div>
                                @endif
                                @if($returnBus)
                                    <div class="text-sm text-gray-600">
                                        <p><strong>{{ __('checkout.return') }}:</strong> {{ $returnBus->name }} - {{ $returnBus->departure_time }}</p>
                                        <p class="text-pink-600 font-medium">{{ number_format($returnBus->price, 0, ',', '.') }} VND</p>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Gift -->
                        @if($gift)
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('checkout.gift') }}</h4>
                                <div class="flex items-center gap-3">
                                    @if($gift->image)
                                        <img src="{{ Storage::url($gift->image) }}" alt="{{ $gift->name }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    <span class="text-sm text-gray-600">{{ $gift->name }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Accommodation -->
                        @if($accommodation)
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ __('checkout.accommodation') }}</h4>
                                <div class="text-sm text-gray-600">
                                    <p class="font-semibold">{{ $accommodation->name }}</p>
                                    @if($accommodation->bed_type)
                                        <p class="text-xs text-gray-500">{{ $accommodation->bed_type }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500">
                                        {{ $accommodation->capacity_min }}-{{ $accommodation->capacity_max }}pp
                                        @if($accommodation->price_per_night > 0)
                                            - {{ number_format($accommodation->price_per_night, 0, ',', '.') }}₫/night
                                        @else
                                            - (No fees)
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Total -->
                        <div class="pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">{{ __('common.total') }}:</span>
                                <span class="text-2xl font-bold text-pink-600">{{ number_format($totalPrice, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Form -->
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 sm:p-6 w-full">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">{{ __('checkout.customer_information') }}</h2>
                        
                        <form action="{{ route('checkout.store') }}" method="POST" class="w-full" id="checkoutForm">
                            @csrf
                            
                            <!-- Hidden fields -->
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            <input type="hidden" name="tour_start_date" value="{{ $tourStartDate }}">
                            <input type="hidden" name="adults_count" value="{{ $adults }}">
                            <input type="hidden" name="children_count" value="{{ $children ?? 0 }}">
                            <input type="hidden" name="outbound_bus_service_id" value="{{ $outboundBus ? $outboundBus->id : '' }}">
                            <input type="hidden" name="return_bus_service_id" value="{{ $returnBus ? $returnBus->id : '' }}">
                            <input type="hidden" name="gift_id" value="{{ $gift ? $gift->id : '' }}">
                            <input type="hidden" name="accommodation_id" value="{{ $accommodation ? $accommodation->id : '' }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 w-full">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('checkout.full_name') }} <span class="text-red-500">*</span>
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
                                        {{ __('common.email') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="customer_email" id="customer_email" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_email') border-red-500 @enderror"
                                        value="{{ old('customer_email') }}" required>
                                    @error('customer_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 w-full">
                                <div class="w-full min-w-0">
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('checkout.phone_number') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="customer_phone" id="customer_phone" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_phone') border-red-500 @enderror"
                                        value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full min-w-0">
                                    <label for="customer_country" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('checkout.country') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="customer_country" id="customer_country" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_country') border-red-500 @enderror"
                                        value="{{ old('customer_country') }}" required>
                                    @error('customer_country')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 w-full">
                                <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('common.address') }} ({{ __('common.optional') }})
                                </label>
                                <input type="text" name="customer_address" id="customer_address" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('customer_address') border-red-500 @enderror"
                                    value="{{ old('customer_address') }}">
                                @error('customer_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            @if($adults > 1)
                            <!-- Additional Passengers Information -->
                            <div class="mb-6 w-full">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('checkout.additional_passengers') }}</h3>
                                <p class="text-sm text-gray-600 mb-4">{{ __('checkout.additional_passengers_description', ['count' => $adults - 1]) }}</p>
                                
                                <div id="additionalPassengersContainer" class="space-y-4">
                                    @for($i = 2; $i <= $adults; $i++)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <h4 class="text-md font-medium text-gray-700 mb-3">{{ __('checkout.passenger') }} {{ $i }}</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="passenger_name_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    {{ __('checkout.full_name') }} <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="additional_passengers[{{ $i - 2 }}][name]" id="passenger_name_{{ $i }}" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('additional_passengers.' . ($i - 2) . '.name') border-red-500 @enderror"
                                                    value="{{ old('additional_passengers.' . ($i - 2) . '.name') }}" required>
                                                @error('additional_passengers.' . ($i - 2) . '.name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="passenger_country_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    {{ __('checkout.country') }} <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="additional_passengers[{{ $i - 2 }}][country]" id="passenger_country_{{ $i }}" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('additional_passengers.' . ($i - 2) . '.country') border-red-500 @enderror"
                                                    value="{{ old('additional_passengers.' . ($i - 2) . '.country') }}" required>
                                                @error('additional_passengers.' . ($i - 2) . '.country')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            @endif

                            <div class="mb-6 w-full">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('checkout.additional_notes') }} ({{ __('common.optional') }})
                                </label>
                                <textarea name="notes" id="notes" rows="4" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 outline-none @error('notes') border-red-500 @enderror resize-none">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 w-full">
                                <button type="submit" 
                                    class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-4 sm:py-3 px-6 rounded-lg transition-colors duration-200 cursor-pointer min-h-[48px] sm:min-h-0">
                                    {{ __('checkout.confirm_order') }}
                                </button>
                                <a href="{{ route('tours.show', $tour->slug) }}" 
                                    class="px-6 py-4 sm:py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors cursor-pointer min-h-[48px] sm:min-h-0 flex items-center justify-center">
                                    {{ __('common.back') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 w-full min-w-0">
                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 sm:p-6 sticky top-4 w-full">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('checkout.booking_details') }}</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between gap-2">
                                <span class="text-gray-600 flex-shrink-0">{{ __('checkout.tour') }}:</span>
                                <span class="font-medium text-gray-900 text-right break-words">{{ $tour->name }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-gray-600 flex-shrink-0">{{ __('common.date') }}:</span>
                                <span class="font-medium text-gray-900 text-right">{{ $tourStartDate ? \Carbon\Carbon::parse($tourStartDate)->format('d/m/Y') : __('checkout.not_selected') }}</span>
                            </div>
                            <div class="flex justify-between gap-2">
                                <span class="text-gray-600 flex-shrink-0">{{ __('checkout.people') }}:</span>
                                <span class="font-medium text-gray-900 text-right">{{ $adults }} {{ __('checkout.adult_s') }}{{ $children > 0 ? ', ' . $children . ' ' . __('checkout.child_ren') : '' }}</span>
                            </div>
                            @if($useBusService)
                                <div class="pt-3 border-t border-gray-200">
                                    <p class="text-gray-600 mb-2">{{ __('checkout.bus_services') }}:</p>
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
                                    <span class="text-lg font-bold text-gray-900">{{ __('common.total') }}:</span>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('checkoutForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submitting...');
            });
        }
    });
</script>
@endpush

@endsection

