<!doctype html>
<html>
<head>
  <?php include "head.html";?>
  <title>Gaming Store</title>
</head>

<body class="text-white font-jost">
    <?php include "header.html";?>

    <!-- Banner -->
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-70 overflow-hidden">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://gameflip.com/img/banners/carousel_main.webp" class="absolute block w-full h-full object-cover" alt="Gaming Banner 1">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center z-10">
                    <h1 class="font-roboto text-4xl md:text-6xl font-bold text-white text-center px-4">
                        Buy & Sell Gaming Items
                    </h1>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://gameflip.com/img/banners/carousel_blog_202511.webp" class="absolute block w-full h-full object-cover" alt="Gaming Banner 2">
               
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://cdn-assets.zeusx.com/img/v2/home-banner-v2-min.png" class="absolute block w-full h-full object-cover" alt="Gaming Banner 3">
                <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center z-10">
                    <h1 class="font-bbhsansRoboto text-4xl md:text-6xl font-bold text-white text-center px-4">
                        Gaming Market Place For All Gamers
                    </h1>
                </div>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- search bar -->
    <div class="flex justify-center -mt-8 mb-10 relative z-40">
        <div class="relative w-full max-w-xl">
        <input type="text" class="w-full pl-14 py-6 rounded-full bg-[#1C093C] text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500 border border-none shadow-xl" placeholder="Search for games, in-game items, top-ups..." />
        <span class="absolute inset-y-0 start-0 flex items-center px-3 m-2">
            <i class="ri-search-line text-gray-400"></i>
        </span>
        </div>
    </div>

    <!-- Trending Games -->
<div class="mx-auto max-w-7xl px-6">
  <!-- Header -->
  <h2 class="mb-4 text-2xl font-semibold">Trending Games</h2>

  <!-- Grid 6 item -->
  <div class="grid grid-cols-6 gap-5">
    <!-- Card -->
    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://cdn-game-photos.zeusx.com/ff770df4-a186-4d4b-a0d1-776d8bb02381.png" alt="Wuthering Wave"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">Wuthering Wave</span>
      </div>
    </a>

    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://cdn-game-photos.zeusx.com/Mobile_Legends.jpeg" alt="CoC2"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">Mobile Legends</span>
      </div>
    </a>

    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://cdn-offer-photos.zeusx.com/PUBG_Mobile.jpg" alt="Chaos Zero Nightmare"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">PUBG Mobile</span>
      </div>
    </a>

    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://cdn-game-photos.zeusx.com/e4b8db94-19b5-4376-b2b3-1b0b3b8ceb21.png" alt="Honkai Star Rail"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">Honkai Star Rail</span>
      </div>
    </a>

    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://store-images.s-microsoft.com/image/apps.29998.14294982842551334.b7187202-d3a5-4d28-b184-10f299fc8103.a7840b5a-b8db-4d9b-8126-53f6f7182272?q=90&w=480&h=270" alt="Uma Musume Pretty Derby"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">Roblox</span>
      </div>
    </a>

    <a href="#" class="group relative block aspect-square overflow-hidden rounded-lg">
      <img src="https://cdn-game-photos.zeusx.com/Genshin_Impact.png" alt="Genshin Impact"
           class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
      <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
      <div class="absolute bottom-3 left-3 right-3">
        <span class="text-white text-sm sm:text-base font-semibold">Genshin Impact</span>
      </div>
    </a>
  </div>
</div>

<!-- How It Work -->
<div class="mx-auto max-w-7xl px-6 py-12">
  <!-- Title -->
  <h2 class="mb-10 text-2xl font-bold">How it Works?</h2>

  <!-- Steps grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
    
    <!-- Step 1 -->
    <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg">
      <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-4">
        <i class="ri-file-text-line text-3xl"></i>
      </div>
      <h3 class="font-semibold mb-2">Registration</h3>
      <p class="text-gray-200 text-sm">Register for free to unlock more features</p>
    </div>

    <!-- Step 2 -->
    <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg">
      <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-4">
       <i class="ri-bank-card-line text-3xl"></i>
      </div>
      <h3 class="font-semibold mb-2">Payment</h3>
      <p class="text-gray-200 text-sm">Checkout with your preferred method</p>
    </div>

    <!-- Step 3 -->
    <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg">
      <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-4">
        <i class="ri-mail-send-line text-3xl"></i>
      </div>
      <h3 class="font-semibold mb-2">Delivery</h3>
      <p class="text-gray-200 text-sm">Wait for your order to be delivered (some types are instant)</p>
    </div>

    <!-- Step 4 -->
    <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg">
      <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 mb-4">
        <i class="ri-checkbox-line text-3xl"></i>
      </div>
      <h3 class="font-semibold mb-2">Confirmation</h3>
      <p class="text-gray-200 text-sm">Validate delivery is made. The seller is only paid after this</p>
    </div>

  </div>
</div>

    <?php include "footer.html";?>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>
</html>