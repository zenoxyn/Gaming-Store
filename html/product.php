<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - ZEUSX.COM</title>
    <link href="../css/output.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- ✨ Loading Bar CSS -->
    <style>
        .back-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #8a2be2, #ff1493);
            transform: scaleX(0);
            transform-origin: left;
            z-index: 9999;
            transition: transform 0.3s ease;
            box-shadow: 0 0 10px rgba(138, 43, 226, 0.8);
        }

        .back-loading.active {
            animation: loadBar 0.5s ease forwards;
        }

        @keyframes loadBar {
            to { transform: scaleX(1); }
        }
    </style>
</head>
<body class="min-h-screen text-white font-jost" style="background: linear-gradient(to bottom right, #1a0b2e 0%, #2d1b4e 50%, #1a0b2e 100%);">

    <!-- ✨ Loading Bar -->
    <div class="back-loading" id="backLoading"></div>

    <!-- Header -->
    <?php include 'header.html'; ?>

    <!-- Back Button -->
<!-- Back Button -->
<div class="px-6 mx-auto mt-6 max-w-7xl">
    <button onclick="goBack()" class="inline-flex items-center gap-2 px-4 py-2 text-sm transition border rounded-full cursor-pointer bg-white/10 hover:bg-white/20 border-white/20">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </button>
