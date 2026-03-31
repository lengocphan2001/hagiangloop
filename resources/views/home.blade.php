@extends('layouts.app')

@section('title', __('common.home') . ' - Alley Homestay - Ha Giang Loop')

@section('content')
    <!-- Journey Highlight Section (fullwidth bg + floating card) -->
    


    @push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Journey Section Animations - CSS Fallback */
        .journey-text-animate {
            opacity: 0;
            transform: translateX(-100px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .journey-text-animate.animate {
            opacity: 1;
            transform: translateX(0);
        }
        
        .journey-image-animate {
            opacity: 0;
            transform: translateX(100px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .journey-image-animate.animate {
            opacity: 1;
            transform: translateX(0);
        }

        /* Homestay Section Animations - CSS Fallback */
        .homestay-text-animate {
            opacity: 0;
            transform: translateX(-100px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .homestay-text-animate.animate {
            opacity: 1;
            transform: translateX(0);
        }
        
        .homestay-image-animate {
            opacity: 0;
            transform: translateX(100px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        
        .homestay-image-animate.animate {
            opacity: 1;
            transform: translateX(0);
        }

        /* News Card Styles */
        .news-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-8px);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CSS Fallback animation using Intersection Observer
            if (!window.gsap || !window.ScrollTrigger) {
                const observerOptions = {
                    threshold: 0.2,
                    rootMargin: '0px 0px -100px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate');
                        }
                    });
                }, observerOptions);
                
                const journeyText = document.querySelector('.journey-text-animate');
                const journeyImage = document.querySelector('.journey-image-animate');
                const homestayText = document.querySelector('.homestay-text-animate');
                const homestayImage = document.querySelector('.homestay-image-animate');
                
                if (journeyText) observer.observe(journeyText);
                if (journeyImage) observer.observe(journeyImage);
                if (homestayText) observer.observe(homestayText);
                if (homestayImage) observer.observe(homestayImage);
            }
            // GSAP ScrollTrigger animations for zoom in/out
            if (window.gsap && window.ScrollTrigger) {
                // Features section
                gsap.utils.toArray('#features [data-aos="zoom-in"]').forEach((el, index) => {
                    gsap.fromTo(el, 
                        { scale: 0.8, opacity: 0 },
                        {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            delay: index * 0.05,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 80%',
                                end: 'top 20%',
                                toggleActions: 'play reverse play reverse'
                            }
                        }
                    );
                });

                // About section - zoom in for text
                const aboutText = document.querySelector('#about [data-aos="zoom-in"]');
                if (aboutText) {
                    gsap.fromTo(aboutText,
                        { scale: 0.8, opacity: 0 },
                        {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: aboutText,
                                start: 'top 80%',
                                end: 'top 20%',
                                toggleActions: 'play reverse play reverse'
                            }
                        }
                    );
                }

                // About section - zoom out for image
                const aboutImage = document.querySelector('#about [data-aos="zoom-out"]');
                if (aboutImage) {
                    gsap.fromTo(aboutImage,
                        { scale: 1.2, opacity: 0 },
                        {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: aboutImage,
                                start: 'top 80%',
                                end: 'top 20%',
                                toggleActions: 'play reverse play reverse'
                            }
                        }
                    );
                }

                // Contact section
                gsap.utils.toArray('#contact [data-aos="zoom-in"]').forEach((el, index) => {
                    gsap.fromTo(el,
                        { scale: 0.8, opacity: 0 },
                        {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            delay: index * 0.05,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 80%',
                                end: 'top 20%',
                                toggleActions: 'play reverse play reverse'
                            }
                        }
                    );
                });

                // Discover Tours Section - Images zoom in animation
                const discoverImages = document.querySelectorAll('.discover-tour-image');
                if (discoverImages.length > 0) {
                    discoverImages.forEach((el, index) => {
                        gsap.fromTo(el,
                            { scale: 0.8, opacity: 0 },
                            {
                                scale: 1,
                                opacity: 1,
                                duration: 0.5,
                                delay: index * 0.05,
                                ease: 'power2.out',
                                scrollTrigger: {
                                    trigger: el,
                                    start: 'top 80%',
                                    toggleActions: 'play none none reverse'
                                }
                            }
                        );
                    });
                }

                // Discover Tours Section - Text slide down animation
                const discoverText = document.querySelector('.discover-tour-text');
                if (discoverText) {
                    gsap.fromTo(discoverText,
                        { y: -100, opacity: 0 },
                        {
                            y: 0,
                            opacity: 1,
                            duration: 0.8,
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: discoverText,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            }
                        }
                    );
                }

                // Journey Section - Text slide from left
                const journeyText = document.querySelector('.journey-text-animate');
                if (journeyText) {
                    gsap.fromTo(journeyText,
                        { x: -100, opacity: 0 },
                        {
                            x: 0,
                            opacity: 1,
                            duration: 1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: journeyText,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            }
                        }
                    );
                }

                // Journey Section - Image slide from right
                const journeyImage = document.querySelector('.journey-image-animate');
                if (journeyImage) {
                    gsap.fromTo(journeyImage,
                        { x: 100, opacity: 0 },
                        {
                            x: 0,
                            opacity: 1,
                            duration: 1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: journeyImage,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            }
                        }
                    );
                }

                // Homestay Section - Text slide from left
                const homestayText = document.querySelector('.homestay-text-animate');
                if (homestayText) {
                    gsap.fromTo(homestayText,
                        { x: -100, opacity: 0 },
                        {
                            x: 0,
                            opacity: 1,
                            duration: 1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: homestayText,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            }
                        }
                    );
                }

                // Homestay Section - Image slide from right
                const homestayImage = document.querySelector('.homestay-image-animate');
                if (homestayImage) {
                    gsap.fromTo(homestayImage,
                        { x: 100, opacity: 0 },
                        {
                            x: 0,
                            opacity: 1,
                            duration: 1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: homestayImage,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            }
                        }
                    );
                }
            }
        });

        // Initialize AOS for news section
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100,
            });
        }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @endpush

    <!-- Features Section -->
    <!-- About / Tour Highlight Section -->
    <section id="about" class="mt-4 py-16 lg:py-20 bg-white border-gray-200">
        <div class="w-full mx-auto lg:w-full lg:mx-auto lg:px-8 mt-4 px-4"
            x-data='{
                slides: @json($homeSlidesArray),
                current: 0,
                timer: null,
                next() { this.current = (this.current + 1) % this.slides.length },
                prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
                startAuto() { this.stopAuto(); this.timer = setInterval(() => this.next(), 4500) },
                stopAuto() { if (this.timer) { clearInterval(this.timer); this.timer = null; } }
            }'
            x-init="startAuto()"
            @mouseenter="stopAuto()"
            @mouseleave="startAuto()">
            <div class="grid grid-cols-1 lg:grid-cols-3 rounded-tl-[70px] rounded-tr-none rounded-bl-none rounded-br-none border-t-4 border-l-4 border-amber-300 shadow-2xl overflow-hidden min-h-[520px] sm:min-h-[560px] lg:min-h-[70vh]">
                <!-- Text panel -->
                <div class="bg-white p-6 sm:p-8 lg:p-12 relative overflow-hidden min-h-[420px] sm:min-h-[500px] lg:min-h-[580px] flex lg:col-span-1 about-text-animate">
                    <template x-for="(slide, index) in slides" :key="`text-${index}`">
                        <div x-show="current === index"
                            x-transition.opacity.duration.700ms
                            x-transition.transform.duration.700ms
                            class="space-y-6 absolute inset-0 flex flex-col justify-center px-4 sm:px-6 lg:px-8 pb-20">
                            <div class="space-y-4 sm:space-y-6">
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight" x-text="slide.title"></h2>
                                <p class="text-sm md:text-base lg:text-lg text-gray-700 leading-relaxed" x-text="slide.desc"></p>
                            </div>

                            <template x-if="slide.link">
                                <a :href="slide.link"
                                    class="inline-block px-8 py-4 bg-amber-300 text-gray-900 font-semibold uppercase tracking-wide hover:bg-amber-200 transition shadow-sm w-fit cursor-pointer"
                                    x-text="slide.link_text || 'Discover Tour'"></a>
                            </template>
                            <template x-if="!slide.link">
                                <a href="{{ route('tours.index') }}"
                                    class="inline-block px-8 py-4 bg-amber-300 text-gray-900 font-semibold uppercase tracking-wide hover:bg-amber-200 transition shadow-sm w-fit cursor-pointer">
                                    Discover Tour
                                </a>
                            </template>
                        </div>
                    </template>

                    <!-- Fixed nav buttons -->
                    <div class="absolute bottom-6 left-6 sm:bottom-8 sm:left-8 flex items-center space-x-3 sm:space-x-4">
                        <button @click="prev"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-black hover:text-white transition cursor-pointer">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="next"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-black hover:text-white transition cursor-pointer">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Image panel -->
                <div class="relative min-h-[260px] sm:min-h-[360px] lg:min-h-full lg:col-span-2 about-image-animate">
                    <template x-for="(slide, index) in slides" :key="`img-${index}`">
                        <div x-show="current === index"
                            x-transition.opacity.duration.800ms
                            x-transition.transform.duration.800ms
                            class="absolute inset-0">
                            <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                        </div>
                    </template>

                    <div class="absolute bottom-4 sm:bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-2">
                        <template x-for="(slide, index) in slides" :key="`dot-${index}`">
                            <button @click="current = index"
                                class="w-2 h-2 rounded-full cursor-pointer"
                                :class="current === index ? 'bg-white' : 'bg-white/50'"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Tours Section -->
    @if(isset($featuredTours) && $featuredTours->count() > 0)
    <section class="py-16 border-t border-gray-200 bg-white">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Popular <span class="t">Tours</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choose your next Ha Giang Loop experience
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($featuredTours as $tour)
                    <article class="bg-white rounded-2xl overflow-hidden border border-gray-100 hover:border-amber-300 transition-all duration-300 hover:-translate-y-1 shadow-sm cursor-pointer"
                        onclick="window.location.href='{{ route('tours.show', $tour->slug) }}'">
                        <div class="relative h-60 bg-gray-100">
                            @if($tour->thumbnail_image)
                                <img src="{{ Storage::url($tour->thumbnail_image) }}" alt="{{ $tour->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/discovertours/model1.webp') }}" alt="{{ $tour->name }}"
                                    class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-3 left-3 bg-white/90 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $tour->days }}D/{{ $tour->nights }}N
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $tour->name }}</h3>
                            <p class="text-amber-600 font-bold text-lg mb-4">
                                {{ number_format($tour->price, 0, ',', '.') }} VND
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">View details</span>
                                <span class="text-amber-600 font-semibold">Book now</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('tours.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-amber-500 text-white rounded-lg font-semibold hover:bg-amber-600 transition-colors duration-300 shadow-lg cursor-pointer">
                    View All Tours
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News Section -->
    @if(isset($latestNews) && $latestNews->count() > 0)
    <section class="pb-16 border-t border-gray-200 py-16">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Latest <span class="t">News</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Stay updated with the latest news and stories from Ha Giang
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach($latestNews as $item)
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

                            <h3 class="text-xl font-bold text-gray-900 mb-3 break-words">
                                {{ $item->title }}
                            </h3>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $item->views }} views
                                </span>
                                <span class="text-blue-600 font-semibold flex items-center gap-1">
                                    Read More
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- View All News Link -->
            <div class="text-center mt-12">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-colors duration-300 shadow-lg cursor-pointer">
                    View All News
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>    
    @endif

    <!-- FAQs Section -->
    @if(isset($faqs) && $faqs->count() > 0)
    <section class="py-16 lg:py-24 bg-gradient-to-br from-gray-50 to-white border-t border-b border-gray-200">
        <div class="container mx-auto px-4 lg:px-6 max-w-6xl">
            <div class="text-center mb-12 lg:mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    {{ __('faq.title') }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('faq.subtitle') }}
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-3">
                @foreach($faqs as $index => $faq)
                    <div class="faq-item rounded-lg overflow-hidden transition-all duration-300">
                        <button 
                            type="button"
                            class="faq-question w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none transition-all duration-200 bg-white text-gray-900 cursor-pointer"
                            onclick="toggleFAQ({{ $index }})"
                            aria-expanded="false"
                            id="faq-btn-{{ $index }}">
                            <span class="font-semibold text-lg pr-4" id="faq-text-{{ $index }}">{{ $faq->question }}</span>
                            <svg 
                                class="faq-icon w-10 h-10 flex-shrink-0 transition-transform duration-300 text-gray-600 border border-gray-300 rounded-full p-2" 
                                id="faq-icon-{{ $index }}"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            class="faq-answer hidden px-6 py-4 leading-relaxed bg-white"
                            id="faq-answer-{{ $index }}">
                            <p class="text-gray-900">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@push('scripts')
