<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Hà Giang Loop Tours'))</title>
    <meta name="description" content="@yield('description', 'Khám phá vẻ đẹp Hà Giang với các tour du lịch chất lượng cao')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-gray-900 overflow-x-hidden">
    <div id="app" class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('components.header')

        <!-- Hero Slider Section -->
        <section class="relative w-screen" style="position: relative;">
            <!-- Slider Images -->
            <div class="slider-container relative w-full" style="z-index: 1; position: relative;">
                <div class="slide active relative w-full" style="opacity: 1; z-index: 1; position: relative;">
                    <div class="relative w-full">
                        <img src="{{ asset('images/slider1.webp') }}" alt="Slider 1" class="slider-image" loading="eager">
                        <div class="absolute inset-0 bg-black/30" style="z-index: 10;"></div>
                        <div class="absolute top-0 left-0 right-0 h-60 bg-gradient-to-b from-black/90 via-black/70 to-transparent" style="z-index: 10;"></div>
                    </div>
                </div>
                <div class="slide absolute top-0 left-0 w-full" style="opacity: 0; z-index: 0; position: absolute;">
                    <div class="relative w-full">
                        <img src="{{ asset('images/slider2.webp') }}" alt="Slider 2" class="slider-image" loading="lazy">
                        <div class="absolute inset-0 bg-black/30" style="z-index: 10;"></div>
                        <div class="absolute top-0 left-0 right-0 h-60 bg-gradient-to-b from-black/90 via-black/70 to-transparent" style="z-index: 10;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="hero-content" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 999; display: flex; align-items: center; justify-content: center; pointer-events: none; width: 100%; height: 100%;">
                <div class="text-center max-w-4xl mx-auto px-4" style="pointer-events: auto;">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-4 md:mb-6 leading-tight">
                        Khám phá <span class="bg-gradient-to-r from-yellow-300 to-green-300 bg-clip-text text-transparent">Hà Giang</span>
                    </h1>
                    <p class="text-sm sm:text-base md:text-xl lg:text-2xl text-gray-200 mb-6 md:mb-8 leading-relaxed">
                        Trải nghiệm vẻ đẹp hoang sơ của vùng đất địa đầu Tổ quốc với những tour du lịch đáng nhớ
                    </p>
                </div>
            </div>

            <!-- Slider Controls -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex items-center justify-center">
                <div class="slider-dots flex space-x-2">
                    <button class="dot active w-3 h-3 rounded-full bg-white"></button>
                    <button class="dot w-3 h-3 rounded-full bg-white/50"></button>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')

        <!-- Floating Action Buttons - Fixed positions to prevent layout shift -->
        <div class="fixed bottom-6 right-6" x-data="{ showScrollTop: false }" x-init="window.addEventListener('scroll', () => { showScrollTop = window.scrollY > 300; })" style="width: 3.5rem; z-index: 9999; position: fixed; isolation: isolate;">
            <!-- Scroll to Top Button (bottom, fixed position) -->
            <button 
                x-show="showScrollTop"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="absolute bottom-0 right-0 w-12 h-12 rounded-full bg-amber-900 hover:bg-amber-800 text-white flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110"
                style="display: none;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </button>

            <!-- Gmail Button (fixed position) -->
            <a href="mailto:Mamashomestayhg@gmail.com" 
                target="_blank"
                class="floating-btn absolute bottom-[4rem] right-0 w-12 h-12 rounded-lg bg-white hover:bg-gray-100 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none">
                    <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" fill="#EA4335"/>
                </svg>
            </a>

            <!-- WhatsApp Button (fixed position) -->
            <a href="https://wa.me/84915121987" 
                target="_blank"
                class="floating-btn absolute bottom-[7.5rem] right-0 w-12 h-12 rounded-lg bg-[#25D366] hover:bg-[#20BA5A] flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110">
                <svg class="w-7 h-7" fill="white" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.375a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
            </a>

            <!-- Instagram Button (fixed position) -->
            <a href="https://www.instagram.com" 
                target="_blank"
                class="floating-btn absolute bottom-[11rem] right-0 w-12 h-12 rounded-lg flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
                style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);">
                <svg class="w-7 h-7" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>

        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Slider Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            const sliderContainer = document.querySelector('.slider-container');
            let currentSlide = 0;
            let autoSlideInterval;
            let isDragging = false;
            let startX = 0;
            let currentX = 0;
            let translateX = 0;

            function showSlide(index, animated = true) {
                const content = document.querySelector('.hero-content');
                
                // Change slide
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.add('active');
                        if (animated) {
                            slide.style.transition = 'opacity 0.8s ease-in-out';
                        }
                        slide.style.opacity = '1';
                        slide.style.zIndex = '1';
                    } else {
                        slide.classList.remove('active');
                        if (animated) {
                            slide.style.transition = 'opacity 0.8s ease-in-out';
                        }
                        slide.style.opacity = '0';
                        slide.style.zIndex = '0';
                    }
                });
                
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                    dot.style.backgroundColor = i === index ? 'white' : 'rgba(255, 255, 255, 0.5)';
                });
                
                // Animate content from bottom
                if (window.gsap && animated) {
                    gsap.fromTo(content, 
                        { opacity: 0, y: 100 },
                        { opacity: 1, y: 0, duration: 2, ease: 'power2.out' }
                    );
                } else if (animated) {
                    // Fallback CSS animation
                    content.style.opacity = '0';
                    content.style.transform = 'translateY(50px)';
                    setTimeout(() => {
                        content.style.transition = 'opacity 1.2s ease-out, transform 1.2s ease-out';
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0)';
                    }, 50);
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            // Touch/Mouse drag functionality
            function handleStart(e) {
                isDragging = true;
                stopAutoSlide();
                startX = e.touches ? e.touches[0].clientX : e.clientX;
                slides.forEach(slide => {
                    slide.style.transition = 'none';
                });
            }

            function handleMove(e) {
                if (!isDragging) return;
                e.preventDefault();
                currentX = e.touches ? e.touches[0].clientX : e.clientX;
                translateX = currentX - startX;
                
                // Apply transform to active slide
                const activeSlide = slides[currentSlide];
                if (activeSlide) {
                    activeSlide.style.transform = `translateX(${translateX}px)`;
                    activeSlide.style.opacity = `${1 - Math.abs(translateX) / 500}`;
                }
            }

            function handleEnd() {
                if (!isDragging) return;
                isDragging = false;
                
                const threshold = 100; // Minimum drag distance to trigger slide change
                
                if (Math.abs(translateX) > threshold) {
                    if (translateX > 0) {
                        prevSlide();
                    } else {
                        nextSlide();
                    }
                } else {
                    // Snap back to current slide
                    showSlide(currentSlide, false);
                }
                
                // Reset transform
                slides.forEach(slide => {
                    slide.style.transform = '';
                    slide.style.transition = 'opacity 0.8s ease-in-out';
                });
                
                startAutoSlide();
            }

            // Add event listeners for touch and mouse
            if (sliderContainer) {
                sliderContainer.addEventListener('touchstart', handleStart, { passive: false });
                sliderContainer.addEventListener('touchmove', handleMove, { passive: false });
                sliderContainer.addEventListener('touchend', handleEnd);
                
                sliderContainer.addEventListener('mousedown', handleStart);
                sliderContainer.addEventListener('mousemove', handleMove);
                sliderContainer.addEventListener('mouseup', handleEnd);
                sliderContainer.addEventListener('mouseleave', handleEnd);
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                    stopAutoSlide();
                    startAutoSlide();
                });
            });

            // Initialize first slide
            showSlide(0);
            // Start auto slide
            startAutoSlide();
        });
    </script>
    
    <!-- Slider Styles -->
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            z-index: 1 !important;
        }
        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 0;
            width: 100%;
        }
        .slide.active {
            opacity: 1 !important;
            z-index: 2 !important;
        }
        .slide img {
            width: 100%;
            object-fit: cover;
            display: block;
        }
        .hero-content {
            opacity: 1;
            transform: translateY(0);
            will-change: opacity, transform;
        }
    </style>
</body>
</html>

