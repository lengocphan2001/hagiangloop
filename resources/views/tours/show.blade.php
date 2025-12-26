@extends('layouts.app')

@section('title', $tour->name . ' - Hà Giang Loop Tours')

@section('content')
<!-- Hero Section with Tour Info -->
<section class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 overflow-hidden tour-detail-hero-section">
    <div class="absolute inset-0 tour-detail-hero-decorative">
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse tour-detail-hero-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl animate-pulse tour-detail-hero-blob" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-pulse tour-detail-hero-blob" style="animation-delay: 0.5s;"></div>
    </div>
    <div class="container mx-auto px-4 lg:px-6 relative z-10 py-10 lg:py-16">
        <div class="max-w-4xl mx-auto text-center flex flex-col items-center justify-center">
            <div class="inline-block mb-6 flex items-center justify-center" data-aos="fade-down" data-aos-duration="600">
                <span class="bg-gradient-to-r from-purple-400 to-pink-400 text-white px-6 py-2 rounded-full font-bold text-lg shadow-lg backdrop-blur-sm border border-purple-300/30">
                    {{ $tour->duration }}
                </span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-bold text-white mb-6 tour-title-animate text-center w-full" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                {{ $tour->name }}
            </h1>
            <p class="text-xl lg:text-2xl text-gray-200 mb-8 text-center w-full" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                {{ $tour->days }} Days / {{ $tour->nights }} Nights Adventure
            </p>
            @if($tour->price)
                <div class="mb-8 text-center w-full" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <span class="text-5xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">{{ number_format($tour->price, 0) }}</span>
                    <span class="text-2xl text-gray-300"> VND</span>
                </div>
            @endif
            @if($tour->description)
                <p class="text-lg text-gray-200 max-w-2xl mx-auto mb-8 text-center w-full" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    {{ $tour->description }}
                </p>
            @endif
            <div class="flex flex-wrap justify-center items-center gap-4 w-full relative z-20" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                <a href="#itinerary" class="relative z-20 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    View Itinerary
                </a>
                <a href="#booking" class="relative z-20 bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-8 py-4 rounded-lg font-semibold hover:from-indigo-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Tour Itinerary Timeline -->
