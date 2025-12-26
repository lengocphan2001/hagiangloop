import './bootstrap';
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP plugins
if (typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);
}

// Initialize AOS (fallback for elements without GSAP)
AOS.init({
    duration: 1000,
    easing: 'ease-out-cubic',
    once: false,
    offset: 150,
    delay: 0,
});

// Scroll direction detection and animation reset logic
let lastScrollTop = 0;
let scrollDirection = 'down';

function resetAOSAnimations() {
    // Get all elements with AOS animations
    const aosElements = document.querySelectorAll('[data-aos]');
    
    aosElements.forEach(element => {
        const rect = element.getBoundingClientRect();
        const isInViewport = rect.top < window.innerHeight && rect.bottom > 0;
        
        // If element is out of viewport and scrolling up, reset animation
        if (!isInViewport && scrollDirection === 'up') {
            element.classList.remove('aos-animate');
            // Reset AOS data attributes to allow re-animation
            element.setAttribute('data-aos-once', 'false');
        }
    });
}

// Throttle scroll event for better performance
let scrollTimeout;
window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Determine scroll direction
    if (scrollTop > lastScrollTop) {
        scrollDirection = 'down';
    } else if (scrollTop < lastScrollTop) {
        scrollDirection = 'up';
    }
    
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    
    // Clear existing timeout
    clearTimeout(scrollTimeout);
    
    // Throttle the reset function
    scrollTimeout = setTimeout(() => {
        resetAOSAnimations();
    }, 50);
}, { passive: true });

// Make GSAP available globally
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();
