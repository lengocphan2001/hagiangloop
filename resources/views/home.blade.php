@extends('layouts.app')

@section('title', 'Trang chủ - Hà Giang Loop Tours')

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
    <!-- Discover Tours Section -->
    <section class="bg-white overflow-hidden discover-tour-section w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]" style="margin-top: 0 !important; padding-top: 0 !important;">
        <div class="flex flex-col lg:flex-row w-full max-w-none px-0">
            <div class="grid grid-cols-2 gap-0 w-full lg:w-2/3 lg:flex-shrink-0">
                <!-- Left Column - 2 images stacked -->
                <div class="flex flex-col w-full">
                    <!-- Tour Image 1 -->
                    <div class="relative group cursor-pointer discover-tour-image w-full">
                        <div class="relative w-full flex items-center justify-center bg-black/10">
                            <img src="{{ asset('images/discovertours/980-songlung2_1699348959.jpg.webp') }}" 
                                 alt="Tour 1" 
                                 class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>

                    <!-- Tour Image 2 -->
                    <div class="relative group cursor-pointer discover-tour-image w-full">
                        <div class="relative w-full flex items-center justify-center bg-black/10">
                            <img src="{{ asset('images/discovertours/dis_tour3_1699346015.jpg.webp') }}" 
                                 alt="Tour 2" 
                                 class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>
                </div>

                <!-- Right Column - 2 images stacked -->
                <div class="flex flex-col w-full">
                    <!-- Tour Image 3 -->
                    <div class="relative group cursor-pointer discover-tour-image w-full">
                        <div class="relative w-full flex items-center justify-center bg-black/10">
                            <img src="{{ asset('images/discovertours/dis_tour4_1699346018.jpg.webp') }}" 
                                 alt="Tour 3" 
                                 class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>

                    <!-- Tour Image 4 -->
                    <div class="relative group cursor-pointer discover-tour-image w-full">
                        <div class="relative w-full flex items-center justify-center bg-black/10">
                            <img src="{{ asset('images/discovertours/du-lich-ha-giang-5_1699348959.jpg.webp') }}" 
                                 alt="Tour 4" 
                                 class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-110">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3 lg:min-w-0 bg-gradient-to-b from-orange-50 to-orange-100 relative overflow-hidden">
                <div class="p-6 sm:p-8 lg:p-12 h-full flex flex-col justify-start mt-8 lg:mt-0 relative z-10 discover-tour-text">
                    <!-- Heading -->
                    <h2 class="text-xl sm:text-2xl lg:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 leading-tight">
                        The majestic natural<br>
                        beauty eagerly awaits<br>
                        your discovery
                    </h2>
                    
                    <!-- Body Text -->
                    <p class="text-xs sm:text-sm text-gray-700 mb-6 sm:mb-8 leading-relaxed max-w-lg">
                        Welcome to Mama's Homestay website! Here, we extend an invitation for you to embark on an exhilarating adventure through the picturesque countryside of Vietnam— all from the saddle of a motorbike. Our motorbike tours promise a distinctive and authentic journey, revealing the breathtaking landscapes and hidden gems of this captivating country.
                    </p>
                    
                    <!-- CTA Button -->
                    <a href="{{ route('tours.index') }}" 
                       class="inline-block px-6 sm:px-8 lg:px-10 py-3 sm:py-4 bg-black text-white font-bold text-sm sm:text-base lg:text-lg rounded-lg border-2 border-white hover:bg-gray-900 transform transition-all duration-300 hover:scale-105 w-fit">
                        DISCOVER TOUR
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About / Tour Highlight Section -->
    <section id="about" class="py-16 lg:py-20 bg-white">
        <div class="w-5/7 max-w-[1500px] ml-auto lg:w-full lg:mx-auto lg:px-8"
            x-data="{
                slides: [
                    {
                        title: 'Quan Ba Twin Mountain - Fairy Mountain',
                        desc: 'In addition to the Quan Ba Heaven Gate, the Twin Mountains leave a deep impression on every visitor—an iconic masterpiece sculpted by nature.',
                        image: '{{ asset('images/discovertours/980-songlung2_1699348959.jpg.webp') }}'
                    },
                    {
                        title: 'Skyline Over The Loop',
                        desc: 'Misty ridges, layered peaks, and golden light at dawn paint an unforgettable panorama across Ha Giang.',
                        image: '{{ asset('images/discovertours/dis_tour3_1699346015.jpg.webp') }}'
                    },
                    {
                        title: 'Terraced Fields Season',
                        desc: 'Emerald rice terraces wrap the valleys, inviting you to ride through serene villages and sweeping curves.',
                        image: '{{ asset('images/discovertours/dis_tour4_1699346018.jpg.webp') }}'
                    },
                    {
                        title: 'Valley In The Clouds',
                        desc: 'Rolling hills and drifting clouds reveal the Loop’s gentle side—a perfect pause between thrilling passes.',
                        image: '{{ asset('images/discovertours/du-lich-ha-giang-5_1699348959.jpg.webp') }}'
                    }
                ],
                current: 0,
                timer: null,
                next() { this.current = (this.current + 1) % this.slides.length; },
                prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
                startAuto() { this.stopAuto(); this.timer = setInterval(() => this.next(), 4500); },
                stopAuto() { if (this.timer) { clearInterval(this.timer); this.timer = null; } }
            }"
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

                            <a href="{{ route('tours.index') }}"
                                class="inline-block px-8 py-4 bg-amber-300 text-gray-900 font-semibold uppercase tracking-wide hover:bg-amber-200 transition shadow-sm w-fit">
                                Discover Tour
                            </a>
                        </div>
                    </template>

                    <!-- Fixed nav buttons -->
                    <div class="absolute bottom-6 left-6 sm:bottom-8 sm:left-8 flex items-center space-x-3 sm:space-x-4">
                        <button @click="prev"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-black hover:text-white transition">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="next"
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border border-gray-300 flex items-center justify-center hover:bg-black hover:text-white transition">
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
                                class="w-2 h-2 rounded-full"
                                :class="current === index ? 'bg-white' : 'bg-white/50'"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="relative py-16 lg:py-24 lg:pb-72 overflow-hidden mt-8">
        <!-- Background full width -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/jouney/journey.webp') }}" alt="Journey background" class="w-full h-3/4 object-cover">
            <div class="absolute inset-0 bg-gradient-to-r h-3/4 from-black/80 via-black/65 to-black/25"></div>
        </div>

        <div class="relative z-10 w-full max-w-full mx-auto px-4 lg:px-12 overflow-hidden">
            <!-- Main content block -->
            <div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-4">
                <div class="text-amber-100 space-y-10 max-w-2xl w-full journey-text-animate">
                    <div class="space-y-4">
                        <p class="text-lg tracking-[0.08em] uppercase text-amber-200">Journey to conquer but you are</p>
                        <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight text-amber-100">
                            really single-minded because of<br>
                            <span class="text-amber-300">Mama's Tour</span>
                        </h2>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 rounded-full border border-amber-300 flex items-center justify-center">
                                <svg class="w-7 h-7 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.8L12 21l-6.879-3.196z"/>
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-lg font-semibold text-amber-50">Accompanying you with peace of mind</p>
                                <p class="text-sm text-amber-200/80">Safety, guidance, and reliable support throughout every ride.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 rounded-full border border-amber-300 flex items-center justify-center">
                                <svg class="w-7 h-7 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v6l9 4 9-4V7"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l9 4 9-4"/>
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-lg font-semibold text-amber-50">Understand beauty and culture</p>
                                <p class="text-sm text-amber-200/80">Dive into local traditions, cuisine, and the stories behind every pass.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 rounded-full border border-amber-300 flex items-center justify-center">
                                <svg class="w-7 h-7 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 22h14l-2-7H7l-2 7z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6"/>
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <p class="text-lg font-semibold text-amber-50">Cost savings</p>
                                <p class="text-sm text-amber-200/80">Optimized routes and services so you enjoy more with smart spending.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Floating right image card -->
                <div class="relative mt-10 lg:mt-0 w-full lg:w-auto journey-image-animate">
                    <div class="relative rounded-tl-[48px] rounded-tr-none rounded-bl-none rounded-br-none overflow-hidden shadow-2xl border border-white/20">
                        <div class="w-full aspect-[2/1]">
                            <img src="{{ asset('images/jouney/journey.webp') }}" alt="Journey with Mama's Tour" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest News Section -->
    @if(isset($latestNews) && $latestNews->count() > 0)
    <section class="pb-16 bg-gradient-to-b from-gray-50 via-white to-gray-50">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Latest <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">News</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Stay updated with the latest news and stories from Hà Giang
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                @foreach($latestNews as $item)
                    <article class="news-card bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 border border-gray-100 group cursor-pointer"
                             data-aos="fade-up" 
                             data-aos-delay="{{ $loop->index * 100 }}"
                             data-aos-duration="600"
                             onclick="window.location.href='{{ route('news.show', $item->slug) }}'">
                        <!-- Featured Image -->
                        @if($item->featured_image)
                            <div class="relative h-64 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                <img src="{{ Storage::url($item->featured_image) }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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

                            <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors break-words">
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
                                <span class="text-blue-600 font-semibold group-hover:text-blue-700 transition-colors flex items-center gap-1">
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
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transform transition-all duration-300 hover:scale-105 shadow-lg">
                    View All News
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>    
    @endif
@endsection

