@extends('layouts.app')

@section('title', ($newsItem->meta_title ?? $newsItem->title) . ' - Alley Homestay - Ha Giang Loop')

@section('description', $newsItem->meta_description ?? $newsItem->excerpt)

@section('content')
    <!-- Hero Section -->
    <section
        class="relative bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 overflow-hidden news-detail-hero-section">
        @if($newsItem->featured_image)
            <div class="absolute inset-0">
                <img src="{{ Storage::url($newsItem->featured_image) }}" alt="{{ $newsItem->title }}"
                    class="w-full h-full object-cover opacity-20">
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-indigo-900/90 to-purple-900/90"></div>
        <div class="container mx-auto px-4 lg:px-6 relative z-10 py-16 lg:py-24">
            <div class="max-w-4xl mx-auto text-center">
                @if($newsItem->published_at)
                    <div class="text-sm text-gray-300 mb-4">
                        {{ $newsItem->published_at->format('F d, Y') }}
                    </div>
                @endif
                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6">
                    {{ $newsItem->title }}
                </h1>
                @if($newsItem->excerpt)
                    <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                        {{ $newsItem->excerpt }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Meta Information -->
    <section class="py-6 bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center justify-between text-sm text-gray-500">
                    <div class="flex items-center space-x-4">
                        <span>
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            {{ $newsItem->views }} views
                        </span>
                        @if($newsItem->published_at)
                            <span>
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $newsItem->published_at->format('M d, Y') }}
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('news.index') }}"
                        class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        Back to News
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg max-w-none tinymce-content">
                    {!! $newsItem->content !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Related News Section -->
    @if($relatedNews->count() > 0)
        <section class="py-16 lg:py-24 bg-gray-50">
            <div class="container mx-auto px-4 lg:px-6">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8 text-center">Related News</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedNews as $item)
                        <article
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow cursor-pointer"
                            onclick="window.location.href='{{ route('news.show', $item->slug) }}'">
                            @if($item->featured_image)
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ Storage::url($item->featured_image) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                                    {{ $item->title }}
                                </h3>
                                @if($item->excerpt)
                                    <p class="text-gray-600 text-sm line-clamp-2">{{ $item->excerpt }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* TinyMCE Content Styles - Same as pages/show.blade.php */
            .tinymce-content * {
                box-sizing: border-box !important;
                margin: 0 !important;
                padding: 0 !important;
                border: 0 !important;
                font-size: 100% !important;
                font: inherit !important;
                vertical-align: baseline !important;
                line-height: 1.75 !important;
            }

            .tinymce-content {
                font-family: Helvetica, Arial, sans-serif !important;
                font-size: 16px !important;
                line-height: 1.75 !important;
                color: #374151 !important;
                display: block !important;
            }

            .tinymce-content h1,
            .tinymce-content h2,
            .tinymce-content h3,
            .tinymce-content h4,
            .tinymce-content h5,
            .tinymce-content h6 {
                display: block !important;
                font-weight: 700 !important;
                color: #111827 !important;
                margin-top: 1.5em !important;
                margin-bottom: 0.5em !important;
                line-height: 1.2 !important;
            }

            .tinymce-content h1 {
                font-size: 2.25em !important;
            }

            .tinymce-content h2 {
                font-size: 1.875em !important;
            }

            .tinymce-content h3 {
                font-size: 1.5em !important;
            }

            .tinymce-content h4 {
                font-size: 1.25em !important;
            }

            .tinymce-content h5 {
                font-size: 1.125em !important;
            }

            .tinymce-content h6 {
                font-size: 1em !important;
            }

            .tinymce-content p {
                margin-top: 1em !important;
                margin-bottom: 1em !important;
                display: block !important;
            }

            .tinymce-content ul,
            .tinymce-content ol {
                margin-top: 1em !important;
                margin-bottom: 1em !important;
                padding-left: 2em !important;
                display: block !important;
                list-style-position: outside !important;
            }

            .tinymce-content ul {
                list-style-type: disc !important;
            }

            .tinymce-content ol {
                list-style-type: decimal !important;
            }

            .tinymce-content li {
                margin-top: 0.5em !important;
                margin-bottom: 0.5em !important;
                display: list-item !important;
            }

            .tinymce-content strong,
            .tinymce-content b {
                font-weight: 700 !important;
                color: #111827 !important;
            }

            .tinymce-content em,
            .tinymce-content i {
                font-style: italic !important;
            }

            .tinymce-content a {
                color: #3b82f6 !important;
                text-decoration: underline !important;
                font-weight: 500 !important;
            }

            .tinymce-content a:hover {
                color: #2563eb !important;
            }

            .tinymce-content img {
                max-width: 100% !important;
                height: auto !important;
                border-radius: 0.5rem !important;
                margin-top: 2em !important;
                margin-bottom: 2em !important;
                display: block !important;
            }

            .tinymce-content blockquote {
                border-left: 0.25rem solid #e5e7eb !important;
                padding-left: 1em !important;
                margin-top: 1.6em !important;
                margin-bottom: 1.6em !important;
                font-style: italic !important;
                color: #111827 !important;
                display: block !important;
            }

            .tinymce-content code {
                color: #111827 !important;
                font-weight: 600 !important;
                font-size: 0.875em !important;
                background-color: #f3f4f6 !important;
                padding: 0.125rem 0.375rem !important;
                border-radius: 0.25rem !important;
                font-family: monospace !important;
            }

            .tinymce-content pre {
                color: #e5e7eb !important;
                background-color: #1f2937 !important;
                overflow-x: auto !important;
                font-size: 0.875em !important;
                line-height: 1.7142857 !important;
                margin-top: 1.7142857em !important;
                margin-bottom: 1.7142857em !important;
                border-radius: 0.375rem !important;
                padding: 0.8571429em 1.1428571em !important;
                display: block !important;
            }

            .tinymce-content pre code {
                background-color: transparent !important;
                border-width: 0 !important;
                border-radius: 0 !important;
                padding: 0 !important;
                font-weight: 400 !important;
                color: inherit !important;
                font-size: inherit !important;
                font-family: inherit !important;
                line-height: inherit !important;
            }

            .tinymce-content table {
                width: 100% !important;
                table-layout: auto !important;
                text-align: left !important;
                margin-top: 2em !important;
                margin-bottom: 2em !important;
                font-size: 0.875em !important;
                line-height: 1.7142857 !important;
                border-collapse: collapse !important;
                display: table !important;
            }

            .tinymce-content thead {
                border-bottom: 1px solid #d1d5db !important;
                display: table-header-group !important;
            }

            .tinymce-content thead th {
                color: #111827 !important;
                font-weight: 600 !important;
                vertical-align: bottom !important;
                padding-right: 0.5714286em !important;
                padding-bottom: 0.5714286em !important;
                padding-left: 0.5714286em !important;
                display: table-cell !important;
            }

            .tinymce-content tbody {
                display: table-row-group !important;
            }

            .tinymce-content tbody td {
                vertical-align: baseline !important;
                padding-top: 0.5714286em !important;
                padding-right: 0.5714286em !important;
                padding-bottom: 0.5714286em !important;
                padding-left: 0.5714286em !important;
                display: table-cell !important;
            }

            .tinymce-content tbody tr {
                border-bottom: 1px solid #e5e7eb !important;
                display: table-row !important;
            }

            /* News Detail Hero Section Spacing */
            .news-detail-hero-section {
                margin-top: 6rem !important;
                padding-top: 3rem !important;
                padding-bottom: 5rem !important;
            }

            @media (min-width: 1024px) {
                .news-detail-hero-section {
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
            document.addEventListener('DOMContentLoaded', function () {
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