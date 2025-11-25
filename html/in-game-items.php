<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../html/head.html'; ?>
    <title>Gaming Store - In-Game Items</title>
</head>

<body class="min-h-screen overflow-x-hidden text-white bg-linear-to-br from-dark via-darkpurple to-dark">
    <!-- header -->
    <?php include 'header.html'; ?>

    <!-- Hero Section -->
    <section class="px-5 mx-auto mt-8 max-w-7xl">

        <div class="from-primary/30 to-secondary/30 rounded-3xl p-16 relative overflow-hidden min-h-[300px] flex items-center">
            <img src="https://cdn-game-photos.zeusx.com/90b1f031-6b94-45b7-9fb2-7d408e7d29cb.png" alt="" class="absolute top-0 left-0 object-cover w-full h-full opacity-80">
            <div class="z-10 max-w-xl">
                <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm transition rounded-full cursor-pointer bg-white/20 hover:bg-white/30" aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </button>
                <h1 id="heroTitle" class="mb-4 text-6xl font-bold text-transparent translate-y-4 opacity-0 bg-linear-to-r from-white to-yellow-300 bg-clip-text">
                    Call Of Duty
                </h1>
                <p class="mb-8 text-lg text-gray-200">
                    A family way to get your favourite characters and weapons!
                </p>

                <div class="flex gap-4">
                    <button data-category="Accounts" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none" aria-pressed="false">
                        <i class="fas fa-user"></i>
                        <span>Accounts</span>
                        <span class="badge-new bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">NEW</span>
                    </button>
                    <button data-category="Top-ups" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition transform cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none" aria-pressed="false">
                        <i class="fas fa-tag"></i>
                        <span>Top-ups</span>
                        <span class="badge-new bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">NEW</span>
                    </button>
                    <button data-category="Gaming Services" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition transform cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none" aria-pressed="false">
                        <i class="fas fa-gamepad"></i>
                        <span>Gaming Services</span>
                        <span class="badge-hot bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">HOT</span>
                    </button>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-1/2 h-full bg-linear-to-l from-yellow-500/10 to-transparent"></div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="px-5 mx-auto mt-8 max-w-7xl">
        <div class="p-6 border-2 bg-[#2d1b4e]/90 border-[#8a2be2]/30 rounded-2xl">
            <h2 class="mb-4 text-xl font-semibold">Search Items</h2>
            <div class="flex gap-4">
                <input type="text" placeholder="Item search..."
                    class="flex-1 px-5 py-4 text-white border-2 rounded-xl border-[#8a2be2]/30 bg-[#1a0b2e]/80 focus:outline-none focus:border-[#8a2be2]">
                <button class="bg-linear-to-r from-[#8a2be2] to-[#ff1493] px-10 py-4 rounded-xl font-bold hover:-translate-y-0.5 transition-transform">
                    Search
                </button>
            </div>
        </div>
    </section>

    <!-- Filters -->
    <section class="flex items-center justify-between px-5 mx-auto mt-6 max-w-7xl">
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="chkOnline" type="checkbox" class="w-5 h-5 cursor-pointer accent-[#ff1493]">
                <span class="text-sm">Show online sellers only</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input id="chkPremium" type="checkbox" class="w-5 h-5 cursor-pointer accent-[#8a2be2]">
                <span class="text-sm">Show premium sellers only</span>
            </label>
        </div>
        <div class="flex gap-4">
            <select id="sortPrice" class="px-4 py-2 font-medium text-white transition-colors border rounded-lg cursor-pointer bg-[#8a2be2]/40 border-[#8a2be2]">
                <option value="default">Price</option>
                <option value="low">Price: Low to High</option>
                <option value="high">Price: High to Low</option>
            </select>
            <select id="sortOrder" class="px-4 py-2 font-medium text-white transition-colors border rounded-lg cursor-pointer bg-[#8a2be2]/40 border-[#8a2be2]">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="popular">Most Popular</option>
            </select>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="grid grid-cols-5 gap-5 px-5 mx-auto mt-8 max-w-7xl" id="productsGrid"></section>

    <!-- Pagination -->
    <div class="flex justify-center gap-3 px-5 mx-auto mt-10 max-w-7xl">
        <button class="px-4 py-2 transition-colors border rounded-lg bg-[#8a2be2]/20 border-[#8a2be2]/40 hover:bg-[#8a2be2]/40">
            Prev
        </button>
        <button class="px-4 py-2 font-bold rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493]">
            1
        </button>
        <button class="px-4 py-2 transition-colors border rounded-lg bg-[#8a2be2]/20 border-[#8a2be2]/40 hover:bg-[#8a2be2]/40">
            Next
        </button>
    </div>

    <!-- Section Title -->
    <h2 class="px-5 mx-auto mt-16 mb-5 text-3xl font-bold max-w-7xl">
        Genshin Impact Accounts for Sale
    </h2>

    <!-- Game Categories -->
    <section class="px-5 mx-auto mt-12 max-w-7xl">
        <h2 class="mb-5 text-2xl font-bold">Popular RPG Games</h2>
        <div class="grid grid-cols-5 gap-4">
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Genshin Impact</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Honkai: Star Rail</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Wuthering Waves</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Honor of Kings</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">One Piece Dream Tour</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Haze Reverse</div>
        </div>
    </section>

    <section class="px-5 mx-auto mt-12 max-w-7xl">
        <h2 class="mb-5 text-2xl font-bold">Popular Gacha/Idle Games</h2>
        <div class="grid grid-cols-5 gap-4">
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Honkai Impact</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Guardian Tales</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">DOTA</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Indian Games</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Call of Duty Mobile</div>
        </div>
    </section>

    <section class="px-5 mx-auto mt-12 max-w-7xl">
        <h2 class="mb-5 text-2xl font-bold">Popular Mobile Games</h2>
        <div class="grid grid-cols-5 gap-4">
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">League of Legends</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Arcane Legends</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Brawl Stars</div>
        </div>
    </section>

    <section class="px-5 mx-auto mt-12 max-w-7xl">
        <h2 class="mb-5 text-2xl font-bold">Popular MMORPG</h2>
        <div class="grid grid-cols-5 gap-4">
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Aion Online</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Guild Wars 2</div>
            <div class="p-4 transition-all border cursor-pointer bg-[#2d1b4e]/60 border-[#8a2be2]/20 rounded-xl hover:bg-[#8a2be2]/30 hover:border-[#8a2be2]">Lost Ark (US)</div>
        </div>
    </section>


    <!-- footer -->
    <?php include 'footer.html'; ?>

    <script src="/Gaming-Store/js/script.js"></script>
</body>

</html>

