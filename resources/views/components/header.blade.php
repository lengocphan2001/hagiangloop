<header class="fixed top-0 left-0 right-0 w-full z-50 transition-all duration-300" x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', function() {
    scrolled = window.scrollY > 100;
    if (scrolled) {
        $el.style.backgroundColor = '#111111';
        $el.style.boxShadow = '0 4px 16px 0 rgba(0, 0, 0, 0.25)';
    } else {
        $el.style.backgroundColor = 'transparent';
        $el.style.boxShadow = 'none';
    }
});"
    style="background-color: transparent; box-shadow: none;">
    <!-- Top Bar -->


    <nav class="w-full max-w-full px-4 lg:px-6 overflow-x-hidden">
        <!-- Top Bar -->
        <div x-show="!scrolled" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="hidden md:flex items-center justify-end text-sm py-2 transition-colors duration-300"
            :class="scrolled ? 'text-white' : 'text-white'">
            <div class="flex items-center space-x-4">
                <!-- Language Selector -->
                <div class="relative" x-data="{ langOpen: false }">
                    <button @click="langOpen = !langOpen"
                        class="flex items-center space-x-1 transition-colors duration-200"
                        :class="scrolled ? 'hover:text-gray-200' : 'hover:text-gray-300'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-xs uppercase">{{ strtoupper(app()->getLocale()) }}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Language Dropdown -->
                    <div x-show="langOpen" @click.away="langOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg py-2 z-50"
                        style="display: none;">
                        <a href="{{ route('language.switch', 'en') }}"
                            class="block px-4 py-2 text-xs text-gray-900 hover:bg-gray-100 transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-gray-100 font-semibold' : '' }}">
                            {{ __('common.english') }}
                        </a>
                        <a href="{{ route('language.switch', 'vi') }}"
                            class="block px-4 py-2 text-xs text-gray-900 hover:bg-gray-100 transition-colors duration-200 {{ app()->getLocale() === 'vi' ? 'bg-gray-100 font-semibold' : '' }}">
                            {{ __('common.vietnamese') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Navigation -->
        <div class="flex items-center justify-between h-20 md:h-24 w-full max-w-full">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center justify-center">
                <a href="{{ route('home') }}" class="flex items-center justify-center group">
                    <img src="{{ asset('images/alley-0.png') }}" alt="Alley HOMESTAY"
                        class="max-h-10 sm:max-h-10 md:max-h-20 w-auto object-contain transform origin-center transition-transform duration-300 group-hover:scale-105">
                </a>
            </div>
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center w-fit space-x-12 ml-auto"
                x-data="{ isHome: {{ request()->routeIs('home') ? 'true' : 'false' }} }">
                @php
                    $isHome = request()->routeIs('home');
                    $isAbout = request()->routeIs('page.show') && request()->route('slug') == 'about';
                    $isTours = request()->routeIs('tours.*');
                    $isNews = request()->routeIs('news.*');
                    $isContact = request()->routeIs('contact.*');
                @endphp
                <a href="{{ route('home') }}"
                    class="font-medium uppercase text-sm transition-colors duration-200 relative group"
                    :class="isHome ? 'text-amber-300' : (scrolled ? 'text-white' : 'text-white')">
                    {{ __('common.home') }}
                    @if ($isHome)
                        <span
                            class="absolute bottom-[-4px] left-0 w-full h-0.5 bg-amber-300 transition-all duration-300"></span>
                    @else
                        <span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 transition-all duration-300 group-hover:w-full bg-current"></span>
                    @endif
                </a>
                <a href="{{ route('page.show', 'about') }}" 
                    class="font-medium uppercase text-sm transition-colors duration-200 relative group {{ $isAbout ? 'text-amber-300' : 'text-white' }}"
                    :class="scrolled && !{{ $isAbout ? 'true' : 'false' }} ? 'text-white' : ''">
                    {{ __('common.about') }}
                    @if ($isAbout)
                        <span
                            class="absolute bottom-[-4px] left-0 w-full h-0.5 bg-amber-300 transition-all duration-300"></span>
                    @else
                        <span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 transition-all duration-300 group-hover:w-full bg-current"></span>
                    @endif
                </a>
                <a href="{{ route('tours.index') }}"
                    class="font-medium uppercase text-sm transition-colors duration-200 relative group {{ $isTours ? 'text-amber-300' : 'text-white' }}"
                    :class="scrolled && !{{ $isTours ? 'true' : 'false' }} ? 'text-white' : ''">
                    {{ __('common.tours') }}
                    @if ($isTours)
                        <span
                            class="absolute bottom-[-4px] left-0 w-full h-0.5 bg-amber-300 transition-all duration-300"></span>
                    @else
                        <span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 transition-all duration-300 group-hover:w-full bg-current"></span>
                    @endif
                </a>
                <a href="{{ route('news.index') }}" 
                    class="font-medium uppercase text-sm transition-colors duration-200 relative group {{ $isNews ? 'text-amber-300' : 'text-white' }}"
                    :class="scrolled && !{{ $isNews ? 'true' : 'false' }} ? 'text-white' : ''">
                    {{ __('common.news') }}
                    @if ($isNews)
                        <span
                            class="absolute bottom-[-4px] left-0 w-full h-0.5 bg-amber-300 transition-all duration-300"></span>
                    @else
                        <span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 transition-all duration-300 group-hover:w-full bg-current"></span>
                    @endif
                </a>
                <a href="{{ route('contact.index') }}"
                    class="font-medium uppercase text-sm transition-colors duration-200 relative group {{ $isContact ? 'text-amber-300' : 'text-white' }}"
                    :class="scrolled && !{{ $isContact ? 'true' : 'false' }} ? 'text-white' : ''">
                    {{ __('common.contact') }}
                    @if($isContact)
                        <span
                            class="absolute bottom-[-4px] left-0 w-full h-0.5 bg-amber-300 transition-all duration-300"></span>
                    @else
                        <span
                            class="absolute bottom-[-4px] left-0 w-0 h-0.5 transition-all duration-300 group-hover:w-full bg-current"></span>
                    @endif
                </a>

                <!-- Search Icon -->
                <button class="p-2 transition-colors duration-200 ml-4 cursor-pointer"
                    :class="scrolled ? 'text-white hover:text-gray-200' : 'text-white hover:text-gray-300'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- BOOKING Button -->
                <a href="{{ route('booking.index') }}"
                    class="px-8 py-3 bg-orange-400 hover:bg-orange-500 text-gray-900 font-semibold uppercase text-base rounded-lg transition-all duration-300 hover:shadow-lg transform hover:scale-105 ml-4 cursor-pointer">
                    {{ __('common.booking') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden p-2 rounded-lg transition-colors duration-200 flex-shrink-0 text-white hover:bg-white/20 cursor-pointer">
                <svg x-show="!open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <svg x-show="open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Sidebar -->
        <!-- Overlay -->
        <div x-show="open" 
            @click="open = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 z-40 md:hidden"
            style="display: none;">
        </div>
        
        <!-- Sidebar -->
        <div x-show="open" 
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-gradient-to-b from-[#111111] to-[#1a1a1a] shadow-2xl z-50 md:hidden overflow-y-auto"
            style="display: none;">
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <h2 class="text-xl font-bold text-white">{{ __('common.menu') }}</h2>
                    <button @click="open = false" class="p-2 text-white hover:bg-white/10 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        </button>
                </div>
                
                <!-- Sidebar Content -->
                <div class="flex-1 px-6 py-6 space-y-4">
                    <a href="{{ route('home') }}" 
                        @click="open = false"
                        class="block text-white font-medium text-lg py-3 border-b border-white/10 hover:text-amber-300 transition-colors {{ request()->routeIs('home') ? 'text-amber-300' : '' }}">
                        {{ __('common.home') }}
                    </a>
                    <a href="{{ route('page.show', 'about') }}" 
                        @click="open = false"
                        class="block text-white font-medium text-lg py-3 border-b border-white/10 hover:text-amber-300 transition-colors {{ request()->routeIs('page.show') && request()->route('slug') == 'about' ? 'text-amber-300' : '' }}">
                        {{ __('common.about') }}
                    </a>
                    <a href="{{ route('tours.index') }}" 
                        @click="open = false"
                        class="block text-white font-medium text-lg py-3 border-b border-white/10 hover:text-amber-300 transition-colors {{ request()->routeIs('tours.*') ? 'text-amber-300' : '' }}">
                        {{ __('common.tours') }}
                    </a>
                    <a href="{{ route('news.index') }}" 
                        @click="open = false"
                        class="block text-white font-medium text-lg py-3 border-b border-white/10 hover:text-amber-300 transition-colors {{ request()->routeIs('news.*') ? 'text-amber-300' : '' }}">
                        {{ __('common.news') }}
                    </a>
                    <a href="{{ route('contact.index') }}" 
                        @click="open = false"
                        class="block text-white font-medium text-lg py-3 border-b border-white/10 hover:text-amber-300 transition-colors {{ request()->routeIs('contact.*') ? 'text-amber-300' : '' }}">
                        {{ __('common.contact') }}
                    </a>
                    <a href="{{ route('booking.index') }}"
                        @click="open = false"
                        class="block bg-orange-400 hover:bg-orange-500 text-gray-900 font-semibold uppercase text-base text-center py-4 rounded-lg transition-all duration-300 hover:shadow-lg transform hover:scale-105 mt-6">
                        {{ __('common.booking') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
