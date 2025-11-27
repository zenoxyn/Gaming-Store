<!doctype html>
<html>

<head>
  <?php include "head.html"; ?>
  <title>Gaming Store</title>
</head>

<body class="text-white font-jost">
  <?php include "header.html"; ?>
  

  <!-- Banner -->
  <div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative overflow-hidden h-70">
      <!-- Item 1 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://gameflip.com/img/banners/carousel_main.webp" class="absolute block object-cover w-full h-full" alt="Gaming Banner 1">
        <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
        <div class="absolute inset-0 z-10 flex items-center justify-center">
          <h1 class="px-4 text-4xl font-bold text-center text-white font-roboto md:text-6xl">
            Buy & Sell Gaming Items
          </h1>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://gameflip.com/img/banners/carousel_blog_202511.webp" class="absolute block object-cover w-full h-full" alt="Gaming Banner 2">

      </div>
      <!-- Item 3 -->
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <img src="https://cdn-assets.zeusx.com/img/v2/home-banner-v2-min.png" class="absolute block object-cover w-full h-full" alt="Gaming Banner 3">
        <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
        <div class="absolute inset-0 z-10 flex items-center justify-center">
          <h1 class="px-4 text-4xl font-bold text-center text-white font-bbhsansRoboto md:text-6xl">
            Gaming Market Place For All Gamers
          </h1>
        </div>
      </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">
      <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
      <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
      <button type="button" class="w-3 h-3 rounded-full bg-white/60" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
        </svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>
    <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
        </svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>

  <!-- search bar -->
  <div class="relative z-40 flex justify-center mb-10 -mt-8">
    <div class="relative w-full max-w-xl">
      <input type="text" class="w-full pl-14 py-6 rounded-full bg-[#1C093C] text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500 border border-none shadow-xl" placeholder="Search for games, in-game items, top-ups..." />
      <span class="absolute inset-y-0 flex items-center px-3 m-2 start-0">
        <i class="text-gray-400 ri-search-line"></i>
      </span>
    </div>
  </div>

  <!-- Trending Games -->
  <div class="px-6 mx-auto max-w-7xl">
    <!-- Header -->
    <h2 class="mb-4 text-2xl font-semibold">Trending Games</h2>

    <!-- Grid 6 item -->
    <div class="grid grid-cols-6 gap-5">
      <!-- Card -->
      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://cdn-game-photos.zeusx.com/ff770df4-a186-4d4b-a0d1-776d8bb02381.png" alt="Wuthering Wave"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">Wuthering Wave</span>
        </div>
      </a>

      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://cdn-game-photos.zeusx.com/Mobile_Legends.jpeg" alt="CoC2"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">Mobile Legends</span>
        </div>
      </a>

      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://cdn-offer-photos.zeusx.com/PUBG_Mobile.jpg" alt="Chaos Zero Nightmare"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">PUBG Mobile</span>
        </div>
      </a>

      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://cdn-game-photos.zeusx.com/e4b8db94-19b5-4376-b2b3-1b0b3b8ceb21.png" alt="Honkai Star Rail"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">Honkai Star Rail</span>
        </div>
      </a>

      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://store-images.s-microsoft.com/image/apps.29998.14294982842551334.b7187202-d3a5-4d28-b184-10f299fc8103.a7840b5a-b8db-4d9b-8126-53f6f7182272?q=90&w=480&h=270" alt="Uma Musume Pretty Derby"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">Roblox</span>
        </div>
      </a>

      <a href="#" class="relative block overflow-hidden rounded-lg group aspect-square">
        <img src="https://cdn-game-photos.zeusx.com/Genshin_Impact.png" alt="Genshin Impact"
          class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105" />
        <div class="absolute inset-0 bg-linear-to-t from-black/60 via-black/20 to-transparent"></div>
        <div class="absolute bottom-3 left-3 right-3">
          <span class="text-sm font-semibold text-white sm:text-base">Genshin Impact</span>
        </div>
      </a>
    </div>
  </div>

  <!-- How It Work -->
  <div class="px-6 py-12 mx-auto max-w-7xl">
    <!-- Title -->
    <h2 class="mb-10 text-2xl font-bold">How it Works?</h2>

    <!-- Steps grid -->
    <div class="grid grid-cols-1 gap-8 text-center sm:grid-cols-2 lg:grid-cols-4">

      <!-- Step 1 -->
      <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg border-2 border-[#4C1D95]">
        <div class="flex items-center justify-center w-16 h-16 mb-4 text-indigo-600 bg-indigo-100 rounded-full">
          <i class="text-3xl ri-file-text-line"></i>
        </div>
        <h3 class="mb-2 font-semibold">Registration</h3>
        <p class="text-sm text-gray-200">Register for free to unlock more features</p>
      </div>

      <!-- Step 2 -->
      <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg border-2 border-[#4C1D95]">
        <div class="flex items-center justify-center w-16 h-16 mb-4 text-indigo-600 bg-indigo-100 rounded-full">
          <i class="text-3xl ri-bank-card-line"></i>
        </div>
        <h3 class="mb-2 font-semibold">Payment</h3>
        <p class="text-sm text-gray-200">Checkout with your preferred method</p>
      </div>

      <!-- Step 3 -->
      <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg border-2 border-[#4C1D95]">
        <div class="flex items-center justify-center w-16 h-16 mb-4 text-indigo-600 bg-indigo-100 rounded-full">
          <i class="text-3xl ri-mail-send-line"></i>
        </div>
        <h3 class="mb-2 font-semibold">Delivery</h3>
        <p class="text-sm text-gray-200">Wait for your order to be delivered (some types are instant)</p>
      </div>

      <!-- Step 4 -->
      <div class="flex flex-col items-center bg-[#2C1450] p-6 rounded-lg border-2 border-[#4C1D95]">
        <div class="flex items-center justify-center w-16 h-16 mb-4 text-indigo-600 bg-indigo-100 rounded-full">
          <i class="text-3xl ri-checkbox-line"></i>
        </div>
        <h3 class="mb-2 font-semibold">Confirmation</h3>
        <p class="text-sm text-gray-200">Validate delivery is made. The seller is only paid after this</p>
      </div>

    </div>
  </div>


  <?php include "footer.html"; ?>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

  <script src="/Gaming-Store/js/script.js"></script>

</body>

</html>