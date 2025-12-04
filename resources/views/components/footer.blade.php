<footer class="text-gray-300 pt-12 pb-10 mt-20 border-t-2 border-[#8a2be2]/30 bg-[#1a0b2e]/95">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Top grid: Logo + Menu -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- Left Column -->
            <div class="">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/icons/logo.png') }}" alt="Logo" class="h-12 w-auto" />
                <span class="text-xl font-bold bg-linear-to-r from-yellow-500 via-orange-400 to-purple-500 bg-clip-text text-transparent">FRYN.COM</span>
                </a>

                <p class="mt-4 text-md leading-relaxed">
                    Trading platform for gamers all over the world
                </p>

                <!-- Social media -->
                <div class="flex gap-4 items-center mt-6">
                    <div
                        class="flex items-center justify-center w-10 h-10 transition-colors rounded-full cursor-pointer bg-[#8a2be2]/30 hover:bg-[#8a2be2]/60">
                        <a href="#" class="text-2xl hover:text-white"><i class="ri-facebook-fill"></i></a>
                    </div>
                    <div
                        class="flex items-center justify-center w-10 h-10 transition-colors rounded-full cursor-pointer bg-[#8a2be2]/30 hover:bg-[#8a2be2]/60">
                        <a href="#" class="text-2xl hover:text-white"><i class="ri-instagram-fill"></i></a>
                    </div>
                    <div
                        class="flex items-center justify-center w-10 h-10 transition-colors rounded-full cursor-pointer bg-[#8a2be2]/30 hover:bg-[#8a2be2]/60">
                        <a href="#" class="text-2xl hover:text-white"><i class="ri-twitter-fill"></i></a>
                    </div>
                    <div
                        class="flex items-center justify-center w-10 h-10 transition-colors rounded-full cursor-pointer bg-[#8a2be2]/30 hover:bg-[#8a2be2]/60">
                        <a href="#" class="text-2xl hover:text-white"><i class="ri-youtube-fill"></i></a>
                    </div>
                </div>


            </div>

            <!-- tambahan -->
            <div class=""></div>
            <!-- nara hubung -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 font-bold">
                <!-- Buy & Sell -->
                <div >
                    <h3 class="text-xl font-semibold text-white mb-4">Buy & Sell</h3>
                    <ul class="space-y-3 text-md warna-text">
                        <li><a href="#" class="hover:text-white cursor-pointer">YOII</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">JOSJISS</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">WAYAHE</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">MONGGO</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div >
                    <h3 class="text-xl font-semibold text-white mb-4">Resources</h3>
                    <ul class="space-y-3 text-md warna-text">
                        <li><a href="#" class="hover:text-white cursor-pointer">About Us</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">Help Center</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white cursor-pointer">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-700 mt-8 pt-8"></div>

        <!-- Bottom Section -->
        <div class="flex flex-col md:flex-row justify-between gap-8">

            <!-- Copyright -->
            <div class="warna-text">
                <p class="text-md">© 2025 PAK DE PAK LEK. • Terms • Privacy</p>
                <p class="text-sm mt-2">
                    Version: <span class="">192.168.1.1</span> - KAJSDO<br>
                    Last Updated: 19/11/2025 12:51
                </p>
            </div>

            <!-- Payment Methods -->
            <div class="flex flex-wrap items-center gap-3">
                <img src="{{ asset('images/icons/qris.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white">
                <img src="{{ asset('images/icons/bca.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white">
                <img src="{{ asset('images/icons/bri.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white">
                <img src="{{ asset('images/icons/bni.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white">
                <img src="{{ asset('images/icons/indomaret.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white object-cover">
                <img src="{{ asset('images/icons/alfa.svg') }}" class="h-8 w-14 p-1 rounded-sm bg-white object-cover">
            </div>
        </div>
    </div>
</footer>
