@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', __('tours_index.title') . ' - Hà Giang Loop Tours')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden tours-hero-section">
    <div class="container mx-auto px-4 py-10 lg:px-6 z-10 flex flex-col items-center justify-center">
        <div class="text-center max-w-4xl">
            <div class="inline-block mb-6 hero-badge" data-aos="fade-down" data-aos-duration="600">
                <span class="bg-gradient-to-r from-amber-400 to-amber-600 text-white px-6 py-2 rounded-full font-semibold text-sm shadow-lg inline-block">
                    {{ __('tours_index.explore_adventures') }}
                </span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-bold text-black mb-6 hero-title" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                {{ __('tours_index.discover_ha_giang') }} <span class="">Hà Giang</span>
            </h1>
            <p class="text-xl lg:text-2xl text-black mb-8 hero-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                {{ __('tours_index.subtitle') }}
            </p>
        </div>
    </div>
</section>

<!-- Tours Grid Section -->
<section class="py-16 lg:py-24 bg-gradient-to-b from-gray-50 via-white to-gray-50">
    <div class="container mx-auto px-4 lg:px-6">
        @if($tours->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 items-stretch">
                @foreach($tours as $index => $tour)
                    <article class="tour-card bg-white rounded-3xl overflow-hidden transition-all duration-300 border border-gray-100 hover:border-amber-300 hover:-translate-y-1 group cursor-pointer"
                             onclick="window.location.href='{{ route('tours.show', $tour->slug) }}'">
                        <!-- Featured Image -->
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            @if($tour->thumbnail_image)
                                <img src="{{ Storage::url($tour->thumbnail_image) }}" 
                                     alt="{{ $tour->name }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            @else
                                @php
                                    $firstLocation = $tour->tourDays->flatMap->locations->firstWhere('thumbnail_image');
                                @endphp
                                @if($firstLocation && $firstLocation->thumbnail_image)
                                    <img src="{{ asset('storage/' . $firstLocation->thumbnail_image) }}" 
                                         alt="{{ $tour->name }}" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                @else
                                    <div class="relative h-64 bg-gradient-to-br from-amber-400 via-amber-300 to-green-400 flex items-center justify-center">
                                        <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                            @endif
                            <div class="absolute top-4 right-4 z-10">
                                <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-5 py-2.5 rounded-full font-bold text-sm shadow-xl backdrop-blur-sm border border-amber-400/30">
                                    {{ $tour->duration }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 sm:p-6 lg:p-8">
                            <div class="text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $tour->days }} {{ __('tours_index.days') }} / {{ $tour->nights }} {{ __('tours_index.nights') }}
                            </div>

                            <h2 class="text-xl font-bold text-gray-900 mb-3 break-words">
                                {{ $tour->name }}
                            </h2>

                            @if($tour->price)
                                <div class="mb-3">
                                    <span class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-amber-700 bg-clip-text text-transparent">{{ number_format($tour->price, 0) }}</span>
                                    <span class="text-gray-500 ml-1 text-sm">VND</span>
                                    <span class="text-gray-500 text-xs ml-1">/ {{ __('tours_index.per_person') }}</span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $tour->tourDays->sum(fn($day) => $day->locations->count()) }} {{ __('tours_index.locations') }}
                                </span>
                                <span class="text-blue-600 font-semibold flex items-center gap-1">
                                    {{ __('tours_index.view_details') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">{{ __('tours_index.no_tours_available') }}</h3>
                <p class="text-gray-500">{{ __('tours_index.check_back_soon') }}</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Hero Section Animations */
    .hero-badge {
        animation: bounceIn 0.8s ease-out;
    }

    .hero-title {
        animation: slideInUp 1s ease-out;
    }

    .hero-subtitle {
        animation: slideInUp 1s ease-out 0.2s;
        animation-fill-mode: both;
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(-50px);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1) translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Gradient Animation */
    @keyframes gradient {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
    }

    /* Ensure floating buttons are always on top - higher than any tour animations */
    .fixed.bottom-6.right-6 {
        z-index: 9999 !important;
        position: fixed !important;
        isolation: isolate !important;
    }

    /* Floating Animation for Decorative Elements - Only in tours hero section, NOT slider */
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

    /* Only apply to tours hero section decorative elements, exclude slider completely */
    .tours-hero-section .tours-hero-blob {
        animation: float 20s ease-in-out infinite;
    }

    .tours-hero-section .tours-hero-blob:nth-child(2) {
        animation-delay: 2s;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS - Only for tours section, exclude slider
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100,
            });
        }
    });
</script>
@endpush

@endsection
