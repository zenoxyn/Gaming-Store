<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../html/head.html'; ?>
    <title>Gaming Store - Top-up</title>
</head>

<body class="min-h-screen overflow-x-hidden text-white">

    <!-- Header -->
    <?php include 'header.html'; ?>
    <!-- Hero Section -->
    <section class="px-5 mx-auto mt-8 max-w-7xl">

        <div class="from-primary/30 to-secondary/30 rounded-3xl p-16 relative overflow-hidden min-h-[300px] flex items-center">
            <img src="https://cdn-game-photos.zeusx.com/0f75d99e-f057-4a9d-b008-ce6e8ebf40e7.png" alt="" class="absolute top-0 left-0 object-cover w-full h-full opacity-80">
            <div class="z-10 max-w-xl">
                <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm transition rounded-full cursor-pointer bg-white/20 hover:bg-white/30" aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </button>
                <h1 id="heroTitle" class="mb-4 text-6xl font-bold text-transparent translate-y-4 opacity-0 bg-linear-to-r from-white to-yellow-300 bg-clip-text">
                    Free Fire
                </h1>
                <p class="mb-8 text-lg text-gray-200">
                    Pilih akun terbaik kamu disini!!
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
                        <span>in-Game Items</span>
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
        <button class="px-4 py-2 font-bold rounded-lg bg-gradient-to-r from-[#8a2be2] to-[#ff1493]">
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
    <script>
        const products = [{
                title: "Genshin Impact 64650+9600 unused genesis crystal + ALL 5stars + Only need to...",
                price: "$19.00",
                category: "Genshin Impact",
                seller: "Kartogaming",
                rating: "5.0 (456)",
                icon: "🎮"
            },
            {
                title: "🔰 5⭐80 Raiden Shogun, Crystals All servers ⚡ Only need to...",
                price: "$79.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "⚡"
            },
            {
                title: "💎 99820 Genshin Crystals AS Servers Login Needed 🔰",
                price: "$657.51",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "💎90820 Genshin Crystals All Servers Login Needed",
                price: "$42.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "🔰5⭐80 Raiden Shogun, Crystals ⚡ All servers ⚡ Only need to...",
                price: "$9.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "⚡"
            },
            {
                title: "UID: ALL SERVER| Blessing of the Welkin Moon",
                price: "$3.00",
                category: "Genshin Impact",
                seller: "Lazy China",
                rating: "5.0 (432)",
                icon: "🌙"
            },
            {
                title: "💎 1600+300 Genshin Crystals All Servers Login Needed 🔰",
                price: "$79.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "🔰 1⭐80 Raiden Shogun, Crystals ⚡ All servers ⚡ Only need to...",
                price: "$637.31",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "⚡"
            },
            {
                title: "Genshin Impact Reward Starter | All Servers",
                price: "$2.99",
                category: "Genshin Impact",
                seller: "Anonymous",
                rating: "4.8 (234)",
                icon: "🎁"
            },
            {
                title: "💎 8080 Genshin Crystals All Servers Login Needed",
                price: "$75.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "💎 1⭐00+300 Genshin Crystals All Servers Login Needed 🔰",
                price: "$4.32",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "💎 Genshin Crystals 3280+600 All Servers Login Needed",
                price: "$4.32",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "SGD-100 Crystals",
                price: "$43.00",
                category: "Top-ups",
                seller: "ZeuxRazer",
                rating: "4.9 (2073)",
                icon: "💳"
            },
            {
                title: "Genshin Gift Card Reward Starter Pack",
                price: "$14.99",
                category: "Top-ups",
                seller: "SteamGamer",
                rating: "4.7 (156)",
                icon: "🎁"
            },
            {
                title: "6480+1600 Crystals",
                price: "$60.89",
                category: "Genshin Impact",
                seller: "PleaseBuy",
                rating: "4.8 (1452)",
                icon: "💎"
            },
            {
                title: "💎 3280+600 Genesis Crystals 🔰 VIA UID AND SERVER 🔰",
                price: "$37.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (413)",
                icon: "💎"
            },
            {
                title: "💎 1980 + 600 Genesis Crystals 🔰 VIA UID AND SERVER 🔰",
                price: "$23.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (413)",
                icon: "💎"
            },
            {
                title: "💎 3280+600 Genesis Crystals 🔰 VIA UID AND SERVER 🔰",
                price: "$37.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (413)",
                icon: "💎"
            },
            {
                title: "💎 3280+600 Genesis Crystals 🔰 VIA UID AND SERVER 🔰",
                price: "$37.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (413)",
                icon: "💎"
            },
            {
                title: "💎 6480+1600 Genesis Crystals 🔰 VIA UID AND SERVER 🔰",
                price: "$78.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (413)",
                icon: "💎"
            },
            {
                title: "💎 8080+1600 Genesis Crystals AS Servers Login Needed",
                price: "$42.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "💎 8080+1600 Genesis Crystals All Servers Login Needed",
                price: "$42.00",
                category: "Genshin Impact",
                seller: "Eyed Store",
                rating: "5.0 (1034)",
                icon: "💎"
            },
            {
                title: "KAMC6+500 Gensis Crystals Moon",
                price: "$4.00",
                category: "Top-ups",
                seller: "Yukez",
                rating: "5.0 (99015)",
                icon: "🌙"
            },
            {
                title: "💎 6 + 300 + 600 Gensis Crystals Login Needed + UID and CS Proof",
                price: "$42.00",
                category: "Genshin Impact",
                seller: "CristalyinG.E~",
                rating: "5.0 (1023)",
                icon: "💎"
            },
            {
                title: "ALL SERVER! Genshin Genesis Crystals (All Package Available)",
                price: "$4.00",
                category: "Top-ups",
                seller: "Yellow",
                rating: "5.0 (19863)",
                icon: "💎"
            },
            {
                title: "ALL SERVER! Genshin Genesis Crystals (All Package Available)",
                price: "$76.00",
                category: "Top-ups",
                seller: "Yellow",
                rating: "5.0 (19863)",
                icon: "💎"
            },
            {
                title: "ALL SERVER! Genshin Genesis Crystals (All Package Available)",
                price: "$40.00",
                category: "Top-ups",
                seller: "Yellow",
                rating: "5.0 (19863)",
                icon: "💎"
            },
            {
                title: "6480+1600 Crystals Premium Account",
                price: "$85.00",
                category: "Genshin Impact",
                seller: "GameMaster",
                rating: "4.9 (567)",
                icon: "💎"
            },
            {
                title: "Welkin Moon + BP Bundle",
                price: "$12.50",
                category: "Top-ups",
                seller: "FastTopup",
                rating: "5.0 (8234)",
                icon: "🌙"
            },
            {
                title: "Limited 5-Star Character Account",
                price: "$125.00",
                category: "Genshin Impact",
                seller: "ProGamer",
                rating: "4.8 (892)",
                icon: "⭐"
            }
        ];

        // Normalize products with metadata used for filtering/sorting
        products.forEach((p, i) => {
            p.online = (i % 2 === 0); // simple deterministic flag
            p.premium = (i % 3 === 0);
            const m = p.rating && p.rating.match(/\((\d+)\)/);
            p.popularity = m ? parseInt(m[1], 10) : 0;
            const pr = parseFloat(String(p.price).replace(/[^0-9.]/g, ''));
            p.priceValue = isNaN(pr) ? 0 : pr;
            p.created = Date.now() - i * 86400000; // created at different days for sorting
        });

        const grid = document.getElementById('productsGrid');

        function createCard(product) {
            const card = document.createElement('div');
            card.className = 'bg-[#2d1b4e]/90 rounded-2xl overflow-hidden border-2 border-[#8a2be2]/20 hover:-translate-y-1 hover:border-[#8a2be2] transition-all cursor-pointer';
            card.innerHTML = `
                <div class="relative flex items-center justify-center text-5xl h-44 bg-gradient-to-br from-[#2d1b4e] to-purple-900">
                    ${product.icon}
                    <div class="absolute flex items-center gap-1 px-3 py-1 text-xs rounded-full top-2 right-2 bg-black/70">
                        <i class="text-yellow-400 fas fa-star"></i>
                        Top-rate
                    </div>
                    <div class="absolute flex items-center justify-center rounded-lg bottom-2 right-2 bg-[#8a2be2]/90 w-9 h-9">
                        <i class="text-sm fas fa-tag"></i>
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs font-semibold text-[#8a2be2]">${product.category}</div>
                    <div class="h-10 mb-3 overflow-hidden text-sm leading-tight">${product.title}</div>
                    <div class="mb-3 text-xl font-bold text-yellow-400">${product.price}</div>
                    <div class="flex items-center gap-2 pt-3 border-t border-[#8a2be2]/20">
                        <div class="flex items-center justify-center w-6 h-6 text-xs rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex items-center flex-1 gap-1 text-xs">
                            <span class="text-gray-300">${product.seller}</span>
                            <span class="text-xs text-yellow-400">
                                <i class="fas fa-star"></i> ${product.rating}
                            </span>
                        </div>
                    </div>
                </div>
            `;
            return card;
        }

        function renderProducts(list) {
            grid.innerHTML = '';
            if (!list || list.length === 0) {
                grid.innerHTML = '<div class="col-span-5 p-8 text-center text-gray-400">No products found.</div>';
                return;
            }
            list.forEach(p => grid.appendChild(createCard(p)));
        }

        function getFilteredProducts() {
            const online = document.getElementById('chkOnline').checked;
            const premium = document.getElementById('chkPremium').checked;
            const sortPrice = document.getElementById('sortPrice').value;
            const sortOrder = document.getElementById('sortOrder').value;

            let res = products.filter(p => (!online || p.online) && (!premium || p.premium));
            return res;
        }

        // Apply sorting to a list of products based on the controls
        function applySort(list) {
            const sortPrice = document.getElementById('sortPrice').value;
            const sortOrder = document.getElementById('sortOrder').value;
            const arr = Array.from(list);

            // Price sorting
            if (sortPrice === 'low') arr.sort((a, b) => a.priceValue - b.priceValue);
            else if (sortPrice === 'high') arr.sort((a, b) => b.priceValue - a.priceValue);

            // Order sorting (apply after price sort so it overrides if specified)
            if (sortOrder === 'newest') arr.sort((a, b) => b.created - a.created);
            else if (sortOrder === 'oldest') arr.sort((a, b) => a.created - b.created);
            else if (sortOrder === 'popular') arr.sort((a, b) => b.popularity - a.popularity);

            return arr;
        }

        function getFilteredProducts() {
            const online = document.getElementById('chkOnline').checked;
            const premium = document.getElementById('chkPremium').checked;

            let res = products.filter(p => (!online || p.online) && (!premium || p.premium));
            return applySort(res);
        }

        function applyFilters() {
            const filtered = getFilteredProducts();
            renderProducts(filtered);
        }

        // Wire up controls
        document.getElementById('chkOnline').addEventListener('change', applyFilters);
        document.getElementById('chkPremium').addEventListener('change', applyFilters);
        document.getElementById('sortPrice').addEventListener('change', applyFilters);
        document.getElementById('sortOrder').addEventListener('change', applyFilters);

        // Initial render
        applyFilters();

        // Hero controls: make buttons filter by category and animate title/buttons
        const heroControls = document.querySelectorAll('.hero-control');
        heroControls.forEach((btn, idx) => {
            // entry animation stagger
            setTimeout(() => {
                btn.classList.add('animate-hero-in');
            }, 150 * idx + 200);

            // normalize visual state
            btn.setAttribute('aria-pressed', 'false');
            btn.classList.remove('bg-[#8a2be2]/60', 'text-white', 'border-[#8a2be2]');
            btn.classList.add('bg-white/10', 'text-gray-100');

            btn.addEventListener('click', () => {
                const isActive = btn.getAttribute('aria-pressed') === 'true';

                // reset others
                heroControls.forEach(b => {
                    b.setAttribute('aria-pressed', 'false');
                    b.classList.remove('ring-2', 'ring-[#8a2be2]', 'bg-[#8a2be2]/60', 'text-white', 'border-[#8a2be2]');
                    b.classList.add('bg-white/10', 'text-gray-100');
                });

                if (!isActive) {
                    // activate this button
                    btn.setAttribute('aria-pressed', 'true');
                    btn.classList.add('ring-2', 'ring-[#8a2be2]', 'bg-[#8a2be2]/60', 'text-white', 'border-[#8a2be2]');

                    // determine filtering mapping
                    const cat = btn.getAttribute('data-category');
                    let filtered = products.slice();
                    if (cat === 'Accounts') {
                        filtered = products.filter(p => (p.category && p.category.toLowerCase().includes('genshin')) || (/account|premium/i.test(p.title)));
                    } else if (cat === 'Top-ups') {
                        filtered = products.filter(p => p.category && p.category.toLowerCase().includes('top'));
                    } else if (cat === 'Gaming Services') {
                        filtered = products.filter(p => !(p.category && p.category.toLowerCase().includes('genshin')) && !(p.category && p.category.toLowerCase().includes('top')));
                    }

                    renderProducts(filtered);
                } else {
                    // deactivate -> restore filters
                    btn.setAttribute('aria-pressed', 'false');
                    applyFilters();
                }
            });

            // Press feedback for pointer and keyboard
            btn.addEventListener('pointerdown', () => btn.classList.add('pressed', 'pressed'));
            btn.addEventListener('pointerup', () => btn.classList.remove('pressed'));
            btn.addEventListener('pointercancel', () => btn.classList.remove('pressed'));
            btn.addEventListener('pointerleave', () => btn.classList.remove('pressed'));
            btn.addEventListener('keydown', (e) => {
                if (e.key === ' ' || e.key === 'Enter') btn.classList.add('pressed');
            });
            btn.addEventListener('keyup', (e) => {
                if (e.key === ' ' || e.key === 'Enter') btn.classList.remove('pressed');
            });
        });

        // Animate hero title in
        const heroTitle = document.getElementById('heroTitle');
        setTimeout(() => {
            heroTitle.classList.remove('opacity-0', 'translate-y-4');
            heroTitle.classList.add('transition', 'duration-700', 'ease-out');
        }, 300);
    </script>

</body>

</html>