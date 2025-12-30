<footer class="relative text-white mt-auto overflow-hidden min-h-[60vh] md:min-h-auto bg-gray-900">
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto p-6 lg:px-8 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <!-- Logo + title -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4">
                <img src="{{ asset('images/alley-01.png') }}" alt="Alley Homestay" class="w-48 object-contain transform scale-300 origin-center">
            </div>

            <!-- Contact -->
            <div class="space-y-4">
                <p class="text-base leading-relaxed text-gray-100">
                    {{ __('footer.tagline') }}
                </p>

                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="text-base uppercase tracking-widest font-semibold">{{ __('footer.contact') }}</span>
                        <div class="flex-1 border-t border-white/40"></div>
                    </div>
                    <div class="space-y-2 text-base">
                        <div>{{ __('footer.address') }}: {{ __('footer.address_value') }}</div>
                        <div>- {{ __('footer.see_above') }} <a href="#" class="underline hover:text-amber-200">{{ __('footer.google_map') }}</a></div>
                        <div>{{ __('footer.hotline_whatsapp') }}: <a href="tel:+84968410676" class="underline hover:text-amber-200">+84968410676</a></div>
                        <div>{{ __('footer.email') }}: <a href="mailto:alleyhomestay@gmail.com" class="underline hover:text-amber-200">alleyhomestay@gmail.com</a></div>
                    </div>
                </div>
            </div>

            <!-- Instagram -->
            <div class="flex flex-col items-center md:items-end space-y-4">
                <div class="flex items-center space-x-3 w-full">
                    <div class="flex-1 border-t border-white/40"></div>
                    <span class="text-base uppercase tracking-widest font-semibold">{{ __('footer.instagram') }}</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative w-full h-44 bg-white/10 border border-white/30 rounded-xl flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/inssta.jpg') }}" alt="Instagram QR Code" class="w-full h-full max-w-full max-h-full object-contain rounded-lg">
                    </div>
                    <div class="text-sm tracking-wider uppercase" style="writing-mode: vertical-rl;">
                        {{ __('footer.scan_to_connect') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/20 pt-6 text-center text-sm tracking-wide text-white/70">
            &copy; {{ date('Y') }} {{ __('footer.all_rights_reserved') }} Alley Homestay
        </div>
    </div>
</footer>