</div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 gap-8 px-6 mx-auto mt-8 max-w-7xl lg:grid-cols-3">
        
        <!-- Left Column - Product Details -->
        <div class="lg:col-span-2">
            
            <!-- Product Image Banner -->
            <div class="relative overflow-hidden rounded-2xl h-96">
                <img src="https://d1x91p7vw3vuq8.cloudfront.net/itemku-upload/202284/de4xbo0h2gnhuamecypwv.jpg" 
                     alt="Product Banner" 
                     class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                
                <!-- Share & Like Buttons -->
                <div class="absolute flex gap-2 top-4 right-4">
                    <button onclick="shareProduct()" class="p-4 transition rounded-full cursor-pointer bg-black/50 hover:bg-black/70">
                        <i class="fas fa-share-alt"></i>
                    </button>
                    <button onclick="toggleLike(this)" class="p-2 transition rounded-full cursor-pointer bg-black/50 hover:bg-black/70">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>

            <!-- Description Section -->
            <div class="p-6 mt-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center gap-2 mb-4">
                    <i class="text-xl fas fa-file-alt text-[#8a2be2]"></i>
                    <h3 class="text-xl font-bold">Description</h3>
                </div>
                
                <div class="space-y-4 text-sm leading-relaxed text-gray-300">
                    <p>This account comes with all the perks you need to THRIVE, and that includes, but is not limited to the list below.</p>
                    
                    <div class="p-4 rounded-lg bg-white/5">
                        <h4 class="mb-3 font-semibold text-white">Account Features:</h4>
                        <ul class="space-y-2 list-disc list-inside">
                            <li>Server: Europe (EU)</li>
                            <li>Adventure Rank: 40-50</li>
                            <li>5★ Characters: Varka, Raiden Shogun</li>
                            <li>5★ Weapons: Fang of the Mountain King</li>
                            <li>Primogems: 0-5000</li>
                            <li>Gender: Male Traveler</li>
                            <li>Email: Linked (Full Access)</li>
                            <li>Guaranteed pity system intact</li>
                            <li>Multiple 4★ characters leveled</li>
                        </ul>
                    </div>

                    <div class="p-4 mt-4 border-l-4 border-yellow-400 rounded bg-yellow-400/10">
                        <p class="text-sm text-yellow-400">
                            <i class="mr-2 fas fa-exclamation-triangle"></i>
                            <strong>Important:</strong> Please change the password immediately after receiving the account details.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Specifications -->
            <div class="p-6 mt-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center gap-2 mb-4">
                    <i class="text-xl fas fa-list text-[#8a2be2]"></i>
                    <h3 class="text-xl font-bold">Specifications</h3>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Platform</div>
                        <div class="font-semibold">PC / Mobile / PS5</div>
                    </div>
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Server</div>
                        <div class="font-semibold">Europe (EU)</div>
                    </div>
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Gender</div>
                        <div class="font-semibold">Male</div>
                    </div>
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Adventure Rank</div>
                        <div class="font-semibold">AR 40-50</div>
                    </div>
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Primogems</div>
                        <div class="font-semibold">0-5000</div>
                    </div>
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">Email Status</div>
                        <div class="font-semibold text-green-400">Full Email Access</div>
                    </div>
                </div>
            </div>

            <!-- Seller Reviews -->
            <div class="p-6 mt-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <i class="text-xl fas fa-star text-[#8a2be2]"></i>
                        <h3 class="text-xl font-bold">Seller Reviews</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-yellow-400">4.8</span>
                        <div class="flex gap-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-4" id="reviewsContainer">
                    <!-- Review 1 -->
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold">Anonymous</span>
                                    <div class="flex gap-1 text-yellow-400">
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                    </div>
                                    <span class="text-xs text-gray-400">2 days ago</span>
                                </div>
                                <p class="text-sm text-gray-300">Great service! Account exactly as described. Fast delivery.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 2 -->
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold">GameLover123</span>
                                    <div class="flex gap-1 text-yellow-400">
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                    </div>
                                    <span class="text-xs text-gray-400">5 days ago</span>
                                </div>
                                <p class="text-sm text-gray-300">Excellent seller! Very responsive and helpful. Highly recommend!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 3 -->
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold">ProGamer</span>
                                    <div class="flex gap-1 text-yellow-400">
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs fas fa-star"></i>
                                        <i class="text-xs far fa-star"></i>
                                    </div>
                                    <span class="text-xs text-gray-400">1 week ago</span>
                                </div>
                                <p class="text-sm text-gray-300">Good account, took a bit longer than expected but everything works fine.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Reviews -->
                    <div id="hiddenReviews" class="hidden space-y-4">
                        <div class="p-4 rounded-lg bg-white/5">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-semibold">TopBuyer99</span>
                                        <div class="flex gap-1 text-yellow-400">
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                        </div>
                                        <span class="text-xs text-gray-400">2 weeks ago</span>
                                    </div>
                                    <p class="text-sm text-gray-300">Amazing! Got the account instantly. Everything works perfectly!</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-white/5">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-white rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-semibold">PlayerOne</span>
                                        <div class="flex gap-1 text-yellow-400">
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                            <i class="text-xs fas fa-star"></i>
                                        </div>
                                        <span class="text-xs text-gray-400">3 weeks ago</span>
                                    </div>
                                    <p class="text-sm text-gray-300">Best seller on this platform. Will buy again!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="toggleReviews()" id="showMoreBtn" class="w-full py-3 mt-4 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 bg-[#8a2be2]/20 hover:bg-[#8a2be2]/30">
                    Show More Reviews
                </button>
            </div>

        </div>

        <!-- Right Column - Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4">
                
                <!-- Purchase Card -->
                <div class="overflow-hidden border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    
                    <!-- Seller Info -->
                    <div class="flex items-center gap-3 p-6 pb-4">
                        <div class="relative">
                            <div class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                <img src="https://ui-avatars.com/api/?name=Candy4Gamers&background=8a2be2&color=fff" 
                                     alt="Seller" 
                                     class="object-cover w-full h-full">
                            </div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 rounded-full border-[#2d1b4e]"></div>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-white hover:text-[#8a2be2] transition cursor-pointer">
                                <a href="#" onclick="viewSellerProfile(); return false;">Candy4Gamers</a>
                            </h5>
                            <div class="flex items-center gap-3 text-xs">
                                <span class="flex items-center gap-1 text-green-400">
                                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                                    Active Now
                                </span>
                                <span class="flex items-center gap-1 text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <span class="font-semibold">5.0</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Title & Price -->
                    <div class="px-6 pb-4">
                        <p class="mb-3 text-sm leading-tight text-gray-300">
                            [EU] AR40-50 | Varka+Raiden+Fang of the Mountain King | 0-5000 Primogems | Male | Email Linked
                        </p>
                        <div class="text-3xl font-bold text-yellow-400">$39.99</div>
                    </div>

                    <!-- Quantity & Buy Button -->
                    <div class="px-6 pb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <!-- Quantity -->
                            <div class="flex items-center border-2 rounded-lg border-[#8a2be2]/30">
                                <button onclick="decreaseQuantity()" class="px-3 py-2 transition cursor-pointer hover:bg-white/5">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span id="quantity" class="px-4 font-semibold">1</span>
                                <button onclick="increaseQuantity()" class="px-3 py-2 transition cursor-pointer hover:bg-white/5">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <!-- Buy Button -->
                            <button onclick="buyNow()" class="flex-1 py-3 font-semibold text-white transition rounded-lg cursor-pointer bg-gradient-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                                Buy Now
                            </button>
                        </div>

                        <button onclick="addToCart()" class="w-full py-3 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 hover:bg-white/5">
                            Add to Cart
                        </button>
                    </div>

                    <!-- ZeusX Guarantee -->
                    <div class="flex gap-3 px-6 py-4 border-t bg-[#8a2be2]/5 border-[#8a2be2]/20">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                <i class="text-xl fas fa-shield-alt"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h6 class="mb-1 text-sm font-semibold">ZeusX Guarantee</h6>
                            <p class="text-xs leading-relaxed text-gray-400">
                                Your purchase made on the ZeusX platform are protected by us. 
                                <a href="#" onclick="showGuaranteeInfo(); return false;" class="font-medium text-[#8a2be2] hover:underline cursor-pointer">Read more</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="p-6 mt-4 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <div class="flex items-center gap-2 mb-4">
                        <i class="text-xl fas fa-truck text-[#8a2be2]"></i>
                        <h3 class="text-lg font-bold">Delivery Info</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Delivery Time</span>
                            <span class="font-semibold text-green-400">Instant - 5 mins</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Delivery Method</span>
                            <span class="font-semibold">Email / Chat</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Stock</span>
                            <span id="stockCount" class="font-semibold text-yellow-400">3 Available</span>
                        </div>
                    </div>
                </div>

                <!-- Seller Stats -->
                <div class="p-6 mt-4 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-4 text-lg font-bold">Seller Statistics</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Member Since</span>
                            <span class="font-semibold">Jan 2023</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Total Sales</span>
                            <span class="font-semibold text-green-400">1,234+</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Response Rate</span>
                            <span class="font-semibold text-blue-400">98%</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Response Time</span>
                            <span class="font-semibold">~2 hours</span>
                        </div>
                    </div>

                    <button onclick="viewSellerProfile()" class="w-full py-3 mt-4 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 hover:bg-[#8a2be2]/20">
                        View Seller Profile
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Similar Items -->
    <div class="px-6 mx-auto mt-16 mb-16 max-w-7xl">
        <h2 class="mb-6 text-2xl font-bold">Similar Items You May Like</h2>
        
        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">
            <!-- Item 1 -->
            <div onclick="viewProduct(1)" class="overflow-hidden transition border cursor-pointer rounded-xl bg-[#2d1b4e]/90 border-[#8a2be2]/20 hover:border-[#8a2be2] hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-purple-900 to-purple-700">
                    <img src="https://cdn-game-photos.zeusx.com/4a28aae3-9f69-46e8-bccc-4215613ade0e.png" 
                         alt="Product" 
                         class="object-cover w-full h-full opacity-80">
                    <div class="absolute px-2 py-1 text-xs font-bold rounded top-2 right-2 bg-gradient-to-r from-[#8a2be2] to-[#ff1493]">
                        HOT
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs text-[#8a2be2] font-semibold">Genshin Impact</div>
                    <h3 class="mb-2 text-sm font-medium leading-tight line-clamp-2">
                        [EU] AR45+ | Nahida+Raiden | 10000+ Primos
                    </h3>
                    <div class="mb-2 text-lg font-bold text-yellow-400">$45.99</div>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="text-yellow-400 fas fa-star"></i>
                            4.9 (234)
                        </span>
                        <span>FastSeller</span>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div onclick="viewProduct(2)" class="overflow-hidden transition border cursor-pointer rounded-xl bg-[#2d1b4e]/90 border-[#8a2be2]/20 hover:border-[#8a2be2] hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-purple-900 to-purple-700">
                    <img src="https://cdn-game-photos.zeusx.com/4a28aae3-9f69-46e8-bccc-4215613ade0e.png" 
                         alt="Product" 
                         class="object-cover w-full h-full opacity-80">
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs text-[#8a2be2] font-semibold">Genshin Impact</div>
                    <h3 class="mb-2 text-sm font-medium leading-tight line-clamp-2">
                        [NA] AR50+ | Zhongli+Hu Tao | Email Access
                    </h3>
                    <div class="mb-2 text-lg font-bold text-yellow-400">$52.00</div>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="text-yellow-400 fas fa-star"></i>
                            5.0 (156)
                        </span>
                        <span>ProGamer</span>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div onclick="viewProduct(3)" class="overflow-hidden transition border cursor-pointer rounded-xl bg-[#2d1b4e]/90 border-[#8a2be2]/20 hover:border-[#8a2be2] hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-purple-900 to-purple-700">
                    <img src="https://cdn-game-photos.zeusx.com/4a28aae3-9f69-46e8-bccc-4215613ade0e.png" 
                         alt="Product" 
                         class="object-cover w-full h-full opacity-80">
                    <div class="absolute px-2 py-1 text-xs font-bold rounded top-2 right-2 bg-gradient-to-r from-[#8a2be2] to-[#ff1493]">
                        NEW
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs text-[#8a2be2] font-semibold">Genshin Impact</div>
                    <h3 class="mb-2 text-sm font-medium leading-tight line-clamp-2">
                        [EU] AR40 | Yelan+Xiao | Fresh Account
                    </h3>
                    <div class="mb-2 text-lg font-bold text-yellow-400">$29.99</div>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="text-yellow-400 fas fa-star"></i>
                            4.7 (89)
                        </span>
                        <span>QuickShop</span>
                    </div>
                </div>
            </div>

            <!-- Item 4 -->
            <div onclick="viewProduct(4)" class="overflow-hidden transition border cursor-pointer rounded-xl bg-[#2d1b4e]/90 border-[#8a2be2]/20 hover:border-[#8a2be2] hover:-translate-y-1">
                <div class="relative h-48 bg-gradient-to-br from-purple-900 to-purple-700">
                    <img src="https://cdn-game-photos.zeusx.com/4a28aae3-9f69-46e8-bccc-4215613ade0e.png" 
                         alt="Product" 
                         class="object-cover w-full h-full opacity-80">
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs text-[#8a2be2] font-semibold">Genshin Impact</div>
                    <h3 class="mb-2 text-sm font-medium leading-tight line-clamp-2">
                        [ASIA] AR55+ | Ayaka+Kazuha | Endgame Ready
                    </h3>
                    <div class="mb-2 text-lg font-bold text-yellow-400">$68.00</div>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="text-yellow-400 fas fa-star"></i>
                            4.8 (312)
                        </span>
                        <span>GamerStore</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.html'; ?>

    <!-- JavaScript -->
    <script>
    let quantity = 1;
    let isLiked = false;
    let showingAllReviews = false;

    // ✨ TAMBAHKAN FUNCTION INI
    function goBack() {
        // Show loading
        document.getElementById('backLoading').classList.add('active');
        
        // Go back setelah sedikit delay
        setTimeout(function() {
            window.location.href = 'top-up.php'; // Atau bisa pakai history.back()
        }, 300);
    }

        // Quantity Functions
        function increaseQuantity() {
            if (quantity < 3) {
                quantity++;
                updateQuantityDisplay();
            } else {
                alert('Maximum stock is 3 items');
            }
        }

        function decreaseQuantity() {
            if (quantity > 1) {
                quantity--;
                updateQuantityDisplay();
            }
        }

        function updateQuantityDisplay() {
            document.getElementById('quantity').textContent = quantity;
        }

        // Buy and Cart Functions
        function buyNow() {
            alert(`Processing purchase of ${quantity} item(s) for $${(39.99 * quantity).toFixed(2)}\n\nRedirecting to checkout...`);
            // window.location.href = 'checkout.php';
        }

        function addToCart() {
            alert(`Added ${quantity} item(s) to cart successfully!`);
            // Add animation or notification here
        }

        // Like/Favorite Function
        function toggleLike(button) {
            isLiked = !isLiked;
            const icon = button.querySelector('i');
            
            if (isLiked) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#ff1493';
                
                // Add animation
                button.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 200);
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '';
            }
        }

        // Share Function
        function shareProduct() {
            if (navigator.share) {
                navigator.share({
                    title: 'Genshin Impact Account',
                    text: 'Check out this amazing Genshin Impact account!',
                    url: window.location.href
                }).catch(err => console.log('Error sharing:', err));
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Product link copied to clipboard!');
                });
            }
        }

        // Reviews Functions
        function toggleReviews() {
            const hiddenReviews = document.getElementById('hiddenReviews');
            const btn = document.getElementById('showMoreBtn');
            
            showingAllReviews = !showingAllReviews;
            
            if (showingAllReviews) {
                hiddenReviews.classList.remove('hidden');
                btn.textContent = 'Show Less Reviews';
            } else {
                hiddenReviews.classList.add('hidden');
                btn.textContent = 'Show More Reviews';
            }
        }

        // Seller Profile
        function viewSellerProfile() {
            alert('Redirecting to Candy4Gamers profile...');
            // window.location.href = 'seller-profile.php?id=candy4gamers';
        }

        // Guarantee Info
        function showGuaranteeInfo() {
            alert('ZeusX Guarantee:\n\n✓ Money-back guarantee\n✓ Secure payment processing\n✓ Account verification\n✓ 24/7 customer support\n✓ Dispute resolution service');
        }

        // View Product
        function viewProduct(id) {
            alert(`Loading product #${id}...`);
            // window.location.href = `product.php?id=${id}`;
        }

        // Smooth scroll to top when page loads
        window.addEventListener('load', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

</body>
</html>