<script>
    function toggleFAQ(index) {
        const answer = document.getElementById(`faq-answer-${index}`);
        const icon = document.getElementById(`faq-icon-${index}`);
        const button = document.getElementById(`faq-btn-${index}`);
        
        const isOpen = !answer.classList.contains('hidden');
        
        // Close all FAQs
        document.querySelectorAll('.faq-answer').forEach((el, idx) => {
            if (idx !== index) {
                el.classList.add('hidden');
                const otherIcon = document.getElementById(`faq-icon-${idx}`);
                const otherButton = document.getElementById(`faq-btn-${idx}`);
                const otherAnswerText = el.querySelector('p');
                
                otherIcon.classList.remove('rotate-180');
                otherIcon.classList.remove('text-white');
                otherIcon.classList.add('text-gray-600');
                otherButton.classList.remove('bg-gray-800', 'text-white');
                otherButton.classList.add('bg-white', 'text-gray-900');
                el.classList.remove('bg-gray-800');
                el.classList.add('bg-white');
                if (otherAnswerText) {
                    otherAnswerText.classList.remove('text-white');
                    otherAnswerText.classList.add('text-gray-900');
                }
            }
        });
        
        // Toggle current FAQ
        const answerText = answer.querySelector('p');
        if (isOpen) {
            answer.classList.add('hidden');
            answer.classList.remove('bg-gray-800');
            answer.classList.add('bg-white');
            icon.classList.remove('rotate-180');
            icon.classList.remove('text-white');
            icon.classList.add('text-gray-600');
            button.classList.remove('bg-gray-800', 'text-white');
            button.classList.add('bg-white', 'text-gray-900');
            if (answerText) {
                answerText.classList.remove('text-white');
                answerText.classList.add('text-gray-900');
            }
            button.setAttribute('aria-expanded', 'false');
        } else {
            answer.classList.remove('hidden');
            answer.classList.remove('bg-white');
            answer.classList.add('bg-gray-800');
            icon.classList.add('rotate-180');
            icon.classList.remove('text-gray-600');
            icon.classList.add('text-white');
            button.classList.remove('bg-white', 'text-gray-900');
            button.classList.add('bg-gray-800', 'text-white');
            if (answerText) {
                answerText.classList.remove('text-gray-900');
                answerText.classList.add('text-white');
            }
            button.setAttribute('aria-expanded', 'true');
        }
    }
</script>
@endpush