<section id="itinerary" class="bg-white relative overflow-hidden mt-4">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Tour Itinerary</h2>
            <p class="text-xl text-gray-600">Follow the journey day by day</p>
        </div>

        <div class="max-w-5xl mx-auto">
            @foreach($tour->tourDays as $dayIndex => $day)
                <div class="timeline-day mb-16 lg:mb-24" data-day="{{ $day->day_number }}">
                    <!-- Day Header -->
                    <div class="flex items-center mb-8 day-header-animate">
                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10 relative">
                            {{ $day->day_number }}
                        </div>
                        <div class="ml-6 flex-grow">
                            <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $day->title }}</h3>
                            @if($day->route)
                                <p class="text-lg text-gray-600 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $day->route }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Day Info -->
                    @if($day->breakfast_time || $day->departure_time || $day->notes)
                        <div class="bg-gradient-to-r from-amber-50 to-green-50 rounded-xl p-6 mb-8 day-info-animate">
                            <div class="space-y-4 md:grid md:grid-cols-3 md:gap-4 md:space-y-0">
                                @if($day->breakfast_time)
                                    <div class="flex items-start md:items-center">
                                        <svg class="w-6 h-6 mr-3 text-amber-500 flex-shrink-0 mt-1 md:mt-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 mb-1">Breakfast</p>
                                            <p class="font-semibold text-gray-900">{{ $day->breakfast_time->format('H:i') }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($day->departure_time)
                                    <div class="flex items-start md:items-center">
                                        <svg class="w-6 h-6 mr-3 text-green-500 flex-shrink-0 mt-1 md:mt-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-500 mb-1">Departure</p>
                                            <p class="font-semibold text-gray-900">{{ $day->departure_time->format('H:i') }}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($day->notes)
                                    <div class="flex items-start md:col-span-3 pt-2 md:pt-0">
                                        <svg class="w-6 h-6 mr-3 text-blue-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-gray-700 flex-1 break-words leading-relaxed">{{ $day->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Locations Timeline -->
                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-amber-400 via-green-400 to-amber-400 timeline-line hidden lg:block" 
                             style="display: {{ $dayIndex === 0 ? 'block' : 'none' }};"></div>
                        
                        <div class="space-y-8">
                            @foreach($day->locations as $locationIndex => $location)
                                <div class="location-item flex items-start location-animate" 
                                     data-location-index="{{ $locationIndex }}"
                                     style="animation-delay: {{ $locationIndex * 0.1 }}s;">
                                    <!-- Location Marker -->
                                    <div class="flex-shrink-0 relative z-10">
                                        <div class="w-12 h-12 lg:w-16 lg:h-16 rounded-full flex items-center justify-center shadow-lg location-marker 
                                            {{ $location->type === 'meal' ? 'bg-green-500' : ($location->type === 'accommodation' ? 'bg-blue-500' : 'bg-amber-500') }}">
                                            @if($location->type === 'meal')
                                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            @elseif($location->type === 'accommodation')
                                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <!-- Connection Line -->
                                        @if($locationIndex < $day->locations->count() - 1)
                                            <div class="absolute left-1/2 top-12 lg:top-16 w-0.5 h-8 bg-gradient-to-b from-amber-400 to-green-400 transform -translate-x-1/2 connection-line hidden lg:block"></div>
                                        @endif
                                    </div>

                                    <!-- Location Content -->
                                    <div class="lg:ml-6 flex-grow location-content-card">
                                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex-grow">
                                                    <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ $location->name }}</h4>
                                                    <div class="flex items-center gap-3 flex-wrap">
                                                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                                            {{ $location->type === 'meal' ? 'bg-green-100 text-green-700' : ($location->type === 'accommodation' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700') }}">
                                                            {{ ucfirst($location->type) }}
                                                        </span>
                                                        @if($location->arrival_time)
                                                            <span class="text-gray-500 text-sm flex items-center">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                {{ $location->arrival_time->format('H:i') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if($location->description)
                                                <p class="text-gray-700 mb-4">{{ $location->description }}</p>
                                            @endif

                                            <!-- Images Gallery -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                @if($location->thumbnail_image)
                                                    <div class="relative group overflow-hidden rounded-lg">
                                                        <img src="{{ asset('storage/' . $location->thumbnail_image) }}" 
                                                             alt="{{ $location->name }}" 
                                                             class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500 cursor-pointer"
                                                             onclick="openImageModal('{{ asset('storage/' . $location->thumbnail_image) }}')">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                                            <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($location->detail_images && count($location->detail_images) > 0)
                                                    @foreach(array_slice($location->detail_images, 0, 2) as $detailImage)
                                                        <div class="relative group overflow-hidden rounded-lg">
                                                            <img src="{{ asset('storage/' . $detailImage) }}" 
                                                                 alt="{{ $location->name }}" 
                                                                 class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500 cursor-pointer"
                                                                 onclick="openImageModal('{{ asset('storage/' . $detailImage) }}')">
                                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                                                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($location->detail_images && count($location->detail_images) > 2)
                                                        <div class="relative group overflow-hidden rounded-lg bg-gradient-to-br from-amber-400 to-green-400 flex items-center justify-center cursor-pointer h-48"
                                                             onclick="openImageGallery({{ json_encode(array_map(function($img) { return asset('storage/' . $img); }, $location->detail_images)) }})">
                                                            <div class="text-center text-white">
                                                                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                </svg>
                                                                <p class="font-bold">+{{ count($location->detail_images) - 2 }} More</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

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
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.375a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Book via WhatsApp
                </a>
                <a href="mailto:Mamashomestayhg@gmail.com?subject=Tour Inquiry: {{ urlencode($tour->name) }}" 
                   class="bg-gradient-to-r from-amber-400 to-amber-600 text-white px-10 py-4 rounded-lg font-semibold text-lg hover:from-amber-500 hover:to-amber-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                    <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none">
                        <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" fill="currentColor"/>
                    </svg>
                    Book via Email
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Other Tours Section -->
@if($otherTours->count() > 0)
<section class="py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Other Tours</h2>
            <p class="text-xl text-gray-600">Explore more amazing adventures</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($otherTours as $otherTour)
                <a href="{{ route('tours.show', $otherTour->slug) }}" 
                   class="group block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    @php
                        $firstLocation = $otherTour->tourDays->flatMap->locations->firstWhere('thumbnail_image');
                    @endphp
                    @if($firstLocation && $firstLocation->thumbnail_image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $firstLocation->thumbnail_image) }}" 
                                 alt="{{ $otherTour->name }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                    @endif
                    <div class="p-6">
                        <span class="inline-block bg-amber-400 text-white px-3 py-1 rounded-full text-sm font-semibold mb-3">
                            {{ $otherTour->duration }}
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $otherTour->name }}</h3>
                        <p class="text-gray-600">{{ $otherTour->days }} Days / {{ $otherTour->nights }} Nights</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
    <div class="max-w-7xl w-full h-full flex items-center justify-center">
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors" onclick="closeImageModal()">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Floating Animation for Decorative Elements - Tour Detail Hero Section */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) translateX(0px);
        }
        33% {
            transform: translateY(-20px) translateX(10px);
        }
        66% {
            transform: translateY(10px) translateX(-10px);
        }
    }

    /* Only apply to tour detail hero section decorative elements */
    .tour-detail-hero-section .tour-detail-hero-blob {
        animation: float 20s ease-in-out infinite;
    }

    .tour-detail-hero-section .tour-detail-hero-blob:nth-child(2) {
        animation-delay: 2s;
    }

    .tour-detail-hero-section .tour-detail-hero-blob:nth-child(3) {
        animation-delay: 1s;
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
        0%, 100% {
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

        // Intersection Observer for timeline animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Animate timeline line
                    const line = entry.target.querySelector('.timeline-line');
                    if (line) {
                        line.style.display = 'block';
                        line.style.animation = 'drawLine 1s ease-out';
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline-day').forEach(day => {
            timelineObserver.observe(day);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });

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

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
@endpush

@endsection

