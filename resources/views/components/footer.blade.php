<footer class="relative text-white mt-auto overflow-hidden min-h-[60vh] md:min-h-auto bg-gray-900"
    style="background-image: url('{{ asset('images/slider2.webp') }}'); background-size: contain; background-position: center; background-repeat: no-repeat; background-attachment: scroll;">
    <div class="absolute inset-0 bg-black/60 z-0"></div>

    <div class="relative z-10 max-w-6xl mx-auto p-6 lg:px-8 space-y-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
            <!-- Logo + title -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4">
                <img src="{{ asset('images/alley-01.png') }}" alt="Mama's Homestay" class="w-48 object-contain transform scale-300 origin-center">
            </div>

            <!-- Contact -->
            <div class="space-y-4">
                <p class="text-base leading-relaxed text-gray-100">
                    Discover Tranquil Moments, Embrace Genuine Hospitality – Welcome to Mama's Homestay
                </p>

                <div class="space-y-2">
                    <div class="flex items-center space-x-3">
                        <span class="text-base uppercase tracking-widest font-semibold">Contact</span>
                        <div class="flex-1 border-t border-white/40"></div>
                    </div>
                    <div class="space-y-2 text-base">
                        <div>Address: No.136 Nguyen Trai street, Ha Giang, Vietnam</div>
                        <div>- See above <a href="#" class="underline hover:text-amber-200">Google Map</a></div>
                        <div>Hotline Whatsapp 24/7: <a href="tel:+84915121987" class="underline hover:text-amber-200">+84915121987</a></div>
                        <div>Email: <a href="mailto:Mamashomestayhg@gmail.com" class="underline hover:text-amber-200">Mamashomestayhg@gmail.com</a></div>
                    </div>
                </div>
            </div>

            <!-- Instagram -->
            <div class="flex flex-col items-center md:items-end space-y-4">
                <div class="flex items-center space-x-3 w-full">
                    <div class="flex-1 border-t border-white/40"></div>
                    <span class="text-base uppercase tracking-widest font-semibold">Instagram</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative w-44 h-44 bg-white/10 border border-white/30 rounded-xl flex items-center justify-center">
                        <div class="w-36 h-36 bg-white rounded-lg flex items-center justify-center text-gray-900 text-sm font-semibold">
                            QR
                        </div>
                    </div>
                    <div class="text-sm tracking-wider uppercase" style="writing-mode: vertical-rl;">
                        Scan to connect
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/20 pt-6 text-center text-sm tracking-wide text-white/70">
            &copy; {{ date('Y') }} All rights reserved Mama's Tour
        </div>
    </div>
</footer>