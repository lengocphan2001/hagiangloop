@extends('layouts.app')

@section('title', 'Contact - Hà Giang Loop Tours')

@section('content')
<section class="py-16 lg:py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Contact Form -->
            <div class="bg-white p-4 sm:p-6 lg:p-12 mb-8 sm:mb-12">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-serif text-center text-gray-900 mb-6 sm:mb-8">Contact Mama Tour</h1>
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-sm sm:text-base">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 text-sm sm:text-base">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-800 text-sm sm:text-base">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Form Grid: Left Column (Name, Email, Message) | Right Column (Whatsapp, Country) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    First and last name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-300 outline-none transition bg-white">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-300 outline-none transition bg-white">
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                    Whatsapp <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="whatsapp" 
                                       name="whatsapp" 
                                       value="{{ old('whatsapp') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-300 outline-none transition bg-white">
                            </div>
                            
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Country <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="country" 
                                       name="country" 
                                       value="{{ old('country') }}"
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-300 outline-none transition bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Message - Full Width -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="6" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-300 outline-none transition resize-y bg-white">{{ old('message') }}</textarea>
                    </div>

                    <p class="text-sm text-gray-600 text-center">Please contact us with complete information</p>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" 
                                class="px-12 py-4 bg-amber-300 hover:bg-amber-400 text-gray-900 font-semibold rounded-lg transition-colors duration-200 uppercase tracking-wide">
                            SEND
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="bg-white text-center">
                
                <div class="border-t border-gray-200 pt-8 mb-8"></div>
                
                <h2 class="text-3xl lg:text-4xl font-serif text-gray-900 mb-8">Mama's Tour Ha Giang</h2>
                
                <div class="space-y-3 sm:space-y-4 max-w-md mx-auto">
                    <div class="text-center break-words">
                        <strong class="text-gray-900 text-sm sm:text-base">Address:</strong>
                        <span class="text-gray-700 text-sm sm:text-base"> No.136 Nguyen Trai street, Ha Giang, Vietnam</span>
                    </div>
                    
                    <div class="text-center break-words">
                        <strong class="text-gray-900 text-sm sm:text-base">Email:</strong>
                        <span class="text-gray-700 text-sm sm:text-base break-all"> Mamashomestayhg@gmail.com</span>
                    </div>
                    
                    <div class="text-center break-words">
                        <strong class="text-gray-900 text-sm sm:text-base">Website:</strong>
                        <span class="text-gray-700 text-sm sm:text-base break-all"> https://mamashomestay.com/</span>
                    </div>
                    
                    <div class="flex items-center justify-center gap-2 min-w-0">
                        <svg class="w-5 h-5 text-amber-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <div class="min-w-0 text-center">
                            <span class="text-xs sm:text-sm text-gray-600">Hotline Whatsapp 24/7:</span>
                            <span class="text-base sm:text-lg font-bold text-gray-900 break-all"> +84849278787</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-gray-200">
                    <p class="text-gray-700 leading-relaxed text-sm sm:text-base break-words px-2">
                        Hi, welcome to Mama's Homestay. Please send us an email of your enquiry or leave a message on our website so we can assist you better. 
                        <br><br>
                        Instagram: <a href="https://www.instagram.com/hagiangloop" target="_blank" class="text-amber-600 hover:text-amber-700 font-semibold break-all">@hagiangloop</a>
                        <br>
                        CALL: <a href="tel:+84849278787" class="text-amber-600 hover:text-amber-700 font-semibold break-all">+84849278787</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

