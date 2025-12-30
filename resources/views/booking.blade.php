@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', __('booking.title') . ' - Hà Giang Loop Tours')

@section('content')
<section class="relative py-8 lg:py-12 min-h-screen overflow-hidden">
    <!-- Decorative Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-white to-amber-50"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-200/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-200/30 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="relative container mx-auto px-4 lg:px-6 max-w-7xl z-10">
        <!-- Header -->
        <div class="text-center mb-8 lg:mb-12">
            <div class="inline-block mb-4">
                <div class="flex items-center justify-center gap-2 px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full shadow-lg border border-amber-200">
                    <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-semibold text-gray-700">{{ __('booking.title') }}</span>
                </div>
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold bg-gradient-to-r from-amber-600 via-amber-500 to-amber-400 bg-clip-text text-transparent mb-4">
                {{ __('booking.title') }}
            </h1>
            <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">{{ __('booking.subtitle') }}</p>
        </div>

        <!-- Progress Steps -->
        <div class="flex justify-center items-center mb-8 lg:mb-12 px-2">
            <div class="flex items-start justify-center max-w-4xl mx-auto">
                <div class="flex items-start w-full gap-1 sm:gap-2 lg:gap-4">
                    <!-- Step 1: Select Tour -->
                    <div class="flex items-start flex-1 min-w-0" id="step1-indicator">
                        <div class="flex flex-col items-center flex-1 min-w-0">
                            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-sm lg:text-base border-4 border-white shadow-lg step-circle active flex-shrink-0">
                                1
                            </div>
                            <span class="mt-2 text-[10px] sm:text-xs lg:text-sm font-medium text-gray-700 text-center whitespace-nowrap leading-tight">{{ __('booking.select_tour') }}</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-1 sm:mx-2 lg:mx-4 step-line mt-5 lg:mt-6 flex-shrink"></div>
                    </div>

                    <!-- Step 2: Tour Type & Date -->
                    <div class="flex items-start flex-1 min-w-0" id="step2-indicator">
                        <div class="flex flex-col items-center flex-1 min-w-0">
                            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm lg:text-base border-4 border-white shadow-lg step-circle flex-shrink-0">
                                2
                            </div>
                            <span class="mt-2 text-[10px] sm:text-xs lg:text-sm font-medium text-gray-500 text-center whitespace-nowrap leading-tight">{{ __('booking.select_date') }}</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-1 sm:mx-2 lg:mx-4 step-line mt-5 lg:mt-6 flex-shrink"></div>
                    </div>

                    <!-- Step 3: Bus & Gifts -->
                    <div class="flex items-start flex-1 min-w-0" id="step3-indicator">
                        <div class="flex flex-col items-center flex-1 min-w-0">
                            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm lg:text-base border-4 border-white shadow-lg step-circle flex-shrink-0">
                                3
                            </div>
                            <span class="mt-2 text-[10px] sm:text-xs lg:text-sm font-medium text-gray-500 text-center whitespace-nowrap leading-tight">{{ __('booking.bus_services') }}</span>
                        </div>
                        <div class="flex-1 h-1 bg-gray-200 mx-1 sm:mx-2 lg:mx-4 step-line mt-5 lg:mt-6 flex-shrink"></div>
                    </div>

                    <!-- Step 4: Summary -->
                    <div class="flex items-start flex-1 min-w-0" id="step4-indicator">
                        <div class="flex flex-col items-center flex-1 min-w-0">
                            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold text-sm lg:text-base border-4 border-white shadow-lg step-circle flex-shrink-0">
                                4
                            </div>
                            <span class="mt-2 text-[10px] sm:text-xs lg:text-sm font-medium text-gray-500 text-center whitespace-nowrap leading-tight">{{ __('booking.summary') }}</span>
                        </div>
                        <!-- Empty spacer to match step 3 structure -->
                        <div class="flex-1 h-1 mx-1 sm:mx-2 lg:mx-4 mt-5 lg:mt-6 flex-shrink invisible"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white/90 backdrop-blur-lg overflow-visible rounded-2xl shadow-2xl border border-white/50">
                <!-- Step 1: Select Tour -->
                <div id="step1" class="step-content p-6 lg:p-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg">
                                <span class="text-2xl font-bold text-white">1</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ __('booking.step') }} 1: {{ __('booking.select_tour') }}</h2>
                            <p class="text-gray-500 mt-1">{{ __('booking.select_tour_description') }}</p>
                        </div>
                    </div>
                    
                    <div class="max-w-2xl mx-auto">
                        <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4 px-2">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            {{ __('booking.select_tour') }}
                        </label>
                        <div class="relative z-50">
                            <button type="button" id="tourSelectBtn" 
                                class="w-full px-4 py-3 text-left border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white flex items-center justify-between cursor-pointer hover:border-amber-400 transition-colors">
                                <span id="tourSelectText" class="text-gray-700">{{ __('booking.select_tour') }}</span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform" id="tourSelectIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="tourSelectDropdown" class="hidden absolute z-[60] w-full mt-1 bg-white border-2 border-gray-300 rounded-lg shadow-xl overflow-hidden max-h-96 overflow-y-auto">
                                <div class="py-1" id="tourSelectOptions">
                                    @foreach($tours as $tour)
                                        <button type="button" class="w-full px-4 py-3 text-left text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition-colors flex items-start gap-3 tour-option cursor-pointer" 
                                                data-tour-id="{{ $tour->id }}"
                                                data-tour-slug="{{ $tour->slug }}"
                                                onclick="selectTour({{ $tour->id }}, '{{ $tour->slug }}', '{{ addslashes($tour->name) }}', this)">
                                            <div class="flex-1 min-w-0">
                                                <div class="font-semibold text-gray-900 mb-1">{{ $tour->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $tour->days }} {{ __('tours_index.days') }} / {{ $tour->nights }} {{ __('tours_index.nights') }}</div>
                                                @if($tour->description)
                                                    <div class="text-xs text-gray-600 mt-1 line-clamp-2">{{ Str::limit($tour->description, 100) }}</div>
                                                @endif
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" id="selectedTourId" value="">
                        </div>

                        <!-- Selected Tour Preview -->
                        <div id="selectedTourPreview" class="hidden mt-6 p-6 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl border-2 border-amber-300 shadow-lg">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2" id="selectedTourName"></h3>
                                    <p class="text-sm text-gray-600" id="selectedTourDetails"></p>
                                </div>
                                <button type="button" onclick="clearTourSelection()" class="flex-shrink-0 w-8 h-8 rounded-lg bg-white hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors shadow-sm cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button id="step1-next" 
                                class="group px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2"
                                onclick="nextStep(2)" disabled>
                            <span>{{ __('booking.next') }}</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Tour Type & Date -->
                <div id="step2" class="step-content hidden p-6 lg:p-10">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-bold text-white">2</span>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ __('booking.step') }} 2: {{ __('booking.select_date') }}</h2>
                                <p class="text-gray-500 mt-1">{{ __('booking.select_date_description') }}</p>
                            </div>
                        </div>
                        <button onclick="previousStep(1)" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="hidden sm:inline">{{ __('booking.previous') }}</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                        <!-- Left Column: Tour Type & Date -->
                        <div class="space-y-6">
                            <!-- Tour Price Display -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    <svg class="w-5 h-5 inline mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('tours.price') }}
                                </label>
                                <div class="p-4 bg-amber-50 rounded-lg border border-amber-200">
                                    <p class="text-2xl font-bold text-amber-600" id="tourPriceDisplay">0 VND</p>
                                </div>
                            </div>

                            <!-- Start Date Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    <svg class="w-5 h-5 inline mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('booking.select_date') }}
                                </label>
                                <input type="text" id="tourStartDate" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer"
                                    placeholder="{{ __('tours.select_date') }}"
                                    readonly>
                            </div>

                            <!-- People Count -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    <svg class="w-5 h-5 inline mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                    </svg>
                                    {{ __('booking.people') }}
                                </label>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-2">{{ __('tours.adults') }}</label>
                                    <input type="number" id="adultsCount" min="1" value="1" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Selected Tour Preview -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 lg:p-8 border-2 border-gray-200 shadow-lg">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ __('booking.summary') }}</h3>
                            </div>
                            <div id="selectedTourPreview" class="space-y-4">
                                <div class="text-center py-12">
                                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">{{ __('booking.select_a_tour') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button onclick="previousStep(1)" class="group px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{ __('booking.previous') }}
                        </button>
                        <button id="step2-next" 
                                class="group px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2"
                                onclick="nextStep(3)" disabled>
                            <span>{{ __('booking.next') }}</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Bus Services & Gifts -->
                <div id="step3" class="step-content hidden p-6 lg:p-10">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-500 flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-bold text-white">3</span>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ __('booking.step') }} 3: {{ __('booking.bus_services') }} & {{ __('booking.gifts') }}</h2>
                                <p class="text-gray-500 mt-1">{{ __('booking.bus_services_gifts_description') }}</p>
                            </div>
                        </div>
                        <button onclick="previousStep(2)" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="hidden sm:inline">{{ __('booking.previous') }}</span>
                        </button>
                    </div>

                    <div class="space-y-8">
                        <!-- Bus Service Option -->
                        <div>
                            <div class="flex items-center gap-3 p-4 border-2 border-gray-300 rounded-lg hover:border-amber-400 transition-colors">
                                <input type="checkbox" id="useBusService" 
                                    class="w-5 h-5 text-amber-500 border-gray-300 rounded focus:ring-amber-500 cursor-pointer"
                                    onchange="toggleBusService()">
                                <label for="useBusService" class="flex items-center gap-2 cursor-pointer flex-1">
                                    <svg class="w-6 h-6 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                    </svg>
                                    <span class="font-semibold text-gray-900">{{ __('tours.use_bus_service') }}</span>
                                </label>
                            </div>

                            <!-- Bus Service Details -->
                            <div id="busServiceSection" class="hidden mt-6 space-y-6">
                                <!-- Outbound Bus -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('tours.select_starting_point') }}</label>
                                    <div class="mb-3 relative">
                                        <button type="button" id="busStartingPointBtn" 
                                            class="w-full px-4 py-3 text-left border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white flex items-center justify-between cursor-pointer hover:border-amber-400 transition-colors">
                                            <span id="busStartingPointText" class="text-gray-700">{{ __('tours.select_starting_point') }}</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform" id="busStartingPointIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div id="busStartingPointDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border-2 border-gray-300 rounded-lg shadow-xl overflow-hidden max-h-60 overflow-y-auto">
                                            <div class="py-1" id="busStartingPointOptions"></div>
                                        </div>
                                        <input type="hidden" id="busStartingPoint" value="">
                                    </div>
                                    <input type="text" id="busDepartureDate" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer mb-3"
                                        placeholder="{{ __('tours.select_date') }}"
                                        readonly>
                                    <div id="outboundBusOptions" class="space-y-3"></div>
                                </div>

                                <!-- Return Bus -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('tours.choose_return_destination') }}</label>
                                    <div class="mb-3 relative">
                                        <button type="button" id="busReturnDestinationBtn" 
                                            class="w-full px-4 py-3 text-left border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none bg-white flex items-center justify-between cursor-pointer hover:border-amber-400 transition-colors">
                                            <span id="busReturnDestinationText" class="text-gray-700">{{ __('tours.choose_return_destination') }}</span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform" id="busReturnDestinationIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div id="busReturnDestinationDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border-2 border-gray-300 rounded-lg shadow-xl overflow-hidden max-h-60 overflow-y-auto">
                                            <div class="py-1" id="busReturnDestinationOptions"></div>
                                        </div>
                                        <input type="hidden" id="busReturnDestination" value="">
                                    </div>
                                    <input type="text" id="busReturnDate" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none cursor-pointer mb-3"
                                        placeholder="{{ __('tours.select_date') }}"
                                        readonly>
                                    <div id="returnBusOptions" class="space-y-3"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Gifts Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <svg class="w-5 h-5 inline mr-2 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('booking.gifts') }}
                            </label>
                            <div id="giftOptions" class="flex gap-4 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-amber-300 scrollbar-track-gray-100">
                                <!-- Gift options will be loaded here -->
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <button onclick="previousStep(2)" class="group px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 shadow-sm hover:shadow-md cursor-pointer">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{ __('booking.previous') }}
                        </button>
                        <button id="step3-next" 
                                class="group px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center gap-2"
                                onclick="nextStep(4)">
                            <span>{{ __('booking.next') }}</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Summary & Checkout -->
                <div id="step4" class="step-content hidden p-6 lg:p-10">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-500 flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-bold text-white">4</span>
                                </div>
                            </div>
                            <div>
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">{{ __('booking.step') }} 4: {{ __('booking.summary') }}</h2>
                                <p class="text-gray-500 mt-1">{{ __('booking.summary_description') }}</p>
                            </div>
                        </div>
                        <button onclick="previousStep(3)" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="hidden sm:inline">{{ __('booking.previous') }}</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                        <!-- Summary Details -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 lg:p-8 border-2 border-gray-200 shadow-lg">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ __('checkout.booking_details') }}</h3>
                                </div>
                                <div id="bookingSummaryDetails" class="space-y-4">
                                    <!-- Summary will be populated dynamically -->
                                </div>
                            </div>
                        </div>

                        <!-- Total & Checkout -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-amber-50 via-amber-50 to-amber-100 rounded-2xl p-6 lg:p-8 border-2 border-amber-300 shadow-xl sticky top-4">
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ __('common.total') }}</h3>
                                </div>
                                <div class="mb-6 p-4 bg-white/60 backdrop-blur-sm rounded-xl border border-amber-200">
                                    <div class="flex items-center justify-between">
                                        <span class="text-lg font-semibold text-gray-700">{{ __('common.total') }}:</span>
                                        <span class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-amber-700 bg-clip-text text-transparent" id="bookingTotal">0 VND</span>
                                    </div>
                                </div>
                                <button onclick="proceedToCheckout()"
                                    class="w-full bg-gradient-to-r from-teal-500 via-teal-600 to-cyan-600 hover:from-teal-600 hover:via-teal-700 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 cursor-pointer">
                                    <span>{{ __('booking.continue_checkout') }}</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.css">
