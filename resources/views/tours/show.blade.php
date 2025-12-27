@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', $tour->name . ' - Hà Giang Loop Tours')

@section('content')
    <!-- Hero Section with Tour Info -->
    <section
        class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 overflow-hidden tour-detail-hero-section">
        <div class="absolute inset-0 tour-detail-hero-decorative">
            <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl tour-detail-hero-blob"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl tour-detail-hero-blob">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl tour-detail-hero-blob">
            </div>
        </div>
        <div class="container mx-auto px-4 lg:px-6 relative z-10 py-10 lg:py-16">
            <div class="max-w-4xl mx-auto text-center flex flex-col items-center justify-center">
                <div class="inline-block mb-6 flex items-center justify-center" data-aos="fade-down" data-aos-duration="600">
                    <span
                        class="bg-gradient-to-r from-purple-400 to-pink-400 text-white px-6 py-2 rounded-full font-bold text-lg shadow-lg backdrop-blur-sm border border-purple-300/30">
                        {{ $tour->duration }}
                    </span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold text-white mb-6 tour-title-animate text-center w-full"
                    data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    {{ $tour->name }}
                </h1>
                <p class="text-xl lg:text-2xl text-gray-200 mb-8 text-center w-full" data-aos="fade-up"
                    data-aos-duration="800" data-aos-delay="200">
                    {{ $tour->days }} Days / {{ $tour->nights }} Nights Adventure
                </p>
                @if ($tour->price)
                    <div class="mb-8 text-center w-full" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                        <span
                            class="text-5xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">{{ number_format($tour->price, 0) }}</span>
                        <span class="text-2xl text-gray-300"> VND</span>
                    </div>
                @endif
                @if ($tour->description)
                    <p class="text-lg text-gray-200 max-w-2xl mx-auto mb-8 text-center w-full" data-aos="fade-up"
                        data-aos-duration="800" data-aos-delay="400">
                        {{ $tour->description }}
                    </p>
                @endif

                <div class="flex flex-wrap justify-center items-center gap-4 w-full relative z-20" data-aos="fade-up"
                    data-aos-duration="800" data-aos-delay="500">
                    <a href="#itinerary"
                        class="relative z-20 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        View Itinerary
                    </a>
                    <a href="#booking"
                        class="relative z-20 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
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
                                                        <p class="font-semibold text-base">View all</p>
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
                            <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-4">Tour Itinerary</h2>
                        </div>
                        @foreach ($tour->tourDays as $dayIndex => $day)
                            <div id="day-{{ $day->day_number }}"
                                class="day-accordion-item mb-2 bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200"
                                data-day="{{ $day->day_number }}">
                                <!-- Day Accordion Header -->
                                <button onclick="toggleDayAccordion({{ $day->day_number }})"
                                    class="day-accordion-header w-full flex items-center justify-between px-4 py-2.5 hover:bg-gray-50 transition-colors duration-200 text-left"
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
                    <div class="sticky">
                        <div class="bg-white rounded-lg shadow-xl border border-gray-200 p-6">
                            <!-- Price Section -->
                            <div class="relative mb-6">
                                @if ($tour->price)
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <p class="text-sm text-gray-500 line-through">From
                                                {{ number_format($tour->price, 0) }} VND</p>
                                            <p class="text-3xl font-bold text-gray-900">
                                                {{ number_format($tour->price, 0) }}
                                                VND</p>
                                            <p class="text-sm text-gray-600 mt-1">per person</p>
                                        </div>
                                        <span
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm font-semibold">-55%</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4">+ Local Payment may apply</p>
                                @endif

                                <!-- Price Info -->
                                <div class="flex items-start gap-2 mb-4">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-xs text-gray-600">Price based on Private Double Room</p>
                                </div>
                            </div>

                            <!-- Date Selection -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                                <div class="relative">
                                    <input type="date" id="tourDate"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer">
                                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Adults Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Adults</label>
                                <div class="relative">
                                    <select id="tourAdults"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none appearance-none cursor-pointer bg-white">
                                        <option value="1">1 Adult</option>
                                        <option value="2" selected>2 Adults</option>
                                        <option value="3">3 Adults</option>
                                        <option value="4">4 Adults</option>
                                        <option value="5">5 Adults</option>
                                        <option value="6">6 Adults</option>
                                    </select>
                                    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 mb-4">
                                <button onclick="checkAvailability()"
                                    class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                                    Check Availability
                                </button>
                                <button
                                    class="w-12 h-12 border-2 border-gray-300 rounded-lg flex items-center justify-center hover:border-gray-400 transition-colors">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Guarantee -->
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="text-gray-600">Best price guarantee</span>
                                <a href="#" class="text-blue-600 hover:underline">Learn More</a>
                            </div>
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
                    <button onclick="closeTourGallery()" class="text-white hover:text-gray-300 transition-colors p-2">
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
                        class="absolute left-4 z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full p-3 text-white transition-all">
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
                        class="absolute right-4 z-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full p-3 text-white transition-all">
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
                    <a href="https://wa.me/84915121987?text=Hello! I'm interested in {{ urlencode($tour->name) }}"
                        target="_blank"
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white px-10 py-4 rounded-lg font-semibold text-lg hover:from-green-500 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.375a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                        Book via WhatsApp
                    </a>
                    <a href="mailto:Mamashomestayhg@gmail.com?subject=Tour Inquiry: {{ urlencode($tour->name) }}"
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
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
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
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                    opacity 0.4s ease-out;
                opacity: 0;
            }

            .day-accordion-content:not(.hidden) {
                max-height: 5000px;
                opacity: 1;
                animation: fadeInContent 0.4s ease-out 0.2s backwards;
            }

            .day-accordion-content.hidden {
                max-height: 0;
                opacity: 0;
            }

            .day-accordion-content>div {
                padding-top: 0;
                padding-bottom: 0;
                transition: padding 0.4s ease-out;
            }

            .day-accordion-content:not(.hidden)>div {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            @keyframes fadeInContent {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
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
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
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
                            otherChevron.classList.remove('rotate-180');
                        }
                        if (otherHeader) {
                            otherHeader.classList.remove('bg-gray-50');
                        }
                    }
                });

                if (isHidden) {
                    // Open this day
                    content.classList.remove('hidden');
                    chevron.classList.add('rotate-180');
                    if (header) {
                        header.classList.add('bg-gray-50');
                    }
                } else {
                    // Close this day (if clicking on already open day)
                    content.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
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

            // Check Availability function
            function checkAvailability() {
                const date = document.getElementById('tourDate').value;
                const adults = document.getElementById('tourAdults').value;

                if (!date) {
                    alert('Please select a date');
                    return;
                }

                // Redirect to WhatsApp with booking details
                const message = `Hello! I'm interested in booking {{ $tour->name }}.\nDate: ${date}\nAdults: ${adults}`;
                window.open(`https://wa.me/84915121987?text=${encodeURIComponent(message)}`, '_blank');
            }

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
