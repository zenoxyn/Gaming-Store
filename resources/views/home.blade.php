<x-layout>
        <!-- Banner -->
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative overflow-hidden h-35 md:h-70">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/banners/banner1.webp') }}" class="absolute block object-cover w-full h-full" alt="Gaming Banner 1">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                <div class="absolute inset-0 z-10 flex items-center justify-center">
                    <h1 class="px-2 text-2xl font-bold text-center text-white font-roboto md:text-6xl md:px-4 md:text-4xl">
                        Buy & Sell Gaming Items
                    </h1>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/banners/banner2.webp') }}" class="absolute block object-cover w-full h-full" alt="Gaming Banner 2">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('images/banners/banner3.png') }}" class="absolute block object-cover w-full h-full" alt="Gaming Banner 3">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                <div class="absolute inset-0 z-10 flex items-center justify-center">
                    <h1 class="px-2 text-2xl font-bold text-center text-white font-bbhsansRoboto md:text-6xl md:px-4 md:text-4xl">
                        Gaming Market Place For All Gamers
                    </h1>
                </div>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-3 left-1/2 rtl:space-x-reverse">
            <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/60" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/60" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-2.5 h-2.5 rounded-full bg-white/60" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-2 cursor-pointer start-0 group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-2 cursor-pointer end-0 group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- search bar -->
    <div class="relative z-40 flex justify-center mb-8 -mt-8">
        <div class="relative w-full max-w-xl px-2 md:px-0">
            <form action="{{ route('products.search') }}" method="GET" class="flex items-center">
                <div class="relative w-full">
                    <input type="text" name="q"
                        class="w-full pl-12 pr-4 py-4 md:py-6 rounded-full bg-[#1C093C] text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500 border border-none shadow-xl text-base md:text-lg"
                        placeholder="Search for games, in-game items, top-ups..." />
                    <button type="submit" class="absolute left-0 top-0 h-full flex items-center px-3">
                        <i class="text-gray-400 text-xl md:text-2xl ri-search-line"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Trending Games -->
    <div class="px-6 mx-auto max-w-7xl">
    <!-- Header -->
    <h2 class="mb-4 text-2xl font-semibold">Trending Games</h2>

    <!-- Grid 6 item -->
    <div class="grid xl:grid-cols-6  grid-cols-3 gap-5">
        @foreach($categories as $category)
        <a href="{{ route('products.category', $category->slug) }}" class="relative block overflow-hidden rounded-xl group aspect-square border-2 border-[#8a2be2]/20 hover:border-[#8a2be2] transition-all">
            @if($category->icon)
                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
            @else
                <div class="w-full h-full bg-linear-to-br from-[#2d1b4e] to-purple-900 flex items-center justify-center text-6xl">
                    🎮
                </div>
            @endif
            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-3 left-3 right-3">
                <span class="text-sm font-semibold text-white sm:text-base">{{ $category->name }}</span>
                <span class="block text-xs text-gray-300">{{ $category->products_count }} items</span>
            </div>
        </a>
        @endforeach
    </div>
    </div>

    <!-- How It Work -->
    <div class="px-6 py-12 mx-auto max-w-7xl">
    <!-- Title -->
    <h2 class="mb-10 text-2xl font-bold">How it Works?</h2>

    <!-- Steps grid -->
    <div class="grid grid-cols-2 gap-6 text-center lg:grid-cols-4">

        <!-- Step 1 -->
        <div class="flex flex-col items-center bg-[#2d1b4e]/60 backdrop-blur-sm p-8 rounded-2xl border-2 border-[#8a2be2]/30 hover:border-[#8a2be2] transition-all group hover:-translate-y-2">
            <div class="flex items-center justify-center w-20 h-20 mb-5 rounded-2xl bg-linear-to-br from-[#8a2be2] to-[#ff1493] shadow-lg group-hover:shadow-[#8a2be2]/50 transition-all">
                <i class="text-4xl text-white ri-file-text-line"></i>
            </div>
            <h3 class="mb-3 text-lg font-bold text-white">Registration</h3>
            <p class="text-sm leading-relaxed text-gray-300">Register for free to unlock more features</p>
        </div>

        <!-- Step 2 -->
        <div class="flex flex-col items-center bg-[#2d1b4e]/60 backdrop-blur-sm p-8 rounded-2xl border-2 border-[#8a2be2]/30 hover:border-[#8a2be2] transition-all group hover:-translate-y-2">
            <div class="flex items-center justify-center w-20 h-20 mb-5 rounded-2xl bg-linear-to-br from-[#8a2be2] to-[#ff1493] shadow-lg group-hover:shadow-[#8a2be2]/50 transition-all">
                <i class="text-4xl text-white ri-bank-card-line"></i>
            </div>
            <h3 class="mb-3 text-lg font-bold text-white">Payment</h3>
            <p class="text-sm leading-relaxed text-gray-300">Checkout with your preferred method</p>
        </div>

        <!-- Step 3 -->
        <div class="flex flex-col items-center bg-[#2d1b4e]/60 backdrop-blur-sm p-8 rounded-2xl border-2 border-[#8a2be2]/30 hover:border-[#8a2be2] transition-all group hover:-translate-y-2">
            <div class="flex items-center justify-center w-20 h-20 mb-5 rounded-2xl bg-linear-to-br from-[#8a2be2] to-[#ff1493] shadow-lg group-hover:shadow-[#8a2be2]/50 transition-all">
                <i class="text-4xl text-white ri-mail-send-line"></i>
            </div>
            <h3 class="mb-3 text-lg font-bold text-white">Delivery</h3>
            <p class="text-sm leading-relaxed text-gray-300">Wait for your order to be delivered (some types are instant)</p>
        </div>

        <!-- Step 4 -->
        <div class="flex flex-col items-center bg-[#2d1b4e]/60 backdrop-blur-sm p-8 rounded-2xl border-2 border-[#8a2be2]/30 hover:border-[#8a2be2] transition-all group hover:-translate-y-2">
            <div class="flex items-center justify-center w-20 h-20 mb-5 rounded-2xl bg-linear-to-br from-[#8a2be2] to-[#ff1493] shadow-lg group-hover:shadow-[#8a2be2]/50 transition-all">
                <i class="text-4xl text-white ri-checkbox-line"></i>
            </div>
            <h3 class="mb-3 text-lg font-bold text-white">Confirmation</h3>
            <p class="text-sm leading-relaxed text-gray-300">Validate delivery is made. The seller is only paid after this</p>
        </div>

    </div>
</div>
</x-layout>
