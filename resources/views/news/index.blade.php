@extends('layouts.app')

@section('title', __('news.title') . ' - Alley Homestay - Ha Giang Loop')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white overflow-hidden">
    <div class="container mx-auto px-4 py-10 lg:px-6 flex flex-col items-center justify-center">
        <div class="text-center max-w-4xl">
            <div class="inline-block mb-6">
                <span class="bg-gradient-to-r from-amber-400 to-amber-600 text-white px-6 py-2 rounded-full font-semibold text-sm shadow-lg inline-block">
                    {{ __('news.latest_news') }}
                </span>
            </div>
            <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6">
                {{ __('news.news_and_updates') }} <span class="">{{ __('news.updates') }}</span>
            </h1>
            <p class="text-xl lg:text-2xl text-gray-600 mb-8">
                {{ __('news.subtitle') }}
            </p>
        </div>
    </div>
</section>

<!-- News Grid Section -->
<section class="py-16 lg:py-24">
    <div class="container mx-auto px-4 lg:px-6">
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach($news as $item)
                    <article class="news-card bg-white rounded-3xl overflow-hidden transition-all duration-300 border border-gray-100 hover:border-amber-300 hover:-translate-y-1 group cursor-pointer"
                             onclick="window.location.href='{{ route('news.show', $item->slug) }}'">
                        <!-- Featured Image -->
                        @if($item->featured_image)
                            <div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                <img src="{{ Storage::url($item->featured_image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            </div>
                        @else
                            <div class="relative h-64 bg-gradient-to-br from-blue-400 via-indigo-400 to-purple-400 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-4 sm:p-6 lg:p-8">
                            @if($item->published_at)
                                <div class="text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $item->published_at->format('M d, Y') }}
                                </div>
                            @endif

                            <h2 class="text-xl font-bold text-gray-900 mb-3 break-words">
                                {{ $item->title }}
                            </h2>

                            

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $item->views }} {{ __('news.views') }}
                                </span>
                                <span class="text-blue-600 font-semibold flex items-center gap-1">
                                    {{ __('news.read_more') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">{{ __('news.no_news_available') }}</h3>
                <p class="text-gray-500">{{ __('news.check_back_soon') }}</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
    }

    @media (max-width: 640px) {
        .line-clamp-3 {
            -webkit-line-clamp: 2;
        }
    }

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

    .news-hero-section .news-hero-blob {
        animation: float 20s ease-in-out infinite;
    }

    .news-hero-section .news-hero-blob:nth-child(2) {
        animation-delay: 2s;
    }

    /* News Hero Section Spacing */
    .news-hero-section {
        margin-top: 6rem !important;
        padding-top: 3rem !important;
        padding-bottom: 5rem !important;
    }

    @media (min-width: 1024px) {
        .news-hero-section {
            margin-top: 8rem !important;
            padding-top: 4rem !important;
            padding-bottom: 8rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

