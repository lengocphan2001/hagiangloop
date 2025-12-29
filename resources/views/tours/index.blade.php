@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', __('tours_index.title') . ' - Hà Giang Loop Tours')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden tours-hero-section">
    <div class="absolute inset-0 tours-hero-decorative">
        <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl animate-pulse tours-hero-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-green-500/20 rounded-full blur-3xl animate-pulse tours-hero-blob" style="animation-delay: 1s;"></div>
        <div class=""></div>
    </div>
    <div class="container mx-auto px-4 py-10 lg:px-6 z-10 flex flex-col items-center justify-center">
        <div class="text-center max-w-4xl">
            <div class="inline-block mb-6 hero-badge" data-aos="fade-down" data-aos-duration="600">
                <span class="bg-gradient-to-r from-amber-400 to-amber-600 text-white px-6 py-2 rounded-full font-semibold text-sm shadow-lg inline-block transform hover:scale-110 transition-transform duration-300">
                    {{ __('tours_index.explore_adventures') }}
                </span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-bold text-white mb-6 hero-title" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                {{ __('tours_index.discover_ha_giang') }} <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-green-400 bg-clip-text text-transparent animate-gradient">Hà Giang</span>
            </h1>
            <p class="text-xl lg:text-2xl text-gray-300 mb-8 hero-subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
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
                    <div class="tour-card group cursor-pointer" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}"
                         data-aos-duration="600"
                         style="opacity: 1 !important; visibility: visible !important; display: flex !important; transform: translateZ(0);"
                         onclick="window.location.href='{{ route('tours.show', $tour->slug) }}'">
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden h-full flex flex-col hover:shadow-2xl transition-shadow duration-300 border border-gray-100 card-inner">
                            <!-- Image Section -->
                            <div class="relative h-72 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 rounded-t-3xl">
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
                                        <div class="w-full h-full bg-gradient-to-br from-amber-400 via-amber-300 to-green-400 flex items-center justify-center">
                                            <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                @endif
                                <div class="absolute top-4 right-4 z-10 duration-badge" data-aos="zoom-in" data-aos-delay="{{ ($index * 150) + 200 }}">
                                    <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-5 py-2.5 rounded-full font-bold text-sm shadow-xl backdrop-blur-sm border border-amber-400/30">
                                        {{ $tour->duration }}
                                    </span>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 z-10 image-content" data-aos="fade-up" data-aos-delay="{{ ($index * 150) + 300 }}">
                                    <h3 class="text-2xl lg:text-3xl font-bold text-white mb-2 drop-shadow-lg">{{ $tour->name }}</h3>
                                    <p class="text-white/95 text-sm font-medium">{{ $tour->days }} {{ __('tours_index.days') }} / {{ $tour->nights }} {{ __('tours_index.nights') }}</p>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6 lg:p-8 flex-grow flex flex-col bg-white min-h-0">
                                @if($tour->description)
                                    <p class="text-gray-700 mb-6 leading-relaxed line-clamp-3">{{ Str::limit($tour->description, 120) }}</p>
                                @endif

                                <!-- Tour Highlights -->
                                <div class="mb-6 space-y-3 highlights-container">
                                    <div class="flex items-center text-sm highlight-item" data-aos="fade-right" data-aos-delay="{{ ($index * 150) + 400 }}">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 mr-3 icon-box">
                                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">{{ $tour->tourDays->sum(fn($day) => $day->locations->count()) }} {{ __('tours_index.amazing_locations') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm highlight-item" data-aos="fade-right" data-aos-delay="{{ ($index * 150) + 500 }}">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-green-100 mr-3 icon-box">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">{{ $tour->days }} {{ __('tours_index.days_adventure') }}</span>
                                    </div>
                                </div>

                                <!-- Price -->
                                @if($tour->price)
                                    <div class="mb-6 pb-6 border-b border-gray-200 price-container" data-aos="fade-up" data-aos-delay="{{ ($index * 150) + 600 }}">
                                        <div class="flex items-baseline">
                                            <span class="text-4xl font-bold bg-gradient-to-r from-amber-600 to-amber-700 bg-clip-text text-transparent price-number">{{ number_format($tour->price, 0) }}</span>
                                            <span class="text-gray-500 ml-2 text-lg">VND</span>
                                        </div>
                                        <p class="text-gray-500 text-sm mt-1">{{ __('tours_index.per_person') }}</p>
                                    </div>
                                @endif

                                <!-- CTA Button -->
                                <a href="{{ route('tours.show', $tour->slug) }}" 
                                   class="block w-full bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 text-white text-center py-4 rounded-xl font-bold text-base hover:from-amber-600 hover:via-amber-700 hover:to-amber-800 transition-colors duration-300 shadow-lg hover:shadow-xl">
                                    {{ __('tours_index.view_details') }}
                                </a>
                            </div>
                        </div>
                    </div>
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

    /* Tour Card Animations - Prevent layout shift between items */
    .tour-card {
        min-height: 0;
        display: flex;
        flex-direction: column;
        opacity: 1;
        visibility: visible;
        position: relative;
        z-index: 1;
        transform: translateZ(0);
        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
        isolation: isolate;
        will-change: transform;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), z-index 0s 0.3s;
    }

    .tour-card:hover {
        z-index: 10;
        transform: translateZ(0) scale(1.02) translateY(-8px);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), z-index 0s;
    }

    /* Ensure floating buttons are always on top - higher than any tour animations */
    .fixed.bottom-6.right-6 {
        z-index: 9999 !important;
        position: fixed !important;
        isolation: isolate !important;
    }

    .card-inner {
        position: relative;
        overflow: visible;
    }

    .card-inner::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .tour-card:hover .card-inner::before {
        left: 100%;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 4.5em;
    }


    .tour-card .bg-white {
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
        min-height: 0;
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
    }

    .tour-card:hover .bg-white {
        border-color: rgba(251, 191, 36, 0.3);
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

    /* Highlights - Always visible, no animation on hover */
    .highlight-item {
        opacity: 1;
        transform: translateX(0);
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
                delay: 0
            });
        }

        // Force cards to be visible immediately - NO DELAY, NO WAITING
        const tourCards = document.querySelectorAll('.tour-card');
        tourCards.forEach(card => {
            // Force visibility immediately with !important
            card.style.setProperty('opacity', '1', 'important');
            card.style.setProperty('visibility', 'visible', 'important');
            card.style.setProperty('display', 'flex', 'important');
            card.style.setProperty('transform', 'translateY(0)', 'important');
        });
    });
</script>
@endpush

@endsection