<style>
    /* Air Datepicker theme customization - Amber theme */
    .air-datepicker {
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        font-family: inherit;
    }

    .air-datepicker-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 0.5rem 0.5rem 0 0;
        color: white;
    }

    .air-datepicker-nav--title {
        color: white;
        font-weight: 600;
    }

    .air-datepicker-nav--action {
        color: white;
    }

    .air-datepicker-nav--action:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 0.25rem;
    }

    .air-datepicker-body--day-name {
        color: #6b7280;
        font-weight: 600;
    }

    .air-datepicker-cell {
        color: #374151;
        font-weight: 500;
    }

    .air-datepicker-cell.-day-:hover {
        background: #fef3c7;
        border-color: #f59e0b;
    }

    .air-datepicker-cell.-selected-,
    .air-datepicker-cell.-selected-.-current- {
        background: #f59e0b;
        border-color: #f59e0b;
        color: white;
        font-weight: 600;
    }

    .air-datepicker-cell.-selected-:hover {
        background: #d97706;
        border-color: #d97706;
    }

    .air-datepicker-cell.-current- {
        border-color: #f59e0b;
        color: #f59e0b;
        font-weight: 600;
    }

    .air-datepicker-cell.-current-:hover {
        background: #fef3c7;
    }

    .air-datepicker-cell.-disabled- {
        color: #d1d5db;
    }

    .air-datepicker-cell.-disabled-:hover {
        background: transparent;
    }

    .step-circle {
        transition: all 0.3s ease;
        flex-shrink: 0;
    }
    .step-circle.active {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        transform: scale(1.05);
    }
    .step-circle.completed {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    }
    .step-line {
        flex-shrink: 1;
        min-width: 0;
    }
    .step-line.active {
        background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
    }
    @media (max-width: 640px) {
        .step-line {
            min-width: 8px;
        }
    }
    .tour-card.selected {
        border-color: #ec4899;
        background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
    }
    .step-content {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .scrollbar-thin::-webkit-scrollbar {
        height: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #f9a8d4;
        border-radius: 3px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #f472b6;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/air-datepicker@3.4.0/air-datepicker.min.js"></script>
<script>
    // Translation strings
    const translations = {
        select_tour_type_date_details: '{{ __('booking.select_tour_type_date_details') }}',
        select_tour_type: '{{ __('booking.select_tour_type') }}',
        not_available: '{{ __('booking.not_available') }}',
        loading: '{{ __('booking.loading') }}',
        select_a_tour: '{{ __('booking.select_a_tour') }}',
        select_tour_type_first: '{{ __('booking.select_tour_type_first') }}',
        select_date_first: '{{ __('booking.select_date_first') }}',
        no_tours_available: '{{ __('tours_index.no_tours_available') }}',
        no_gifts: '{{ __('tours.no_gifts') }}',
        no_starting_points: '{{ __('tours.no_starting_points') }}',
        no_return_destinations: '{{ __('tours.no_return_destinations') }}',
        no_bus_services: '{{ __('tours.no_bus_services') }}',
        select_starting_point: '{{ __('tours.select_starting_point') }}',
        choose_return_destination: '{{ __('tours.choose_return_destination') }}',
        tour: '{{ __('checkout.tour') }}',
        start_date: '{{ __('checkout.start_date') }}',
        adults: '{{ __('checkout.adults') }}',
        outbound: '{{ __('checkout.outbound') }}',
        return: '{{ __('checkout.return') }}',
        gift: '{{ __('checkout.gift') }}',
        bus_services: '{{ __('checkout.bus_services') }}',
        not_selected: '{{ __('checkout.not_selected') }}',
    };

    // Vietnamese locale for Air Datepicker (same as tour detail page)
    const vietnameseLocale = {
        days: ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'],
        daysShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        daysMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        monthsShort: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        today: 'Hôm nay',
        clear: 'Xóa',
        dateFormat: 'dd/MM/yyyy',
        timeFormat: 'HH:mm',
        firstDay: 1
    };

    let currentStep = 1;
    let selectedTourId = null;
    let selectedTourSlug = null;
    let selectedTourData = null;
    let bookingData = {
        tourPrice: 0,
        outboundBus: null,
        outboundBusPrice: 0,
        outboundBusName: null,
        outboundBusDepartureTime: null,
        outboundBusPickupLocation: null,
        returnBus: null,
        returnBusPrice: 0,
        returnBusName: null,
        returnBusDepartureTime: null,
        returnBusPickupLocation: null,
        selectedGift: null,
        selectedGiftName: null,
        adults: 2
    };

    // Step Navigation
    function nextStep(step) {
        if (step === 2 && !selectedTourId) {
            alert('{{ __('booking.select_a_tour') }}');
            return;
        }
        if (step === 3 && !document.getElementById('tourStartDate').dataset.value) {
            alert('{{ __('booking.select_date_first') }}');
            return;
        }

        document.getElementById(`step${currentStep}`).classList.add('hidden');
        document.getElementById(`step${step}`).classList.remove('hidden');
        updateStepIndicator(currentStep, step);
        currentStep = step;

        if (step === 2) {
            // Initialize date picker when step 2 is shown (same as tour detail page)
            setTimeout(() => {
                initDatePickers();
            }, 300);
        }
        if (step === 3) {
            loadGifts();
            loadBusStartingPoints();
            loadBusReturnDestinations();
            // Initialize bus date pickers when step 3 is shown
            setTimeout(() => {
                initBusDatePickers();
            }, 100);
        }
        if (step === 4) {
            updateBookingSummary();
        }
    }

    function previousStep(step) {
        document.getElementById(`step${currentStep}`).classList.add('hidden');
        document.getElementById(`step${step}`).classList.remove('hidden');
        updateStepIndicator(currentStep, step);
        currentStep = step;
    }

    function updateStepIndicator(fromStep, toStep) {
        for (let i = 1; i <= 4; i++) {
            const circle = document.querySelector(`#step${i}-indicator .step-circle`);
            const line = document.querySelector(`#step${i}-indicator .step-line`);
            
            if (i < toStep) {
                circle.classList.remove('active');
                circle.classList.add('completed');
                if (line) line.classList.add('active');
            } else if (i === toStep) {
                circle.classList.add('active');
                circle.classList.remove('completed');
            } else {
                circle.classList.remove('active', 'completed');
                if (line) line.classList.remove('active');
            }
        }
    }

    // Tour Selection
    async function selectTour(tourId, tourSlug, tourName, element) {
        // Update button text
        document.getElementById('tourSelectText').textContent = tourName;
        document.getElementById('selectedTourId').value = tourId;
        document.getElementById('tourSelectDropdown').classList.add('hidden');
        document.getElementById('tourSelectIcon').style.transform = 'rotate(0deg)';
        
        // Remove previous selection
        document.querySelectorAll('.tour-option').forEach(option => {
            option.classList.remove('bg-amber-50', 'text-amber-600');
        });
        
        // Add selection to clicked option
        if (element) {
            element.classList.add('bg-amber-50', 'text-amber-600');
        }
        
        selectedTourId = tourId;
        selectedTourSlug = tourSlug;
        selectedTourData = {
            id: tourId,
            slug: tourSlug,
            name: tourName
        };
        
        // Load tour price from API
        try {
            const response = await fetch(`{{ route('api.tours.info', ':id') }}`.replace(':id', tourId));
            const tourInfo = await response.json();
            if (tourInfo.price) {
                bookingData.tourPrice = parseFloat(tourInfo.price) || 0;
                document.getElementById('tourPriceDisplay').textContent = formatPrice(bookingData.tourPrice) + ' VND';
            }
        } catch (error) {
            console.error('Error loading tour info:', error);
        }
        
        // Show preview
        const preview = document.getElementById('selectedTourPreview');
        const tourDetails = element ? element.querySelector('.text-xs.text-gray-500')?.textContent : '';
        document.getElementById('selectedTourName').textContent = tourName;
        document.getElementById('selectedTourDetails').textContent = tourDetails || '';
        preview.classList.remove('hidden');
        
        // Enable next button
        document.getElementById('step1-next').disabled = false;
    }

    function clearTourSelection() {
        document.getElementById('tourSelectText').textContent = '{{ __('booking.select_tour') }}';
        document.getElementById('selectedTourId').value = '';
        document.getElementById('selectedTourPreview').classList.add('hidden');
        selectedTourId = null;
        selectedTourSlug = null;
        selectedTourData = null;
        document.getElementById('step1-next').disabled = true;
        
        // Remove selection from all options
        document.querySelectorAll('.tour-option').forEach(option => {
            option.classList.remove('bg-amber-50', 'text-amber-600');
        });
        
        // Ensure dropdown is hidden
        const dropdown = document.getElementById('tourSelectDropdown');
        if (dropdown) {
            dropdown.classList.add('hidden');
        }
    }

    function checkStep2Complete() {
        const hasDate = document.getElementById('tourStartDate').dataset.value !== undefined;
        document.getElementById('step2-next').disabled = !hasDate;
    }

    // Initialize Date Pickers (same as tour detail page)
    function initDatePickers() {
        // Check if AirDatepicker is loaded
        if (typeof AirDatepicker === 'undefined') {
            console.warn('AirDatepicker not loaded yet, retrying...');
            setTimeout(initDatePickers, 200);
            return;
        }

        const today = new Date();
        const minDate = today.toISOString().split('T')[0];

        // Helper function to initialize AirDatepicker
        function initDatePicker(element, options = {}) {
            if (!element || element._datepicker) return;
            
            try {
                const datepicker = new AirDatepicker(element, {
                    locale: vietnameseLocale,
                    dateFormat: 'dd/MM/yyyy',
                    minDate: minDate,
                    isMobile: window.innerWidth <= 768,
                    autoClose: true,
                    onSelect: function({date, formattedDate, datepicker}) {
                        // Format for backend (YYYY-MM-DD) - format directly without timezone conversion
                        if (date) {
                            const year = date.getFullYear();
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const day = String(date.getDate()).padStart(2, '0');
                            const formattedDateISO = `${year}-${month}-${day}`;
                            element.dataset.value = formattedDateISO;
                            // Update display value
                            element.value = formattedDate;
                            
                            if (element.id === 'tourStartDate') {
                                checkStep2Complete();
                            }
                        } else {
                            element.dataset.value = '';
                            element.value = '';
                        }
                    },
                    ...options
                });
                return datepicker;
            } catch (e) {
                console.error('Error initializing AirDatepicker:', e);
                return null;
            }
        }

        // Tour start date picker
        const tourStartDateEl = document.getElementById('tourStartDate');
        if (tourStartDateEl) {
            initDatePicker(tourStartDateEl);
        }
    }

    // Initialize Bus Date Pickers (for step 3)
    function initBusDatePickers() {
        if (typeof AirDatepicker === 'undefined') {
            setTimeout(initBusDatePickers, 200);
            return;
        }

        const today = new Date();
        const minDate = today.toISOString().split('T')[0];

        function initDatePicker(element, options = {}) {
            if (!element || element._datepicker) return;
            
            try {
                const datepicker = new AirDatepicker(element, {
                    locale: vietnameseLocale,
                    dateFormat: 'dd/MM/yyyy',
                    minDate: minDate,
                    isMobile: window.innerWidth <= 768,
                    autoClose: true,
                    onSelect: function({date, formattedDate}) {
                        if (date) {
                            const year = date.getFullYear();
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const day = String(date.getDate()).padStart(2, '0');
                            const formattedDateISO = `${year}-${month}-${day}`;
                            element.dataset.value = formattedDateISO;
                            element.value = formattedDate;
                        }
                    },
                    ...options
                });
                return datepicker;
            } catch (e) {
                console.error('Error initializing AirDatepicker:', e);
                return null;
            }
        }

        const busDepartureDateEl = document.getElementById('busDepartureDate');
        if (busDepartureDateEl && !busDepartureDateEl._datepicker) {
            initDatePicker(busDepartureDateEl);
        }

        const busReturnDateEl = document.getElementById('busReturnDate');
        if (busReturnDateEl && !busReturnDateEl._datepicker) {
            initDatePicker(busReturnDateEl);
        }
    }

    // Load Gifts
    async function loadGifts() {
        try {
            const response = await fetch('{{ route("api.gifts") }}');
            const gifts = await response.json();
            
            const container = document.getElementById('giftOptions');
            container.innerHTML = '';

            if (gifts.length === 0) {
                container.innerHTML = `<p class="text-sm text-gray-500">${translations.no_gifts}</p>`;
                return;
            }

            gifts.forEach(gift => {
                const giftOption = document.createElement('div');
                giftOption.className = 'border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-amber-500 transition-colors flex-shrink-0 w-32';
                giftOption.onclick = () => selectGift(gift.id, giftOption);
                
                giftOption.innerHTML = `
                    <div class="flex flex-col items-center gap-2">
                        <input type="radio" name="gift" value="${gift.id}" 
                            class="text-amber-500 focus:ring-amber-500" 
                            onchange="selectGift(${gift.id}, this.closest('div'))">
                        ${gift.image ? `<img src="${gift.image}" alt="${gift.name}" class="w-full h-24 object-cover rounded">` : '<div class="w-full h-24 bg-gray-200 rounded"></div>'}
                        <span class="font-semibold text-gray-900 text-center text-xs break-words">${gift.name}</span>
                    </div>
                `;
                container.appendChild(giftOption);
            });
        } catch (error) {
            console.error('Error loading gifts:', error);
        }
    }

    function selectGift(giftId, element) {
        document.querySelectorAll('#giftOptions > div').forEach(div => {
            div.classList.remove('border-amber-500', 'bg-amber-50');
        });
        element.classList.add('border-amber-500', 'bg-amber-50');
        bookingData.selectedGift = giftId;
        // Get gift name from the element
        const giftNameElement = element.querySelector('span');
        bookingData.selectedGiftName = giftNameElement ? giftNameElement.textContent.trim() : null;
        calculateTotal();
    }

    // Bus Service Functions (similar to tours/show.blade.php)
    function toggleBusService() {
        const useBus = document.getElementById('useBusService').checked;
        document.getElementById('busServiceSection').classList.toggle('hidden', !useBus);
        if (!useBus) {
            bookingData.outboundBus = null;
            bookingData.outboundBusPrice = 0;
            bookingData.outboundBusName = null;
            bookingData.outboundBusDepartureTime = null;
            bookingData.outboundBusPickupLocation = null;
            bookingData.returnBus = null;
            bookingData.returnBusPrice = 0;
            bookingData.returnBusName = null;
            bookingData.returnBusDepartureTime = null;
            bookingData.returnBusPickupLocation = null;
        }
        calculateTotal();
    }

    async function loadBusStartingPoints() {
        try {
            const response = await fetch('{{ route("api.bus-services.starting-points") }}');
            const points = await response.json();
            
            const container = document.getElementById('busStartingPointOptions');
            container.innerHTML = '';
            
            if (points.length === 0) {
                container.innerHTML = `<div class="px-4 py-2 text-sm text-gray-500 text-center">${translations.no_starting_points}</div>`;
                return;
            }
            
            points.forEach(point => {
                const option = document.createElement('button');
                option.type = 'button';
                option.className = 'w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition-colors';
                option.textContent = point;
                option.onclick = () => selectStartingPoint(point, option);
                container.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading starting points:', error);
        }
    }

    async function loadBusReturnDestinations() {
        try {
            const response = await fetch('{{ route("api.bus-services.return-destinations") }}');
            const destinations = await response.json();
            
            const container = document.getElementById('busReturnDestinationOptions');
            container.innerHTML = '';
            
            if (destinations.length === 0) {
                container.innerHTML = `<div class="px-4 py-2 text-sm text-gray-500 text-center">${translations.no_return_destinations}</div>`;
                return;
            }
            
            destinations.forEach(dest => {
                const option = document.createElement('button');
                option.type = 'button';
                option.className = 'w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition-colors';
                option.textContent = dest;
                option.onclick = () => selectReturnDestination(dest, option);
                container.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading return destinations:', error);
        }
    }

    function selectStartingPoint(point, element) {
        document.getElementById('busStartingPointText').textContent = point;
        document.getElementById('busStartingPoint').value = point;
        document.getElementById('busStartingPointDropdown').classList.add('hidden');
        // Load bus services for this starting point
        loadBusServices('outbound', point);
    }

    function selectReturnDestination(dest, element) {
        document.getElementById('busReturnDestinationText').textContent = dest;
        document.getElementById('busReturnDestination').value = dest;
        document.getElementById('busReturnDestinationDropdown').classList.add('hidden');
        // Load bus services for this return destination
        loadBusServices('return', dest);
    }

    async function loadBusServices(direction, location) {
        try {
            const response = await fetch(`{{ route("api.bus-services") }}?direction=${direction}&location=${encodeURIComponent(location)}`);
            const services = await response.json();
            
            const container = direction === 'outbound' ? document.getElementById('outboundBusOptions') : document.getElementById('returnBusOptions');
            container.innerHTML = '';
            
            if (services.length === 0) {
                container.innerHTML = `<p class="text-sm text-gray-500">${translations.no_bus_services}</p>`;
                return;
            }
            
            services.forEach(service => {
                const serviceDiv = document.createElement('div');
                serviceDiv.className = 'border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-amber-500 transition-colors';
                serviceDiv.dataset.serviceId = service.id;
                serviceDiv.dataset.servicePrice = service.price;
                serviceDiv.dataset.serviceName = service.name;
                serviceDiv.dataset.serviceDepartureTime = service.departure_time || '';
                serviceDiv.dataset.servicePickupLocation = service.pick_up_location || '';
                serviceDiv.onclick = () => selectBusService(service.id, service.price, direction, serviceDiv, service);
                
                serviceDiv.innerHTML = `
                    <div class="flex items-start gap-3">
                        <input type="radio" name="bus_${direction}" value="${service.id}" 
                            class="mt-1 text-amber-500 focus:ring-amber-500">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">${service.name}</h4>
                            <p class="text-sm text-gray-600">${service.departure_time || ''}${service.arrival_time ? ' - ' + service.arrival_time : ''}</p>
                            <p class="text-sm font-semibold text-amber-600 mt-1">${formatPrice(service.price)} VND</p>
                        </div>
                    </div>
                `;
                container.appendChild(serviceDiv);
            });
        } catch (error) {
            console.error(`Error loading ${direction} bus services:`, error);
        }
    }

    function selectBusService(serviceId, servicePrice, direction, element, service = null) {
        document.querySelectorAll(`#${direction === 'outbound' ? 'outbound' : 'return'}BusOptions > div`).forEach(div => {
            div.classList.remove('border-amber-500', 'bg-amber-50');
        });
        element.classList.add('border-amber-500', 'bg-amber-50');
        
        bookingData[direction === 'outbound' ? 'outboundBus' : 'returnBus'] = serviceId;
        bookingData[direction === 'outbound' ? 'outboundBusPrice' : 'returnBusPrice'] = servicePrice || 0;
        
        // Get bus service details from element dataset or service object
        const serviceName = service?.name || element.dataset.serviceName || element.querySelector('h4')?.textContent.trim() || null;
        const departureTime = service?.departure_time || element.dataset.serviceDepartureTime || null;
        const pickupLocation = service?.pick_up_location || element.dataset.servicePickupLocation || null;
        
        bookingData[direction === 'outbound' ? 'outboundBusName' : 'returnBusName'] = serviceName;
        bookingData[direction === 'outbound' ? 'outboundBusDepartureTime' : 'returnBusDepartureTime'] = departureTime;
        bookingData[direction === 'outbound' ? 'outboundBusPickupLocation' : 'returnBusPickupLocation'] = pickupLocation;
        
        calculateTotal();
    }

    // Calculate Total (same logic as tour detail page)
    function calculateTotal() {
        let total = 0;

        // Tour price multiplied by number of adults
        const adults = parseInt(document.getElementById('adultsCount').value) || 1;
        const tourPrice = bookingData.tourPrice || 0;
        total += tourPrice * adults;
        console.log('Tour price:', tourPrice, 'Adults:', adults, 'Total tour:', tourPrice * adults);

        // Outbound bus price (only if bus service is enabled, fixed price not multiplied by number of people)
        const useBusService = document.getElementById('useBusService')?.checked;
        if (useBusService && bookingData.outboundBus) {
            const outboundPrice = bookingData.outboundBusPrice || 0;
            total += outboundPrice;
            console.log('Outbound bus price:', outboundPrice);
        }

        // Return bus price (only if bus service is enabled, fixed price not multiplied by number of people)
        if (useBusService && bookingData.returnBus) {
            const returnPrice = bookingData.returnBusPrice || 0;
            total += returnPrice;
            console.log('Return bus price:', returnPrice);
        }

        // Gift is free, no price to add

        // Accommodation price (fixed price per room for the entire tour, NOT multiplied by nights or number of people)
        if (bookingData.selectedAccommodation && bookingData.accommodationPrice > 0) {
            const accommodationPrice = parseFloat(bookingData.accommodationPrice) || 0;
            total += accommodationPrice;
        }

        // Update tour price display (per person * adults)
        const tourPriceDisplay = document.getElementById('tourPriceDisplay');
        if (tourPriceDisplay && bookingData.tourPrice) {
            tourPriceDisplay.textContent = formatPrice(bookingData.tourPrice * adults) + ' VND';
        }

        console.log('Total calculated:', total);
        console.log('Booking data:', bookingData);

        // Update total display
        document.getElementById('bookingTotal').textContent = formatPrice(total) + ' VND';
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price);
    }

    // Update Booking Summary
    function updateBookingSummary() {
        const container = document.getElementById('bookingSummaryDetails');
        const startDateInput = document.getElementById('tourStartDate');
        const startDate = startDateInput?.dataset.value || startDateInput?.value || '';
        const adults = document.getElementById('adultsCount').value;
        
        const tourLabel = translations.tour;
        const startDateLabel = translations.start_date;
        const adultsLabel = translations.adults;
        const outboundLabel = translations.outbound;
        const returnLabel = translations.return;
        const giftLabel = translations.gift || 'Gift';
        const busServicesLabel = translations.bus_services || 'Bus Services';
        
        let html = `
            <div class="flex justify-between py-2 border-b border-gray-200">
                <span class="text-gray-600">${tourLabel}:</span>
                <span class="font-semibold text-gray-900">${selectedTourData?.name || translations.not_available}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-200">
                <span class="text-gray-600">${startDateLabel}:</span>
                <span class="font-semibold text-gray-900">${startDate || translations.not_available}</span>
            </div>
            <div class="flex justify-between py-2 border-b border-gray-200">
                <span class="text-gray-600">${adultsLabel}:</span>
                <span class="font-semibold text-gray-900">${adults}</span>
            </div>
        `;
        
        // Bus Services Section
        const useBusService = document.getElementById('useBusService')?.checked;
        if (useBusService) {
            html += `
                <div class="py-2 border-b border-gray-200">
                    <span class="text-gray-600 font-semibold">${busServicesLabel}:</span>
                </div>
            `;
            
            // Outbound bus
            if (bookingData.outboundBus) {
                const outboundPoint = document.getElementById('busStartingPointText')?.textContent || '';
                const outboundServiceName = bookingData.outboundBusName || '';
                const outboundDepartureTime = bookingData.outboundBusDepartureTime || '';
                const outboundPickupLocation = bookingData.outboundBusPickupLocation || '';
                
                html += `
                    <div class="py-2 border-b border-gray-200 pl-4">
                        <div class="flex justify-between items-start mb-1">
                            <span class="text-gray-600 font-medium">${outboundLabel}:</span>
                            <span class="text-right">
                                <span class="font-semibold text-gray-900">${outboundServiceName || translations.not_available}</span>
                                ${outboundPoint ? `<br><span class="text-xs text-gray-500">${outboundPoint}</span>` : ''}
                            </span>
                        </div>
                        ${outboundDepartureTime ? `<div class="text-xs text-gray-500 mt-1"><i class="far fa-clock mr-1"></i>${outboundDepartureTime}</div>` : ''}
                        ${outboundPickupLocation ? `<div class="text-xs text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-1"></i>${outboundPickupLocation}</div>` : ''}
                    </div>
                `;
            }
            
            // Return bus
            if (bookingData.returnBus) {
                const returnPoint = document.getElementById('busReturnDestinationText')?.textContent || '';
                const returnServiceName = bookingData.returnBusName || '';
                const returnDepartureTime = bookingData.returnBusDepartureTime || '';
                const returnPickupLocation = bookingData.returnBusPickupLocation || '';
                
                html += `
                    <div class="py-2 border-b border-gray-200 pl-4">
                        <div class="flex justify-between items-start mb-1">
                            <span class="text-gray-600 font-medium">${returnLabel}:</span>
                            <span class="text-right">
                                <span class="font-semibold text-gray-900">${returnServiceName || translations.not_available}</span>
                                ${returnPoint ? `<br><span class="text-xs text-gray-500">${returnPoint}</span>` : ''}
                            </span>
                        </div>
                        ${returnDepartureTime ? `<div class="text-xs text-gray-500 mt-1"><i class="far fa-clock mr-1"></i>${returnDepartureTime}</div>` : ''}
                        ${returnPickupLocation ? `<div class="text-xs text-gray-500 mt-1"><i class="fas fa-map-marker-alt mr-1"></i>${returnPickupLocation}</div>` : ''}
                    </div>
                `;
            }
            
            // If bus service is enabled but no services selected
            if (!bookingData.outboundBus && !bookingData.returnBus) {
                html += `
                    <div class="py-2 border-b border-gray-200 pl-4">
                        <span class="text-gray-500 text-sm">${translations.not_selected || 'Not selected'}</span>
                    </div>
                `;
            }
        }
        
        // Gift Section
        if (bookingData.selectedGift) {
            html += `
                <div class="flex justify-between py-2 border-b border-gray-200">
                    <span class="text-gray-600">${giftLabel}:</span>
                    <span class="font-semibold text-gray-900">${bookingData.selectedGiftName || translations.not_available}</span>
                </div>
            `;
        }
        
        container.innerHTML = html;
    }

    // Proceed to Checkout
    function proceedToCheckout() {
        const startDate = document.getElementById('tourStartDate').dataset.value;
        const adults = document.getElementById('adultsCount').value;
        const totalPrice = parseFloat(document.getElementById('bookingTotal').textContent.replace(/[^\d]/g, '')) || 0;
        const useBusService = document.getElementById('useBusService')?.checked;

        if (!startDate) {
            alert('{{ __('booking.select_date_first') }}');
            return;
        }

        const params = new URLSearchParams({
            tour_id: selectedTourId,
            tour_start_date: startDate,
            adults: adults,
            total_price: totalPrice,
            use_bus: useBusService ? '1' : '0'
        });

        if (useBusService && bookingData.outboundBus) {
            params.append('outbound_bus', bookingData.outboundBus);
        }
        if (useBusService && bookingData.returnBus) {
            params.append('return_bus', bookingData.returnBus);
        }
        if (bookingData.selectedGift) {
            params.append('gift', bookingData.selectedGift);
        }

        window.location.href = `{{ route('checkout.show') }}?${params.toString()}`;
    }

    // Dropdown Toggles
    document.addEventListener('DOMContentLoaded', function() {
        // Date pickers will be initialized when steps are shown
        
        // Tour Select Dropdown
        const tourSelectBtn = document.getElementById('tourSelectBtn');
        const tourSelectDropdown = document.getElementById('tourSelectDropdown');
        const tourSelectIcon = document.getElementById('tourSelectIcon');
        if (tourSelectBtn && tourSelectDropdown) {
            tourSelectBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                e.preventDefault();
                
                // Close all other dropdowns first
                document.querySelectorAll('[id$="Dropdown"]').forEach(dropdown => {
                    if (dropdown !== tourSelectDropdown) {
                        dropdown.classList.add('hidden');
                    }
                });
                
                // Toggle current dropdown
                const isHidden = tourSelectDropdown.classList.contains('hidden');
                
                if (isHidden) {
                    tourSelectDropdown.classList.remove('hidden');
                    if (tourSelectIcon) tourSelectIcon.style.transform = 'rotate(180deg)';
                } else {
                    tourSelectDropdown.classList.add('hidden');
                    if (tourSelectIcon) tourSelectIcon.style.transform = 'rotate(0deg)';
                }
            });
            document.addEventListener('click', (e) => {
                if (tourSelectBtn && tourSelectDropdown && 
                    !tourSelectBtn.contains(e.target) && 
                    !tourSelectDropdown.contains(e.target)) {
                    tourSelectDropdown.classList.add('hidden');
                    if (tourSelectIcon) tourSelectIcon.style.transform = 'rotate(0deg)';
                }
            });
        }
        

        // Bus Starting Point Dropdown
        const busStartingPointBtn = document.getElementById('busStartingPointBtn');
        const busStartingPointDropdown = document.getElementById('busStartingPointDropdown');
        if (busStartingPointBtn && busStartingPointDropdown) {
            busStartingPointBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                busStartingPointDropdown.classList.toggle('hidden');
            });
        }

        // Bus Return Destination Dropdown
        const busReturnDestinationBtn = document.getElementById('busReturnDestinationBtn');
        const busReturnDestinationDropdown = document.getElementById('busReturnDestinationDropdown');
        if (busReturnDestinationBtn && busReturnDestinationDropdown) {
            busReturnDestinationBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                busReturnDestinationDropdown.classList.toggle('hidden');
            });
        }

        // Update adults count
        document.getElementById('adultsCount').addEventListener('input', () => {
            bookingData.adults = parseInt(document.getElementById('adultsCount').value) || 2;
            // Update tour price display when adults count changes
            const adults = parseInt(document.getElementById('adultsCount').value) || 1;
            const tourPriceDisplay = document.getElementById('tourPriceDisplay');
            if (tourPriceDisplay && bookingData.tourPrice) {
                tourPriceDisplay.textContent = formatPrice(bookingData.tourPrice * adults) + ' VND';
            }
            calculateTotal();
        });
    });
</script>
@endpush
@endsection

