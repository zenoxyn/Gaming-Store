<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../html/head.html'; ?>
    <title>Gaming Store - In-Game Items</title>
</head>

<body>
    <!-- header -->
    <?php include 'header.html'; ?>

    <!-- main content -->

    <body class=" text-white">

        <!-- HEADER GRADIENT -->
        <div class="w-full h-48 bg-linear-to-r from-[#6A0DAD] via-[#4B0FAF] to-[#2AD1C9] p-6">
            <button class="text-md px-4 py-1 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur transition font-bold gap-2">
            <i class="ri-arrow-left-s-line "></i> Back
            </button>

            <h1 class="text-4xl font-bold mt-6">8 Ball Pool</h1>
        </div>

        <!-- TABS -->
        <div class="w-full border-b border-white/10 bg-[#0F001A]">
            <div class="max-w-7xl mx-auto px-6 flex gap-6 overflow-x-auto">

                <!-- Tab Item -->
                <button class="flex items-center gap-2 py-4 text-white/60 hover:text-white transition">
                    <img src="icons/account.svg" class="w-5">
                    <span>Accounts</span>
                    <span class="ml-2 text-xs bg-white/10 px-2 py-0.5 rounded-full">379</span>
                </button>

                <button class="flex items-center gap-2 py-4 border-b-2 border-yellow-400 text-yellow-400">
                    <img src="icons/items.svg" class="w-5">
                    <span>In-Game Items</span>
                    <span class="ml-2 text-xs bg-yellow-400/20 px-2 py-0.5 rounded-full">1322</span>
                </button>

                <button class="flex items-center gap-2 py-4 text-white/60 hover:text-white transition">
                    <img src="icons/topup.svg" class="w-5">
                    <span>Top-ups</span>
                    <span class="ml-2 text-xs bg-white/10 px-2 py-0.5 rounded-full">823</span>
                </button>
            </div>
        </div>

        <!-- SEARCH SECTION -->
        <div class="max-w-7xl mx-auto px-6 mt-10">
            <div class="bg-white/5 p-6 rounded-xl border border-white/10">
                <h2 class="text-lg font-semibold mb-4">Search Items</h2>

                <div class="flex items-center gap-4">

                    <!-- Input -->
                    <input type="text"
                        placeholder="Keyword search..."
                        class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 focus:outline-none focus:border-purple-400 placeholder-white/40">

                    <!-- Search button -->
                    <button class="bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-lg font-semibold">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <!-- FILTERS -->
        <div class="max-w-7xl mx-auto px-6 mt-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-8">

                <!-- Toggle -->
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="accent-purple-500 h-5 w-5">
                    <span>Show online sellers only</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="accent-purple-500 h-5 w-5">
                    <span>Show premium sellers only</span>
                </label>
            </div>

            <!-- DROPDOWNS -->
            <div class="flex items-center gap-4">
                <select class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg">
                    <option>Price</option>
                    <option>Lowest</option>
                    <option>Highest</option>
                </select>

                <select class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg">
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div>
        </div>

        <!-- GRID ITEMS -->
        <div class="max-w-7xl mx-auto px-6 mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <!-- CARD ITEM -->
            <div class="bg-white/5 rounded-xl p-3 border border-white/10 hover:-translate-y-1 transition duration-200 cursor-pointer">
                <div class="relative">
                    <img src="items/item1.jpg" class="rounded-lg w-full">
                    <button class="absolute top-3 right-3 bg-white p-1.5 rounded-full shadow">
                        ❤️
                    </button>
                </div>

                <h3 class="mt-4 font-semibold">Cash + Legendary Boxes</h3>
                <p class="text-sm text-white/60">Best seller pack</p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-bold">$5.50</span>
                    <button class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg text-sm">
                        Buy Now
                    </button>
                </div>
            </div>

            <!-- Duplicate more cards -->
            <div class="bg-white/5 rounded-xl p-3 border border-white/10 hover:-translate-y-1 transition duration-200 cursor-pointer">
                <div class="relative">
                    <img src="items/item2.jpg" class="rounded-lg w-full">
                    <button class="absolute top-3 right-3 bg-white p-1.5 rounded-full shadow">
                        ❤️
                    </button>
                </div>

                <h3 class="mt-4 font-semibold">Collector's Box</h3>
                <p class="text-sm text-white/60">Limited edition</p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-bold">$9.99</span>
                    <button class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg text-sm">
                        Buy Now
                    </button>
                </div>
            </div>

        </div>


        <!-- footer -->
        <?php include 'footer.html'; ?>
    </body>

</html>