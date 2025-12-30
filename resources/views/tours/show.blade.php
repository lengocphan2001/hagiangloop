@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', $tour->name . ' - Hà Giang Loop Tours')

@section('content')
    <!-- Hero Section with Tour Info -->
    <section
        class="relative overflow-hidden tour-detail-hero-section">
        <div class="container mx-auto px-4 lg:px-6 relative z-10 py-10 lg:py-16">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center justify-center">
                <div class="inline-block mb-6 flex items-center justify-center" data-aos="fade-down" data-aos-duration="600">
                    <span
                        class="bg-gradient-to-r from-amber-400 to-amber-500 text-white px-6 py-2 rounded-full font-bold text-lg shadow-lg backdrop-blur-sm border border-amber-300/30">
                        {{ $tour->duration }}
                    </span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold text-black mb-6 tour-title-animate text-center w-full"
                    data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    {{ $tour->name }}
                </h1>
                <p class="text-xl lg:text-2xl text-black mb-8 text-center w-full" data-aos="fade-up"
                    data-aos-duration="800" data-aos-delay="200">
                    {{ $tour->days }} Days / {{ $tour->nights }} Nights Adventure
                </p>

                <div class="flex flex-wrap justify-center items-center gap-4 w-full relative z-20" data-aos="fade-up"
                    data-aos-duration="800" data-aos-delay="500">
                    <a href="#itinerary"
                        class="relative z-20 bg-gradient-to-r from-amber-500 to-amber-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-amber-600 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl cursor-pointer">
                        View Itinerary
                    </a>
                    <a href="#booking"
                        class="relative z-20 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl cursor-pointer">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Itinerary Timeline -->
    <section id="itinerary" class="bg-white relative overflow-hidden mt-4">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Part 1: Tour Itinerary (2/3 width) -->
                <div class="lg:col-span-2">
                    <!-- Main Content -->
                    <div class="mx-auto">
                        @if ($tour->thumbnail_image || ($tour->detail_images && count($tour->detail_images) > 0))
                            <div class="mb-8 w-full max-w-5xl mx-auto" data-aos="fade-up" data-aos-duration="800"
                                data-aos-delay="450">
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Thumbnail Image (Left) -->
                                    @if ($tour->thumbnail_image)
                                        <div class="relative">
                                            <img src="{{ Storage::url($tour->thumbnail_image) }}" alt="{{ $tour->name }}"
                                                class="w-full rounded-lg shadow-xl object-cover"
                                                id="thumbnailImage">
                                        </div>
                                    @endif

                                    <!-- Detail Image (Right) -->
                                    @if ($tour->detail_images && count($tour->detail_images) > 0)
                                        <div class="flex flex-col" id="detailImageContainer">
                                            <div class="relative group cursor-pointer flex-shrink-0"
                                                onclick="openTourGallery({{ json_encode(array_map(fn($img) => Storage::url($img), $tour->detail_images)) }}, 0)">
                                                <img src="{{ Storage::url($tour->detail_images[0]) }}"
                                                    alt="{{ $tour->name }}"
                                                    class="w-full h-48 md:h-56 rounded-lg shadow-xl object-cover">
                                                <div
                                                    class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors rounded-lg flex items-center justify-center">
                                                    <div class="text-center text-white">
                                                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        <p class="font-semibold text-base">{{ __('tours.view_all') }}</p>
                                                        <p class="text-xs">{{ count($tour->detail_images) }} photos</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="text-start mb-8">
                            <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-4">{{ __('tours.tour_itinerary') }}</h2>
                        </div>
                        @foreach ($tour->tourDays as $dayIndex => $day)
                            <div id="day-{{ $day->day_number }}"
                                class="day-accordion-item mb-2 bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200"
                                data-day="{{ $day->day_number }}">
                                <!-- Day Accordion Header -->
                                <button onclick="toggleDayAccordion({{ $day->day_number }})"
                                    class="day-accordion-header w-full flex items-center justify-between px-4 py-2.5 hover:bg-gray-50 transition-colors duration-200 text-left cursor-pointer"
                                    data-day="{{ $day->day_number }}">
                                    <div class="flex items-center gap-3 flex-1 min-w-0">
                                        <div
                                            class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ $day->day_number }}
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <h3 class="text-base lg:text-lg font-bold text-gray-900 truncate">
                                                {{ $day->title }}
                                            </h3>
                                            @if ($day->route)
                                                <p
                                                    class="text-xs lg:text-sm text-gray-600 flex items-center truncate mt-0.5">
                                                    <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-1.5 text-amber-500 flex-shrink-0"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span class="truncate">{{ $day->route }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <svg class="day-chevron flex-shrink-0 w-5 h-5 text-gray-600 transition-transform duration-300 ml-3"
                                        id="chevron-{{ $day->day_number }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </button>

                                <!-- Day Content - Collapsible -->
                                <div class="day-accordion-content hidden" id="content-{{ $day->day_number }}"
                                    data-day="{{ $day->day_number }}">
                                    <div class="px-4 lg:px-6">
                                        <!-- Day Content -->
                                        <div class="day-content">
                                            <!-- Day Info -->
                                            @if ($day->breakfast_time || $day->departure_time || $day->notes)
                                                <div class="bg-white rounded-lg p-4 mb-4 border border-gray-200">
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                        @if ($day->breakfast_time)
                                                            <div class="flex items-start md:items-center gap-2 min-w-0">
                                                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5 md:mt-0"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>
                                                                <div class="min-w-0 flex-1">
                                                                    <p class="text-xs text-gray-500 mb-0.5">Breakfast</p>
                                                                    <p
                                                                        class="font-semibold text-gray-900 text-sm md:text-base">
                                                                        {{ $day->breakfast_time->format('H:i') }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($day->departure_time)
                                                            <div class="flex items-start md:items-center gap-2 min-w-0">
                                                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5 md:mt-0"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                                                                    </path>
                                                                </svg>
                                                                <div class="min-w-0 flex-1">
                                                                    <p class="text-xs text-gray-500 mb-0.5">Departure</p>
                                                                    <p
                                                                        class="font-semibold text-gray-900 text-sm md:text-base">
                                                                        {{ $day->departure_time->format('H:i') }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($day->notes)
                                                            <div class="md:col-span-3 flex items-start gap-2 pt-2 md:pt-0">
                                                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>
                                                                <p class="text-sm text-gray-700 flex-1 break-words">
                                                                    {{ $day->notes }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Locations Timeline -->
                                            <div class="relative pl-8">
                                                <!-- Timeline line -->
                                                <div
                                                    class="absolute left-4 top-0 bottom-0 w-0.5 bg-gradient-to-b from-amber-300 via-green-300 to-amber-300">
                                                </div>

                                                <div class="space-y-3">
                                                    @foreach ($day->locations as $locationIndex => $location)
                                                        <div class="location-item relative flex items-start gap-3">
                                                            <!-- Location Marker -->
                                                            <div class="flex-shrink-0 relative z-10">
                                                                <div
                                                                    class="w-8 h-8 rounded-full flex items-center justify-center shadow-sm location-marker 
                                                        {{ $location->type === 'meal' ? 'bg-green-500' : ($location->type === 'accommodation' ? 'bg-blue-500' : 'bg-amber-500') }}">
                                                                    @if ($location->type === 'meal')
                                                                        <svg class="w-4 h-4 text-white" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                                            </path>
                                                                        </svg>
                                                                    @elseif($location->type === 'accommodation')
                                                                        <svg class="w-4 h-4 text-white" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                                                            </path>
                                                                        </svg>
                                                                    @else
                                                                        <svg class="w-4 h-4 text-white" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                                            </path>
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                                @if ($locationIndex < $day->locations->count() - 1)
                                                                    <div
                                                                        class="absolute left-1/2 top-8 w-0.5 h-3 bg-gradient-to-b from-amber-300 to-green-300 transform -translate-x-1/2">
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <!-- Location Content -->
                                                            <div class="flex-grow min-w-0 pb-2">
                                                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                                                    <h4 class="text-base font-semibold text-gray-900">
                                                                        {{ $location->name }}</h4>
                                                                    <span
                                                                        class="px-2 py-0.5 rounded-full text-xs font-medium 
                                                            {{ $location->type === 'meal' ? 'bg-green-100 text-green-700' : ($location->type === 'accommodation' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700') }}">
                                                                        {{ ucfirst($location->type) }}
                                                                    </span>
                                                                    @if ($location->arrival_time)
                                                                        <span
                                                                            class="text-gray-500 text-xs flex items-center">
                                                                            <svg class="w-3 h-3 mr-0.5" fill="none"
                                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                                </path>
                                                                            </svg>
                                                                            {{ $location->arrival_time->format('H:i') }}
                                                                        </span>
                                                                    @endif
                                                                </div>

                                                                @if ($location->description && $location->description)
                                                                    <p class="text-xs text-gray-600 mb-2 line-clamp-1">
                                                                        {{ $location->description }}</p>
                                                                @endif

                                                                <!-- Compact Images Gallery -->
                                                                @if ($location->thumbnail_image || ($location->detail_images && count($location->detail_images) > 0))
                                                                    <div class="flex gap-1.5 overflow-x-auto pb-1">
                                                                        @if ($location->thumbnail_image)
                                                                            <div class="flex-shrink-0 w-16 h-16 rounded overflow-hidden cursor-pointer"
                                                                                onclick="openImageModal('{{ asset('storage/' . $location->thumbnail_image) }}')">
                                                                                <img src="{{ asset('storage/' . $location->thumbnail_image) }}"
                                                                                    alt="{{ $location->name }}"
                                                                                    class="w-full h-full object-cover">
                                                                            </div>
                                                                        @endif
                                                                        @if ($location->detail_images && count($location->detail_images) > 0)
                                                                            @php
                                                                                $detailImagesArray = is_string(
                                                                                    $location->detail_images,
                                                                                )
                                                                                    ? json_decode(
                                                                                        $location->detail_images,
                                                                                        true,
                                                                                    )
                                                                                    : $location->detail_images;
                                                                            @endphp
                                                                            @foreach (array_slice($detailImagesArray, 0, 2) as $detailImage)
                                                                                <div class="flex-shrink-0 w-16 h-16 rounded overflow-hidden cursor-pointer"
                                                                                    onclick="openImageModal('{{ asset('storage/' . $detailImage) }}')">
                                                                                    <img src="{{ asset('storage/' . $detailImage) }}"
                                                                                        alt="{{ $location->name }}"
                                                                                        class="w-full h-full object-cover">
                                                                                </div>
                                                                            @endforeach
                                                                            @if (count($detailImagesArray) > 2)
                                                                                <div class="flex-shrink-0 w-16 h-16 rounded bg-gradient-to-br from-amber-400 to-green-400 flex items-center justify-center cursor-pointer text-white text-xs font-bold"
                                                                                    onclick="openImageGallery({{ json_encode(array_map(function ($img) {return asset('storage/' . $img);}, $detailImagesArray)) }})">
                                                                                    +{{ count($detailImagesArray) - 2 }}
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($tour->note)
                            <div class="mx-auto">
                                <div class="bg-white mt-8">
                                    <h3 class="text-xl lg:text-2xl font-bold text-gray-900 mb-4">Tour Notes</h3>
                                    <div class="prose prose-lg max-w-none text-gray-700">
                                        {!! $tour->note !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Part 2: Booking Widget (1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-4">
                        <div class="bg-white rounded-lg shadow-xl border border-gray-200 p-6">
                            <!-- Tour Type Selection Section -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900">{{ __('tours.tour') }}</h3>
                                </div>
                                @if($tour->price)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 mb-1">{{ __('tours.price_per_person') }}</p>
                                        <p class="text-2xl font-bold text-red-600" id="tourPriceDisplay">{{ number_format($tour->price, 0, ',', '.') }} VND</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Start Date Section -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ __('tours.start_date') }}</h3>
                                </div>
                                <input type="text" id="tourStartDate" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer"
                                    placeholder="{{ __('tours.select_date') }}"
                                    readonly>
                            </div>

                            <!-- Bus Service Option -->
                            <div class="mb-6">
                                <div class="flex items-center gap-3 p-3 border border-gray-300 rounded-lg">
                                    <input type="checkbox" id="useBusService" 
                                        class="w-5 h-5 text-amber-500 border-gray-300 rounded focus:ring-amber-500 cursor-pointer"
                                        onchange="toggleBusService()">
                                    <label for="useBusService" class="flex items-center gap-2 cursor-pointer flex-1">
                                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-900 text-sm sm:text-base">{{ __('tours.use_bus_service') }}</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Bus Service - Outbound -->
                            <div id="busServiceSection" class="mb-6 hidden">
                                <div class="mb-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-5 h-5 text-black flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ __('tours.select_starting_point') }}</h3>
                                    </div>
                                <div class="mb-3 relative">
                                    <!-- Custom Dropdown Button -->
                                    <button type="button" id="busStartingPointBtn" 
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white flex items-center justify-between cursor-pointer hover:border-amber-400 transition-colors">
                                        <span id="busStartingPointText" class="text-gray-700">Select starting point</span>
                                        <svg class="w-5 h-5 text-gray-400 transition-transform" id="busStartingPointIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <!-- Dropdown Menu -->
                                    <div id="busStartingPointDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden max-h-60 overflow-y-auto">
                                        <div class="py-1" id="busStartingPointOptions">
                                            <!-- Options will be loaded from API -->
                                            <div class="px-4 py-2 text-sm text-gray-500 text-center">Loading...</div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="busStartingPoint" value="">
                                </div>
                                <div class="mb-3">
                                    <input type="text" id="busDepartureDate" 
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer"
                                        placeholder="Chọn ngày khởi hành"
                                        readonly>
                                </div>
                                    <div id="outboundBusOptions" class="space-y-3">
                                        <!-- Outbound bus options will be loaded here -->
                                    </div>
                                </div>

                                <!-- Bus Service - Return -->
                                <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ __('tours.choose_return_destination') }}</h3>
                                </div>
                                <div class="mb-3 relative">
                                    <!-- Custom Dropdown Button -->
                                    <button type="button" id="busReturnDestinationBtn" 
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white flex items-center justify-between cursor-pointer hover:border-amber-400 transition-colors">
                                        <span id="busReturnDestinationText" class="text-gray-700">Select return destination</span>
                                        <svg class="w-5 h-5 text-gray-400 transition-transform" id="busReturnDestinationIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <!-- Dropdown Menu -->
                                    <div id="busReturnDestinationDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden max-h-60 overflow-y-auto">
                                        <div class="py-1" id="busReturnDestinationOptions">
                                            <!-- Options will be loaded from API -->
                                            <div class="px-4 py-2 text-sm text-gray-500 text-center">Loading...</div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="busReturnDestination" value="">
                                </div>
                                <div class="mb-3">
                                    <input type="text" id="busReturnDate" 
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer"
                                        placeholder="Chọn ngày về"
                                        readonly>
                                </div>
                                    <div id="returnBusOptions" class="space-y-3">
                                        <!-- Return bus options will be loaded here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Gifts Section -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900">{{ __('tours.gifts') }}</h3>
                                </div>
                                <div id="giftOptions" class="flex gap-3 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-amber-300 scrollbar-track-gray-100">
                                    <!-- Gift options will be loaded here -->
                                </div>
                            </div>

                            <!-- Accommodation Section -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900 text-sm sm:text-base">{{ __('tours.accommodation') }}</h3>
                                </div>
                                <div id="accommodationOptions" class="space-y-2">
                                    <!-- Accommodation options will be loaded here -->
                                </div>
                            </div>

                            <!-- People Section -->
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="font-bold text-gray-900">{{ __('tours.people') }}</h3>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">{{ __('tours.adults') }}</label>
                                    <input type="number" id="adultsCount" min="1" value="1" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none">
                                </div>
                            </div>

                            <!-- Total Section -->
                            <div class="mb-6 pt-4 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-gray-900">{{ __('common.total') }}:</span>
                                    <span class="text-2xl font-bold text-red-600" id="bookingTotal">0 VND</span>
                                </div>
                            </div>
 
                            <!-- Action Button -->
                            <button onclick="checkAvailability()"
                                class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-4 px-4 rounded-lg transition-colors duration-200 cursor-pointer">
                                {{ __('tours.continue_checkout') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Tour Gallery Modal -->
    <div id="tourGalleryModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm">
        <div class="flex items-center justify-center h-full w-full p-4">
            <div class="relative max-w-6xl w-full h-full flex flex-col">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4 text-white">
                    <h3 class="text-2xl font-bold">Tour Photos</h3>
                    <button onclick="closeTourGallery()" class="text-white hover:text-gray-300 transition-colors p-2 cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Main Image Container -->
                <div class="flex-1 relative flex items-center justify-center min-h-0 mb-4">
                    <!-- Previous Button -->
                    <button id="prevBtn" onclick="changeTourImage(-1)"
                        class="absolute left-4 z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full p-3 text-white transition-all cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Main Image -->
                    <img id="tourGalleryMainImage" src="" alt="Tour Photo"
                        class="max-w-full max-h-[calc(100vh-300px)] object-contain rounded-lg">

                    <!-- Next Button -->
                    <button id="nextBtn" onclick="changeTourImage(1)"
                        class="absolute right-4 z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full p-3 text-white transition-all cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Image Counter -->
                <div class="text-left mb-2 text-white">
                    <span id="tourGalleryCounter" class="text-sm"></span>
                </div>

                <!-- Thumbnail Carousel -->
                <div class="overflow-x-auto pb-2">
                    <div id="tourGalleryThumbnails" class="flex gap-2 justify-center">
                        <!-- Thumbnails will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Section -->
    <section id="booking" class="py-16 lg:py-24 bg-gradient-to-br from-amber-50 via-white to-green-50">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Ready to Start Your Adventure?</h2>
                <p class="text-xl text-gray-600 mb-8">Book your tour now and experience the beauty of Hà Giang</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/84968410676?text=Hello! I'm interested in {{ urlencode($tour->name) }}"
                        target="_blank"
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white px-10 py-4 rounded-lg font-semibold text-lg hover:from-green-500 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.375a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Book via WhatsApp
                    </a>
                    <a href="mailto:alleyhomestay@gmail.com?subject=Tour Inquiry: {{ urlencode($tour->name) }}"
                        class="bg-gradient-to-r from-amber-400 to-amber-600 text-white px-10 py-4 rounded-lg font-semibold text-lg hover:from-amber-500 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"
                                fill="currentColor" />
                        </svg>
                        Book via Email
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Other Tours Section -->
    @if ($otherTours->count() > 0)
        <section class="pb-8 bg-white">
            <div class="container mx-auto px-4 lg:px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Other Tours</h2>
                    <p class="text-xl text-gray-600">Explore more amazing adventures</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($otherTours as $otherTour)
                        <a href="{{ route('tours.show', $otherTour->slug) }}"
                            class="group block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                            @php
                                $firstLocation = $otherTour->tourDays->flatMap->locations->firstWhere(
                                    'thumbnail_image',
                                );
                            @endphp
                            @if ($firstLocation && $firstLocation->thumbnail_image)
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $firstLocation->thumbnail_image) }}"
                                        alt="{{ $otherTour->name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-6">
                                <span
                                    class="inline-block bg-amber-400 text-white px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    {{ $otherTour->duration }}
                                </span>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $otherTour->name }}</h3>
                                <p class="text-gray-600">{{ $otherTour->days }} Days / {{ $otherTour->nights }} Nights
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4"
        onclick="closeImageModal()">
        <div class="max-w-7xl w-full h-full flex items-center justify-center">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
            <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors"
                onclick="closeImageModal()">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    @push('styles')
        <!-- Air Datepicker CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Air Datepicker theme customization */
            .air-datepicker {
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                border: 1px solid #e5e7eb;
                font-family: inherit;
            }

            .air-datepicker-header {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                border-radius: 0.5rem 0.5rem 0 0;
                color: white;
            }

            .air-datepicker-nav--title {
                color: white;
                font-weight: 600;
            }

            .air-datepicker-nav--action {
                color: white;
            }

            .air-datepicker-nav--action:hover {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 0.25rem;
            }

            .air-datepicker-body--day-name {
                color: #6b7280;
                font-weight: 600;
            }

            .air-datepicker-cell {
                color: #374151;
                font-weight: 500;
            }

            .air-datepicker-cell.-day-:hover {
                background: #fef3c7;
                border-color: #f59e0b;
            }

            .air-datepicker-cell.-selected-,
            .air-datepicker-cell.-selected-.-current- {
                background: #f59e0b;
                border-color: #f59e0b;
                color: white;
                font-weight: 600;
            }

            .air-datepicker-cell.-selected-:hover {
                background: #d97706;
                border-color: #d97706;
            }

            .air-datepicker-cell.-current- {
                border-color: #f59e0b;
                color: #f59e0b;
                font-weight: 600;
            }

            .air-datepicker-cell.-current-:hover {
                background: #fef3c7;
            }

            .air-datepicker-cell.-disabled- {
                color: #d1d5db;
            }

            .air-datepicker-cell.-disabled-:hover {
                background: transparent;
            }
        </style>
        <style>
            .tour-title-animate {
                animation: fadeInUp 1s ease-out;
            }

            .day-header-animate {
                animation: slideInLeft 0.8s ease-out;
                opacity: 0;
                animation-fill-mode: forwards;
            }

            .day-info-animate {
                animation: fadeIn 0.8s ease-out 0.3s;
                opacity: 0;
                animation-fill-mode: forwards;
            }

            .location-animate {
                animation: slideInRight 0.8s ease-out;
                opacity: 0;
                animation-fill-mode: forwards;
            }

            .location-content-card {
                transition: all 0.3s ease;
            }

            .location-content-card:hover {
                transform: translateX(10px);
            }

            .timeline-line {
                animation: drawLine 2s ease-out;
            }

            .connection-line {
                animation: drawLine 0.5s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-50px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(50px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes drawLine {
                from {
                    height: 0;
                }

                to {
                    height: 100%;
                }
            }

            .location-marker {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.7);
                }

                50% {
                    transform: scale(1.05);
                    box-shadow: 0 0 0 10px rgba(251, 191, 36, 0);
                }
            }

            /* Intersection Observer animations */
            .timeline-day {
                opacity: 0;
                transform: translateY(50px);
                transition: all 0.8s ease-out;
            }

            .timeline-day.visible {
                opacity: 1;
                transform: translateY(0);
            }

            #imageModal {
                display: flex;
            }

            #imageModal.hidden {
                display: none;
            }

            /* Day Accordion Styles */
            .day-accordion-item {
                animation: slideInUp 0.5s ease-out backwards;
                transition: all 0.3s ease;
            }

            .day-accordion-item:nth-child(1) {
                animation-delay: 0.1s;
            }

            .day-accordion-item:nth-child(2) {
                animation-delay: 0.2s;
            }

            .day-accordion-item:nth-child(3) {
                animation-delay: 0.3s;
            }

            .day-accordion-item:nth-child(4) {
                animation-delay: 0.4s;
            }

            .day-accordion-item:nth-child(5) {
                animation-delay: 0.5s;
            }

            .day-accordion-item:nth-child(6) {
                animation-delay: 0.6s;
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .day-accordion-header {
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .day-accordion-header:hover {
                transform: translateX(4px);
            }

            .day-accordion-content {
                overflow: hidden;
            }

            .day-accordion-content.hidden {
                display: none;
            }

            .day-chevron {
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .day-chevron.rotate-180 {
                transform: rotate(180deg);
            }

            /* Location items animation */
            .location-item {
                animation: fadeInSlide 0.5s ease-out backwards;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .location-item:nth-child(1) {
                animation-delay: 0.1s;
            }

            .location-item:nth-child(2) {
                animation-delay: 0.2s;
            }

            .location-item:nth-child(3) {
                animation-delay: 0.3s;
            }

            .location-item:nth-child(4) {
                animation-delay: 0.4s;
            }

            .location-item:nth-child(5) {
                animation-delay: 0.5s;
            }

            @keyframes fadeInSlide {
                from {
                    opacity: 0;
                    transform: translateX(-15px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .location-item:hover {
                transform: translateY(-2px) scale(1.01);
            }
            
            .location-item:active {
                transform: translateY(-2px) scale(1.01);
            }

            .location-marker {
                transition: all 0.3s ease;
            }

            .location-item:hover .location-marker {
                transform: scale(1.1);
            }


            /* Line clamp for description */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Compact scrollbar */
            .overflow-x-auto::-webkit-scrollbar {
                height: 4px;
            }

            .overflow-x-auto::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 2px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb {
                background: #f59e0b;
                border-radius: 2px;
            }

            .overflow-x-auto::-webkit-scrollbar-thumb:hover {
                background: #d97706;
            }

            /* Fix date input on mobile */
            input[type="date"] {
                -webkit-appearance: none;
                appearance: none;
                position: relative;
            }

            input[type="date"]::-webkit-calendar-picker-indicator {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                opacity: 0.6;
            }

            input[type="date"]::-webkit-inner-spin-button,
            input[type="date"]::-webkit-clear-button {
                display: none;
            }

            /* Custom Dropdown Styles */
            [id$="Dropdown"] {
                animation: fadeInDown 0.2s ease-out;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Ensure text doesn't overlap on mobile */
            @media (max-width: 640px) {
                input[type="date"],
                select {
                    font-size: 14px;
                    padding-right: 2.5rem;
                }

                input[type="date"]::-webkit-calendar-picker-indicator {
                    right: 6px;
                    width: 20px;
                    height: 20px;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Air Datepicker JS -->
        <script src="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            // Vietnamese locale for Air Datepicker
            const vietnameseLocale = {
                days: ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'],
                daysShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                daysMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
                months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                monthsShort: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                today: 'Hôm nay',
                clear: 'Xóa',
                dateFormat: 'dd/MM/yyyy',
                timeFormat: 'HH:mm',
                firstDay: 1
            };

            document.addEventListener('DOMContentLoaded', function() {
                // Initialize AOS
                if (typeof AOS !== 'undefined') {
                    AOS.init({
                        duration: 800,
                        easing: 'ease-in-out',
                        once: true,
                        offset: 100
                    });
                }

                // Set all chevrons to point up initially (all accordions are closed)
                document.querySelectorAll('.day-chevron').forEach(chevron => {
                    chevron.style.transform = 'rotate(180deg)';
                });

                // Make toggleDayAccordion globally available
                window.toggleDayAccordion = toggleDayAccordion;
            });

            function toggleDayAccordion(dayNumber) {
                const content = document.getElementById(`content-${dayNumber}`);
                const chevron = document.getElementById(`chevron-${dayNumber}`);
                const header = document.querySelector(`[data-day="${dayNumber}"].day-accordion-header`);

                if (!content || !chevron) return;

                const isHidden = content.classList.contains('hidden');

                // Close all other open days first
                document.querySelectorAll('.day-accordion-content:not(.hidden)').forEach(otherContent => {
                    if (otherContent.id !== `content-${dayNumber}`) {
                        const otherDayNumber = otherContent.dataset.day;
                        const otherChevron = document.getElementById(`chevron-${otherDayNumber}`);
                        const otherHeader = document.querySelector(
                            `[data-day="${otherDayNumber}"].day-accordion-header`);

                        otherContent.classList.add('hidden');
                        if (otherChevron) {
                            otherChevron.style.transform = 'rotate(180deg)';
                        }
                        if (otherHeader) {
                            otherHeader.classList.remove('bg-gray-50');
                        }
                    }
                });

                if (isHidden) {
                    // Open this day - chevron points down (0deg)
                    content.classList.remove('hidden');
                    chevron.style.transform = 'rotate(0deg)';
                    if (header) {
                        header.classList.add('bg-gray-50');
                    }
                } else {
                    // Close this day - chevron points up (180deg)
                    content.classList.add('hidden');
                    chevron.style.transform = 'rotate(180deg)';
                    if (header) {
                        header.classList.remove('bg-gray-50');
                    }
                }
            }


            function openImageModal(imageSrc) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageSrc;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                const modal = document.getElementById('imageModal');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            function openImageGallery(images) {
                // Simple gallery - show first image, can be enhanced with a gallery library
                if (images && images.length > 0) {
                    openImageModal(images[0]);
                }
            }

            // Tour Gallery Functions
            let tourGalleryImages = [];
            let tourGalleryCurrentIndex = 0;

            function openTourGallery(images, startIndex = 0) {
                tourGalleryImages = images;
                tourGalleryCurrentIndex = startIndex;

                const modal = document.getElementById('tourGalleryModal');
                const mainImage = document.getElementById('tourGalleryMainImage');
                const thumbnailsContainer = document.getElementById('tourGalleryThumbnails');
                const counter = document.getElementById('tourGalleryCounter');

                if (!modal || !mainImage || !thumbnailsContainer) return;

                // Set main image
                mainImage.src = tourGalleryImages[tourGalleryCurrentIndex];

                // Generate thumbnails
                thumbnailsContainer.innerHTML = '';
                tourGalleryImages.forEach((img, index) => {
                    const thumbnail = document.createElement('div');
                    thumbnail.className =
                        `flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded overflow-hidden cursor-pointer border-2 transition-all ${index === tourGalleryCurrentIndex ? 'border-white' : 'border-transparent opacity-60 hover:opacity-100'}`;
                    thumbnail.onclick = () => {
                        tourGalleryCurrentIndex = index;
                        updateTourGallery();
                    };
                    const imgEl = document.createElement('img');
                    imgEl.src = img;
                    imgEl.alt = `Thumbnail ${index + 1}`;
                    imgEl.className = 'w-full h-full object-cover';
                    thumbnail.appendChild(imgEl);
                    thumbnailsContainer.appendChild(thumbnail);
                });

                // Update counter
                counter.textContent = `${tourGalleryCurrentIndex + 1} / ${tourGalleryImages.length}`;

                // Show modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                updateTourGallery();
            }

            function updateTourGallery() {
                const mainImage = document.getElementById('tourGalleryMainImage');
                const counter = document.getElementById('tourGalleryCounter');
                const thumbnails = document.querySelectorAll('#tourGalleryThumbnails > div');

                if (mainImage && tourGalleryImages.length > 0) {
                    mainImage.src = tourGalleryImages[tourGalleryCurrentIndex];
                }

                if (counter) {
                    counter.textContent = `${tourGalleryCurrentIndex + 1} / ${tourGalleryImages.length}`;
                }

                // Update thumbnail borders
                thumbnails.forEach((thumb, index) => {
                    if (index === tourGalleryCurrentIndex) {
                        thumb.classList.remove('border-transparent', 'opacity-60');
                        thumb.classList.add('border-white', 'opacity-100');
                    } else {
                        thumb.classList.remove('border-white', 'opacity-100');
                        thumb.classList.add('border-transparent', 'opacity-60');
                    }
                });
            }

            function changeTourImage(direction) {
                tourGalleryCurrentIndex += direction;

                if (tourGalleryCurrentIndex < 0) {
                    tourGalleryCurrentIndex = tourGalleryImages.length - 1;
                } else if (tourGalleryCurrentIndex >= tourGalleryImages.length) {
                    tourGalleryCurrentIndex = 0;
                }

                updateTourGallery();
            }

            function closeTourGallery() {
                const modal = document.getElementById('tourGalleryModal');
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            }

            // Close modal on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                    closeTourGallery();
                }
                // Arrow key navigation for tour gallery
                if (!document.getElementById('tourGalleryModal').classList.contains('hidden')) {
                    if (e.key === 'ArrowLeft') {
                        changeTourImage(-1);
                    } else if (e.key === 'ArrowRight') {
                        changeTourImage(1);
                    }
                }
            });

            // Booking Form Logic
            let bookingData = {
                tourPrice: {{ $tour->price ?? 0 }},
                outboundBus: null,
                returnBus: null,
                outboundBusPrice: 0,
                returnBusPrice: 0,
                selectedGift: null,
                selectedAccommodation: null,
                accommodationPrice: 0,
                adults: 2
            };

            // Tour Type Dropdown Logic
            const tourTypeBtn = document.getElementById('tourTypeBtn');
            const tourTypeDropdown = document.getElementById('tourTypeDropdown');
            const tourTypeIcon = document.getElementById('tourTypeIcon');
            const tourTypeText = document.getElementById('tourTypeText');
            const selectedTourTypeId = document.getElementById('selectedTourTypeId');
            const selectedTourTypeDisplay = document.getElementById('selectedTourTypeDisplay');

            if (tourTypeBtn && tourTypeDropdown) {
                // Toggle dropdown
                tourTypeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = tourTypeDropdown.classList.contains('hidden');
                    
                    // Close all other dropdowns
                    document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
                        if (dropdown !== tourTypeDropdown) {
                            dropdown.classList.add('hidden');
                        }
                    });
                    
                    if (isHidden) {
                        tourTypeDropdown.classList.remove('hidden');
                        tourTypeIcon.style.transform = 'rotate(180deg)';
                    } else {
                        tourTypeDropdown.classList.add('hidden');
                        tourTypeIcon.style.transform = 'rotate(0deg)';
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!tourTypeBtn.contains(e.target) && !tourTypeDropdown.contains(e.target)) {
                        tourTypeDropdown.classList.add('hidden');
                        tourTypeIcon.style.transform = 'rotate(0deg)';
                    }
                });
            }


            // Load bus services
            async function loadBusServices(direction, containerId) {
                try {
                    // Get filter value based on direction
                    let filterValue = '';
                    if (direction === 'outbound') {
                        filterValue = document.getElementById('busStartingPoint')?.value || '';
                    } else if (direction === 'return') {
                        filterValue = document.getElementById('busReturnDestination')?.value || '';
                    }

                    const response = await fetch(`{{ route('api.bus-services') }}?direction=${direction}`);
                    const services = await response.json();
                    
                    // Filter services based on selected point
                    let filteredServices = services;
                    if (filterValue) {
                        if (direction === 'outbound') {
                            filteredServices = services.filter(s => s.starting_point === filterValue);
                        } else if (direction === 'return') {
                            filteredServices = services.filter(s => s.return_destination === filterValue);
                        }
                    }
                    
                    const container = document.getElementById(containerId);
                    container.innerHTML = '';

                    if (filteredServices.length === 0) {
                        container.innerHTML = '<p class="text-sm text-gray-500">{{ __('tours.no_bus_services') }}</p>';
                        return;
                    }

                    filteredServices.forEach(service => {
                        const busOption = document.createElement('div');
                        busOption.className = 'border border-gray-300 rounded-lg p-3 cursor-pointer hover:border-amber-500 transition-colors';
                        busOption.onclick = () => selectBusService(direction, service.id, busOption);
                        
                        const isRecommended = service.is_recommended ? '<span class="bg-amber-500 text-white px-2 py-1 rounded text-xs font-semibold ml-2">RECOMMENDED</span>' : '';
                        
                        busOption.innerHTML = `
                            <div class="flex items-start gap-3">
                                <input type="radio" name="bus_${direction}" value="${service.id}" 
                                    class="mt-1 text-amber-500 focus:ring-amber-500 flex-shrink-0" 
                                    onchange="selectBusService('${direction}', ${service.id}, this.closest('div'))">
                                ${service.image ? `<img src="${service.image}" alt="${service.name}" class="w-20 h-16 object-cover rounded flex-shrink-0">` : '<div class="w-20 h-16 bg-gray-200 rounded flex-shrink-0"></div>'}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start gap-2 flex-wrap">
                                        <span class="font-semibold text-gray-900 break-words flex-1 min-w-0">${service.name}: ${service.departure_time}</span>
                                        ${isRecommended}
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1 break-words">${service.pick_up_location}</p>
                                    <p class="text-lg font-bold text-amber-600 mt-2">${formatPrice(service.price)} VND</p>
                                </div>
                            </div>
                        `;
                        container.appendChild(busOption);
                    });
                } catch (error) {
                    console.error('Error loading bus services:', error);
                }
            }

            // Select bus service
            function selectBusService(direction, serviceId, element) {
                // Update radio button
                const radio = element.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;

                // Remove selected class from all options
                const container = direction === 'outbound' ? 'outboundBusOptions' : 'returnBusOptions';
                document.querySelectorAll(`#${container} > div`).forEach(div => {
                    div.classList.remove('border-amber-500', 'bg-amber-50');
                    div.classList.add('border-gray-300');
                });

                // Add selected class to current option
                element.classList.remove('border-gray-300');
                element.classList.add('border-amber-500', 'bg-amber-50');

                // Store selected bus
                bookingData[direction === 'outbound' ? 'outboundBus' : 'returnBus'] = serviceId;
                calculateTotal();
            }

            // Load gifts
            async function loadGifts() {
                try {
                    const response = await fetch('{{ route("api.gifts") }}');
                    const gifts = await response.json();
                    
                    const container = document.getElementById('giftOptions');
                    container.innerHTML = '';

                    if (gifts.length === 0) {
                        container.innerHTML = '<p class="text-sm text-gray-500">{{ __('tours.no_gifts') }}</p>';
                        return;
                    }

                    gifts.forEach(gift => {
                        const giftOption = document.createElement('div');
                        giftOption.className = 'border border-gray-300 rounded-lg p-3 cursor-pointer hover:border-amber-500 transition-colors flex-shrink-0 w-32';
                        giftOption.onclick = () => selectGift(gift.id, giftOption);
                        
                        giftOption.innerHTML = `
                            <div class="flex flex-col items-center gap-2">
                                <input type="radio" name="gift" value="${gift.id}" 
                                    class="text-amber-500 focus:ring-amber-500" 
                                    onchange="selectGift(${gift.id}, this.closest('div'))">
                                ${gift.image ? `<img src="${gift.image}" alt="${gift.name}" class="w-full h-24 object-cover rounded">` : '<div class="w-full h-24 bg-gray-200 rounded"></div>'}
                                <span class="font-semibold text-gray-900 text-center text-xs break-words">${gift.name}</span>
                            </div>
                        `;
                        container.appendChild(giftOption);
                    });
                } catch (error) {
                    console.error('Error loading gifts:', error);
                }
            }

            // Select gift
            function selectGift(giftId, element) {
                // Update radio button
                const radio = element.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;

                // Remove selected class from all options
                document.querySelectorAll('#giftOptions > div').forEach(div => {
                    div.classList.remove('border-amber-500', 'bg-amber-50');
                    div.classList.add('border-gray-300');
                });

                // Add selected class to current option
                element.classList.remove('border-gray-300');
                element.classList.add('border-amber-500', 'bg-amber-50');

                // Store selected gift
                bookingData.selectedGift = giftId;
                calculateTotal();
            }

            // Load accommodations
            async function loadAccommodations() {
                try {
                    const response = await fetch('{{ route("api.accommodations") }}');
                    const accommodations = await response.json();
                    
                    const container = document.getElementById('accommodationOptions');
                    container.innerHTML = '';

                    if (accommodations.length === 0) {
                        container.innerHTML = '<p class="text-sm text-gray-500">{{ __('tours.no_accommodations') }}</p>';
                        return;
                    }

                    accommodations.forEach(accommodation => {
                        const accommodationOption = document.createElement('div');
                        accommodationOption.className = 'flex items-center gap-3 p-3 border border-gray-300 rounded-lg cursor-pointer hover:border-amber-500 transition-colors';
                        accommodationOption.onclick = () => selectAccommodation(accommodation.id, accommodationOption);
                        
                        const priceText = accommodation.price_per_night > 0 
                            ? `${accommodation.price_per_night.toLocaleString('vi-VN')}₫/night`
                            : '(No fees)';
                        
                        const capacityText = accommodation.capacity_min === accommodation.capacity_max
                            ? `${accommodation.capacity_min} people`
                            : `${accommodation.capacity_min}-${accommodation.capacity_max} people`;
                        
                        accommodationOption.innerHTML = `
                            <input type="radio" name="accommodation" value="${accommodation.id}" 
                                class="text-amber-500 focus:ring-amber-500" 
                                onchange="selectAccommodation(${accommodation.id}, this.closest('div'))">
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900 text-sm">${accommodation.name}</div>
                                ${accommodation.bed_type ? `<div class="text-xs text-gray-600">${accommodation.bed_type}</div>` : ''}
                                <div class="text-xs text-gray-500">${capacityText} - ${priceText}</div>
                            </div>
                        `;
                        container.appendChild(accommodationOption);
                    });
                } catch (error) {
                    console.error('Error loading accommodations:', error);
                }
            }

            // Select accommodation
            async function selectAccommodation(accommodationId, element) {
                // Update radio button
                const radio = element.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;

                // Remove selected class from all options
                document.querySelectorAll('#accommodationOptions > div').forEach(div => {
                    div.classList.remove('border-amber-500', 'bg-amber-50');
                    div.classList.add('border-gray-300');
                });

                // Add selected class to current option
                element.classList.remove('border-gray-300');
                element.classList.add('border-amber-500', 'bg-amber-50');

                // Store selected accommodation and fetch price
                bookingData.selectedAccommodation = accommodationId;
                try {
                    const response = await fetch('{{ route("api.accommodations") }}');
                    const accommodations = await response.json();
                    const selectedAccommodation = accommodations.find(a => a.id === accommodationId);
                    if (selectedAccommodation) {
                        // Ensure price is a number, not a string
                        bookingData.accommodationPrice = parseFloat(selectedAccommodation.price_per_night) || 0;
                    } else {
                        bookingData.accommodationPrice = 0;
                    }
                } catch (error) {
                    console.error('Error fetching accommodation price:', error);
                    bookingData.accommodationPrice = 0;
                }
                calculateTotal();
            }

            // Calculate total
            async function calculateTotal() {
                let total = 0;

                // Tour price multiplied by number of adults
                const adults = parseInt(document.getElementById('adultsCount').value) || 1;
                bookingData.adults = adults;

                // Tour price multiplied by number of adults
                total += bookingData.tourPrice * adults;

                // Outbound bus price (only if bus service is enabled, fixed price not multiplied by number of people)
                const useBusService = document.getElementById('useBusService')?.checked;
                if (useBusService && bookingData.outboundBus) {
                    try {
                        const response = await fetch(`{{ route('api.bus-services') }}?direction=outbound`);
                        const services = await response.json();
                        const selectedService = services.find(s => s.id === bookingData.outboundBus);
                        if (selectedService) {
                            total += selectedService.price; // Fixed price, not multiplied by number of people
                        }
                    } catch (error) {
                        console.error('Error calculating outbound bus:', error);
                    }
                }

                // Return bus price (only if bus service is enabled, fixed price not multiplied by number of people)
                if (useBusService && bookingData.returnBus) {
                    try {
                        const response = await fetch(`{{ route('api.bus-services') }}?direction=return`);
                        const services = await response.json();
                        const selectedService = services.find(s => s.id === bookingData.returnBus);
                        if (selectedService) {
                            total += selectedService.price; // Fixed price, not multiplied by number of people
                        }
                    } catch (error) {
                        console.error('Error calculating return bus:', error);
                    }
                }

                // Accommodation price (fixed price per room for the entire tour, NOT multiplied by nights or number of people)
                if (bookingData.selectedAccommodation && bookingData.accommodationPrice > 0) {
                    // Price is fixed per room for the entire tour (not multiplied by nights or number of people)
                    // Ensure accommodationPrice is a number
                    const accommodationPrice = parseFloat(bookingData.accommodationPrice) || 0;
                    total += accommodationPrice;
                }

                // Update tour price display (per person)
                const tourPriceDisplay = document.getElementById('tourPriceDisplay');
                if (tourPriceDisplay) {
                    tourPriceDisplay.textContent = formatPrice(bookingData.tourPrice) + ' VND';
                }
                

                // Update total display
                document.getElementById('bookingTotal').textContent = formatPrice(total) + ' VND';
            }

            // Format price
            function formatPrice(price) {
                return new Intl.NumberFormat('vi-VN').format(Math.round(price));
            }

            // Custom Dropdown Functions
            function toggleDropdown(dropdownId, iconId) {
                const dropdown = document.getElementById(dropdownId);
                const icon = document.getElementById(iconId);
                
                // Close all other dropdowns
                document.querySelectorAll('[id$="Dropdown"]').forEach(dd => {
                    if (dd.id !== dropdownId) {
                        dd.classList.add('hidden');
                        const otherIcon = document.getElementById(dd.id.replace('Dropdown', 'Icon'));
                        if (otherIcon) {
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });

                // Toggle current dropdown
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                } else {
                    dropdown.classList.add('hidden');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                }
            }

            // Load starting points from API
            async function loadStartingPoints() {
                try {
                    const response = await fetch('{{ route("api.bus-services.starting-points") }}');
                    const startingPoints = await response.json();
                    
                    const container = document.getElementById('busStartingPointOptions');
                    container.innerHTML = '';

                    if (startingPoints.length === 0) {
                        container.innerHTML = '<div class="px-4 py-2 text-sm text-gray-500 text-center">{{ __('tours.no_starting_points') }}</div>';
                        return;
                    }

                    startingPoints.forEach(point => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition-colors flex items-center gap-2';
                        button.onclick = () => selectStartingPoint(point, button);
                        button.innerHTML = `
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>${point}</span>
                        `;
                        container.appendChild(button);
                    });
                } catch (error) {
                    console.error('Error loading starting points:', error);
                    document.getElementById('busStartingPointOptions').innerHTML = '<div class="px-4 py-2 text-sm text-red-500 text-center">Error loading starting points</div>';
                }
            }

            // Load return destinations from API
            async function loadReturnDestinations() {
                try {
                    const response = await fetch('{{ route("api.bus-services.return-destinations") }}');
                    const returnDestinations = await response.json();
                    
                    const container = document.getElementById('busReturnDestinationOptions');
                    container.innerHTML = '';

                    if (returnDestinations.length === 0) {
                        container.innerHTML = '<div class="px-4 py-2 text-sm text-gray-500 text-center">{{ __('tours.no_return_destinations') }}</div>';
                        return;
                    }

                    returnDestinations.forEach(destination => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'w-full px-4 py-2.5 text-left text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition-colors flex items-center gap-2';
                        button.onclick = () => selectReturnDestination(destination, button);
                        button.innerHTML = `
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>${destination}</span>
                        `;
                        container.appendChild(button);
                    });
                } catch (error) {
                    console.error('Error loading return destinations:', error);
                    document.getElementById('busReturnDestinationOptions').innerHTML = '<div class="px-4 py-2 text-sm text-red-500 text-center">Error loading return destinations</div>';
                }
            }

            function selectStartingPoint(value, element) {
                const hiddenInput = document.getElementById('busStartingPoint');
                const textSpan = document.getElementById('busStartingPointText');
                const dropdown = document.getElementById('busStartingPointDropdown');
                const icon = document.getElementById('busStartingPointIcon');
                
                hiddenInput.value = value;
                textSpan.textContent = element.textContent.trim();
                textSpan.classList.remove('text-gray-700');
                textSpan.classList.add('text-gray-900', 'font-medium');
                
                dropdown.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
                
                // Trigger change event
                hiddenInput.dispatchEvent(new Event('change'));
            }

            function selectReturnDestination(value, element) {
                const hiddenInput = document.getElementById('busReturnDestination');
                const textSpan = document.getElementById('busReturnDestinationText');
                const dropdown = document.getElementById('busReturnDestinationDropdown');
                const icon = document.getElementById('busReturnDestinationIcon');
                
                hiddenInput.value = value;
                textSpan.textContent = element.textContent.trim();
                textSpan.classList.remove('text-gray-700');
                textSpan.classList.add('text-gray-900', 'font-medium');
                
                dropdown.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
                
                // Trigger change event
                hiddenInput.dispatchEvent(new Event('change'));
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('[id$="Btn"]') && !event.target.closest('[id$="Dropdown"]')) {
                    document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
                        dropdown.classList.add('hidden');
                        const iconId = dropdown.id.replace('Dropdown', 'Icon');
                        const icon = document.getElementById(iconId);
                        if (icon) icon.style.transform = 'rotate(0deg)';
                    });
                }
            });

            // Toggle bus service section visibility
            function toggleBusService() {
                const checkbox = document.getElementById('useBusService');
                const busSection = document.getElementById('busServiceSection');
                
                if (checkbox.checked) {
                    busSection.classList.remove('hidden');
                } else {
                    busSection.classList.add('hidden');
                    // Clear bus selections when hidden
                    bookingData.outboundBus = null;
                    bookingData.returnBus = null;
                    // Clear selected bus options
                    document.querySelectorAll('#outboundBusOptions input[type="radio"]').forEach(radio => {
                        radio.checked = false;
                    });
                    document.querySelectorAll('#returnBusOptions input[type="radio"]').forEach(radio => {
                        radio.checked = false;
                    });
                    // Clear bus option selections styling
                    document.querySelectorAll('#outboundBusOptions > div').forEach(div => {
                        div.classList.remove('border-amber-500', 'bg-amber-50');
                        div.classList.add('border-gray-300');
                    });
                    document.querySelectorAll('#returnBusOptions > div').forEach(div => {
                        div.classList.remove('border-amber-500', 'bg-amber-50');
                        div.classList.add('border-gray-300');
                    });
                    // Recalculate total
                    calculateTotal();
                }
            }

            // Initialize Flatpickr for date inputs
            function initDatePickers() {
                // Check if AirDatepicker is loaded
                if (typeof AirDatepicker === 'undefined') {
                    console.warn('AirDatepicker not loaded yet, retrying...');
                    setTimeout(initDatePickers, 200);
                    return;
                }

                const today = new Date();
                const minDate = today.toISOString().split('T')[0];

                // Helper function to initialize AirDatepicker
                function initDatePicker(element, options = {}) {
                    if (!element || element._datepicker) return;
                    
                    try {
                        const datepicker = new AirDatepicker(element, {
                            locale: vietnameseLocale,
                            dateFormat: 'dd/MM/yyyy',
                            minDate: minDate,
                            isMobile: window.innerWidth <= 768,
                            autoClose: true,
                            onSelect: function({date, formattedDate, datepicker}) {
                                // Format for backend (YYYY-MM-DD) - format directly without timezone conversion
                                if (date) {
                                    const year = date.getFullYear();
                                    const month = String(date.getMonth() + 1).padStart(2, '0');
                                    const day = String(date.getDate()).padStart(2, '0');
                                    const formattedDateISO = `${year}-${month}-${day}`;
                                    element.dataset.value = formattedDateISO;
                                    // Update display value
                                    element.value = formattedDate;
                                } else {
                                    element.dataset.value = '';
                                    element.value = '';
                                }
                            },
                            ...options
                        });
                        return datepicker;
                    } catch (e) {
                        console.error('Error initializing AirDatepicker:', e);
                        return null;
                    }
                }

                // Tour start date picker
                const tourStartDateEl = document.getElementById('tourStartDate');
                if (tourStartDateEl) {
                    initDatePicker(tourStartDateEl);
                }

                // Bus departure date picker
                const busDepartureDateEl = document.getElementById('busDepartureDate');
                if (busDepartureDateEl) {
                    initDatePicker(busDepartureDateEl);
                }

                // Bus return date picker
                const busReturnDateEl = document.getElementById('busReturnDate');
                if (busReturnDateEl) {
                    initDatePicker(busReturnDateEl);
                }
            }

            // Check Availability function - Redirect to checkout
            function checkAvailability() {
                const startDateInput = document.getElementById('tourStartDate');
                const startDate = startDateInput ? (startDateInput.dataset.value || startDateInput.value) : '';
                const displayDate = startDateInput ? startDateInput.value : '';
                const adults = document.getElementById('adultsCount').value;
                const totalPriceText = document.getElementById('bookingTotal').textContent;
                const totalPrice = parseFloat(totalPriceText.replace(/[^\d]/g, '')) || 0;
                const useBusService = document.getElementById('useBusService')?.checked;

                if (!startDate) {
                    alert('Vui lòng chọn ngày bắt đầu tour');
                    return;
                }

                // Build checkout URL with all booking details
                const params = new URLSearchParams({
                    tour_id: {{ $tour->id }},
                    tour_start_date: startDate,
                    adults: adults,
                    total_price: totalPrice,
                    use_bus: useBusService ? '1' : '0'
                });

                if (useBusService && bookingData.outboundBus) {
                    params.append('outbound_bus', bookingData.outboundBus);
                }
                if (useBusService && bookingData.returnBus) {
                    params.append('return_bus', bookingData.returnBus);
                }
                if (bookingData.selectedGift) {
                    params.append('gift', bookingData.selectedGift);
                }
                if (bookingData.selectedAccommodation) {
                    params.append('accommodation', bookingData.selectedAccommodation);
                }

                // Redirect to checkout page
                window.location.href = `{{ route('checkout.show') }}?${params.toString()}`;
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize date pickers first
                initDatePickers();

                // Load starting points and return destinations from API
                loadStartingPoints();
                loadReturnDestinations();

                // Load gifts
                loadGifts();

                // Load accommodations
                loadAccommodations();

                // Custom dropdown button click handlers
                document.getElementById('busStartingPointBtn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleDropdown('busStartingPointDropdown', 'busStartingPointIcon');
                });

                document.getElementById('busReturnDestinationBtn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleDropdown('busReturnDestinationDropdown', 'busReturnDestinationIcon');
                });

                // Load bus services when starting point is selected (only if bus service is enabled)
                document.getElementById('busStartingPoint').addEventListener('change', function() {
                    const useBusService = document.getElementById('useBusService')?.checked;
                    if (useBusService && this.value) {
                        loadBusServices('outbound', 'outboundBusOptions');
                    }
                });

                // Load bus services when return destination is selected (only if bus service is enabled)
                document.getElementById('busReturnDestination').addEventListener('change', function() {
                    const useBusService = document.getElementById('useBusService')?.checked;
                    if (useBusService && this.value) {
                        loadBusServices('return', 'returnBusOptions');
                    }
                });

                // Update total when people count changes
                document.getElementById('adultsCount').addEventListener('input', calculateTotal);

                // Initial total calculation
                calculateTotal();
            });

            // Match thumbnail height with detail image only (not including description)
            document.addEventListener('DOMContentLoaded', function() {
                const thumbnailImage = document.getElementById('thumbnailImage');
                const detailImage = document.querySelector('#detailImageContainer img');
                
                if (thumbnailImage && detailImage) {
                    const detailImageHeight = detailImage.offsetHeight;
                    thumbnailImage.style.height = detailImageHeight + 'px';
                }
            });
        </script>
    @endpush

@endsection
