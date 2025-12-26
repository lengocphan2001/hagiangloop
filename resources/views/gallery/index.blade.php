<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư Hồng Gallery - Hà Giang Loop Tours</title>
    <meta name="description" content="Khám phá những khoảnh khắc đẹp nhất của Hà Giang qua bộ sưu tập ảnh Thư Hồng">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #000;
            height: 100vh;
        }
        
        .gallery-title {
            font-family: 'Playfair Display', serif;
        }
        
        /* Main Slider Container */
        .slider-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Slide Item */
        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: scale(1.05);
            transition: opacity 0.8s ease, transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform, opacity;
            pointer-events: none;
        }
        
        .slide.active {
            opacity: 1;
            transform: scale(1);
            z-index: 2;
            pointer-events: all;
        }
        
        .slide.prev {
            transform: translateX(-100%) scale(0.95);
            z-index: 1;
        }
        
        .slide.next {
            transform: translateX(100%) scale(0.95);
            z-index: 1;
        }
        
        /* Image Styling */
        .slide-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            filter: brightness(0.85);
            transition: filter 0.6s ease;
            will-change: filter;
        }
        
        .slide.active .slide-image {
            filter: brightness(1);
        }
        
        /* Slide background để fill khoảng trống */
        .slide {
            background: #000;
        }
        
        /* Overlay Gradient */
        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                rgba(0, 0, 0, 0.4) 0%,
                rgba(0, 0, 0, 0.2) 50%,
                rgba(0, 0, 0, 0.6) 100%
            );
            z-index: 1;
        }
        
        /* Content Overlay */
        .slide-content {
            position: absolute;
            bottom: 180px;
            left: 0;
            right: 0;
            padding: 0 40px;
            z-index: 15;
            transform: translateY(0);
            opacity: 1;
            transition: opacity 0.6s ease, transform 0.6s ease;
            pointer-events: none;
        }
        
        .slide:not(.active) .slide-content {
            opacity: 0;
            transform: translateY(30px);
        }
        
        /* Title Animation */
        .slide-title {
            font-size: clamp(2rem, 5vw, 5rem);
            font-weight: 900;
            color: white;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.9), 0 2px 10px rgba(0, 0, 0, 0.8);
            display: block;
            position: relative;
            z-index: 16;
        }
        
        /* Subtitle Animation */
        .slide-subtitle {
            font-size: clamp(1rem, 2vw, 1.5rem);
            color: rgba(255, 255, 255, 0.95);
            display: block;
            position: relative;
            z-index: 16;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8);
        }
        
        /* Navigation Arrows */
        .nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 11;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.7;
        }
        
        .nav-arrow:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }
        
        .nav-arrow.prev {
            left: 30px;
        }
        
        .nav-arrow.next {
            right: 30px;
        }
        
        .nav-arrow svg {
            width: 24px;
            height: 24px;
            color: white;
        }
        
        /* Dots Navigation */
        .dots-container {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 11;
            display: flex;
            gap: 12px;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 30px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
        }
        
        .dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        
        .dot.active {
            background: white;
            width: 30px;
            border-radius: 15px;
        }
        
        .dot.active::before {
            transform: translate(-50%, -50%) scale(1);
        }
        
        .dot:hover {
            background: rgba(255, 255, 255, 0.7);
            transform: scale(1.2);
        }
        
        /* Counter */
        .slide-counter {
            position: absolute;
            top: 40px;
            right: 40px;
            z-index: 11;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Progress Bar */
        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
            z-index: 12;
            transition: width 0.1s linear;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        
        /* Thumbnail Strip */
        .thumbnail-strip {
            position: absolute;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 11;
            display: flex;
            gap: 10px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            max-width: 90%;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }
        
        .thumbnail-strip::-webkit-scrollbar {
            height: 4px;
        }
        
        .thumbnail-strip::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .thumbnail-strip::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
        
        .thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            opacity: 0.5;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .thumbnail:hover {
            opacity: 0.8;
            transform: scale(1.1);
        }
        
        .thumbnail.active {
            opacity: 1;
            border-color: white;
            transform: scale(1.15);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 50%, #fff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Particles Background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }
        
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particle-float 15s infinite;
        }
        
        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }
        
        /* Fullscreen Button */
        .fullscreen-btn {
            position: absolute;
            top: 40px;
            left: 40px;
            z-index: 10;
            width: 50px;
            height: 50px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
        }
        
        .fullscreen-btn:hover {
            background: rgba(0, 0, 0, 0.5);
            transform: scale(1.1);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-arrow {
                width: 45px;
                height: 45px;
            }
            
            .nav-arrow.prev {
                left: 15px;
            }
            
            .nav-arrow.next {
                right: 15px;
            }
            
            .slide-content {
                bottom: 140px;
                padding: 0 20px;
            }
            
            .slide-counter {
                top: 20px;
                right: 20px;
                font-size: 0.9rem;
                padding: 8px 15px;
            }
            
            .fullscreen-btn {
                top: 20px;
                left: 20px;
                width: 40px;
                height: 40px;
            }
            
            .thumbnail-strip {
                bottom: 80px;
            }
            
            .thumbnail {
                width: 60px;
                height: 45px;
            }
        }
        
        /* Loading Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div class="loader" id="loader">
        <div class="spinner"></div>
    </div>
    
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>
    
    <!-- Main Slider Container -->
    <div class="slider-container" id="sliderContainer">
        @if(count($images) > 0)
            @foreach($images as $index => $image)
                <div class="slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    <img src="{{ $image['path'] }}" alt="{{ $image['name'] }}" class="slide-image">
                    <div class="slide-overlay"></div>
                </div>
            @endforeach
            
            <!-- Navigation Arrows -->
            <button class="nav-arrow prev" id="prevBtn" onclick="changeSlide(-1)">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="nav-arrow next" id="nextBtn" onclick="changeSlide(1)">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Slide Counter -->
            <div class="slide-counter" style="z-index: 11;">
                <span id="currentSlide">1</span> / <span id="totalSlides">{{ count($images) }}</span>
            </div>
            
            <!-- Fullscreen Button -->
            <button class="fullscreen-btn" id="fullscreenBtn" onclick="toggleFullscreen()" style="z-index: 11;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                </svg>
            </button>
            
            <!-- Progress Bar -->
            <div class="progress-bar" id="progressBar"></div>
            
            <!-- Thumbnail Strip -->
            <div class="thumbnail-strip">
                @foreach($images as $index => $image)
                    <img src="{{ $image['path'] }}" 
                         alt="Thumbnail {{ $index + 1 }}" 
                         class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                         onclick="goToSlide({{ $index }})">
                @endforeach
            </div>
            
            <!-- Dots Navigation -->
            <div class="dots-container">
                @foreach($images as $index => $image)
                    <div class="dot {{ $index === 0 ? 'active' : '' }}" 
                         onclick="goToSlide({{ $index }})"
                         data-index="{{ $index }}"></div>
                @endforeach
            </div>
        @else
            <div class="slide active">
                <div class="slide-overlay"></div>
                <div class="slide-content" style="transform: translateY(0); opacity: 1;">
                    <h2 class="slide-title gradient-text">Chưa có ảnh</h2>
                    <p class="slide-subtitle">Gallery đang trống</p>
                </div>
            </div>
        @endif
    </div>
    
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        let autoPlayInterval;
        let progressInterval;
        const autoPlayDelay = 4000; // 4 seconds for smoother transitions
        
        // Initialize
        function init() {
            if (totalSlides === 0) return;
            
            updateSlide();
            startAutoPlay();
            createParticles();
            
            // Hide loader after images load
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.getElementById('loader').classList.add('hidden');
                }, 500);
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') changeSlide(-1);
                if (e.key === 'ArrowRight') changeSlide(1);
                if (e.key === 'Escape') exitFullscreen();
            });
            
            // Touch swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            
            document.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            document.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                if (touchEndX < touchStartX - 50) changeSlide(1);
                if (touchEndX > touchStartX + 50) changeSlide(-1);
            }
        }
        
        // Go to specific slide
        function goToSlide(index) {
            if (slides.length === 0) return;
            stopAutoPlay();
            
            requestAnimationFrame(() => {
                currentSlide = index;
                updateSlide();
                startAutoPlay();
            });
        }
        
        // Auto play
        function startAutoPlay() {
            stopAutoPlay();
            autoPlayInterval = setInterval(() => {
                changeSlide(1);
            }, autoPlayDelay);
            
            startProgressBar();
        }
        
        function stopAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
            }
            resetProgressBar();
        }
        
        
        // Pause on hover
        document.getElementById('sliderContainer').addEventListener('mouseenter', stopAutoPlay);
        document.getElementById('sliderContainer').addEventListener('mouseleave', startAutoPlay);
        
        // Fullscreen
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.log('Error attempting to enable fullscreen:', err);
                });
            } else {
                document.exitFullscreen();
            }
        }
        
        function exitFullscreen() {
            if (document.fullscreenElement) {
                document.exitFullscreen();
            }
        }
        
        // Create particles (reduced for performance)
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 15; // Reduced from 30
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (10 + Math.random() * 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        // Preload images for smooth transitions
        function preloadImages() {
            const images = document.querySelectorAll('.slide-image');
            images.forEach(img => {
                const imageElement = new Image();
                imageElement.src = img.src;
            });
        }
        
        // Optimized auto play with requestAnimationFrame
        let progressStartTime = null;
        let progressAnimationFrame = null;
        
        function startProgressBar() {
            const progressBar = document.getElementById('progressBar');
            progressStartTime = performance.now();
            
            function animateProgress(currentTime) {
                if (!progressStartTime) {
                    progressStartTime = currentTime;
                }
                
                const elapsed = currentTime - progressStartTime;
                const progress = Math.min((elapsed / autoPlayDelay) * 100, 100);
                
                progressBar.style.width = progress + '%';
                
                if (progress < 100) {
                    progressAnimationFrame = requestAnimationFrame(animateProgress);
                } else {
                    progressStartTime = null;
                }
            }
            
            progressAnimationFrame = requestAnimationFrame(animateProgress);
        }
        
        function resetProgressBar() {
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = '0%';
            if (progressAnimationFrame) {
                cancelAnimationFrame(progressAnimationFrame);
            }
            progressStartTime = null;
        }
        
        // Optimized change slide function
        function changeSlide(direction) {
            if (slides.length === 0) return;
            
            stopAutoPlay();
            
            // Use requestAnimationFrame for smooth transition
            requestAnimationFrame(() => {
                currentSlide += direction;
                
                if (currentSlide < 0) {
                    currentSlide = totalSlides - 1;
                } else if (currentSlide >= totalSlides) {
                    currentSlide = 0;
                }
                
                updateSlide();
                startAutoPlay();
            });
        }
        
        // Optimized update slide
        function updateSlide() {
            requestAnimationFrame(() => {
                slides.forEach((slide, index) => {
                    slide.classList.remove('active', 'prev', 'next');
                    
                    if (index === currentSlide) {
                        slide.classList.add('active');
                    } else if (index === currentSlide - 1 || (currentSlide === 0 && index === totalSlides - 1)) {
                        slide.classList.add('prev');
                    } else if (index === currentSlide + 1 || (currentSlide === totalSlides - 1 && index === 0)) {
                        slide.classList.add('next');
                    }
                });
                
                // Update dots
                document.querySelectorAll('.dot').forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
                
                // Update thumbnails
                document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
                    thumb.classList.toggle('active', index === currentSlide);
                });
                
                // Update counter
                document.getElementById('currentSlide').textContent = currentSlide + 1;
                
                // Reset progress bar
                resetProgressBar();
            });
        }
        
        // Initialize on load
        init();
        
        // Preload images after DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', preloadImages);
        } else {
            preloadImages();
        }
    </script>
</body>
</html>
