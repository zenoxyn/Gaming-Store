<x-layout>

    <!-- ✨ Full Page Loading Screen -->
    <div class="page-loader" id="pageLoader">
        <div>
            <div class="loader-spinner"></div>
            <div class="loader-text">Loading...</div>
        </div>
    </div>


    <!-- Mobile Sticky Header -->
    <div class="sticky top-0 z-50 px-4 py-3 border-b lg:hidden bg-[#2d1b4e]/95 backdrop-blur-lg border-[#8a2be2]/30">
        <div class="flex items-center gap-3">
            <button onclick="goBack()" class="flex items-center justify-center w-10 h-10 transition border rounded-full cursor-pointer bg-white/10 hover:bg-white/20 border-white/20">
                <i class="fas fa-arrow-left"></i>
            </button>
            <div class="flex-1 text-base font-semibold truncate">Product Detail</div>
        </div>
    </div>

    <!-- Desktop Back Button -->
    <div class="hidden px-6 mx-auto mt-6 max-w-7xl lg:block">
        <button onclick="goBack()" class="inline-flex items-center gap-2 px-4 py-2 text-sm transition border rounded-full cursor-pointer bg-white/10 hover:bg-white/20 border-white/20">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 gap-4 px-4 mx-auto mt-4 lg:gap-8 lg:px-6 lg:mt-8 max-w-7xl lg:grid-cols-3 pb-24 lg:pb-8">

        <!-- Left Column - Product Details -->
        <div class="lg:col-span-2">

            <!-- Product Image Banner -->
            @php
                $productImages = is_array($product->images) ? $product->images : [];
            @endphp
            <div class="relative overflow-hidden rounded-2xl h-80 lg:h-96 {{ empty($productImages) ? 'bg-linear-to-br from-[#2d1b4e] to-purple-900' : 'bg-black' }}">
                @if(!empty($productImages))
                    <img src="{{ asset('storage/' . $productImages[0]) }}"
                         alt="{{ $product->name_product }}"
                         class="object-cover w-full h-full">
                @else
                    <div class="flex items-center justify-center w-full h-full text-6xl lg:text-8xl">
                        🎮
                    </div>
                    <div class="absolute inset-0 bg-linear-to-t from-black/80 to-transparent"></div>
                @endif

                <!-- Share & Like Buttons -->
                <div class="absolute flex flex-col gap-2 top-4 right-4">
                    <button onclick="shareProduct()" class="flex items-center justify-center w-11 h-11 transition rounded-full cursor-pointer bg-black/60 hover:bg-black/70 backdrop-blur-sm">
                        <i class="fas fa-share-alt"></i>
                    </button>
                    <button onclick="toggleLike(this)" class="flex items-center justify-center w-11 h-11 transition rounded-full cursor-pointer bg-black/60 hover:bg-black/70 backdrop-blur-sm">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Seller & Product Card -->
            <div class="block mt-4 space-y-4 lg:hidden">
                <!-- Seller Card Mobile -->
                <div class="p-4 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="relative">
                            <div class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller->user->username) }}&background=8a2be2&color=fff"
                                     alt="{{ $product->seller->user->username }}"
                                     class="object-cover w-full h-full">
                            </div>
                            @if($product->seller->user->is_online ?? false)
                                <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-400 border-2 rounded-full border-[#2d1b4e]"></div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-white">{{ $product->seller->user->username }}</h5>
                            <div class="flex items-center gap-3 text-xs">
                                @if($product->seller->user->is_online ?? false)
                                    <span class="flex items-center gap-1 text-green-400">
                                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                                        Active Now
                                    </span>
                                @else
                                    <span class="flex items-center gap-1 text-gray-400">
                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                        Offline
                                    </span>
                                @endif
                                <span class="flex items-center gap-1 text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <span class="font-semibold">{{ number_format($product->seller->rating, 1) }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button onclick="openChat()" class="w-full py-3 font-semibold transition border rounded-xl cursor-pointer border-[#8a2be2]/40 bg-[#8a2be2]/20 hover:bg-[#8a2be2]/30 flex items-center justify-center gap-2">
                        <i class="fas fa-comment-dots"></i>
                        <span>Chat With Seller</span>
                    </button>
                </div>

                <!-- Product Info Mobile -->
                <div class="p-4 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h1 class="mb-3 text-lg font-semibold leading-tight">{{ $product->name_product }}</h1>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="text-2xl font-bold text-yellow-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</div>
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <div class="text-sm text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="px-2 py-1 text-xs font-bold rounded bg-red-600">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</div>
                        @endif
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border rounded-xl bg-green-400/10 border-green-400/30">
                        <span class="text-sm"><i class="mr-2 text-green-400 fas fa-check-circle"></i>In Stock: {{ $product->stock }} items</span>
                        <span class="text-sm font-semibold text-green-400">Available</span>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="p-4 mt-4 border lg:p-6 lg:mt-6 rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center justify-between gap-2 mb-4 cursor-pointer lg:cursor-default" onclick="toggleMobileSection(this)">
                    <div class="flex items-center gap-2">
                        <i class="text-lg lg:text-xl fas fa-file-alt text-[#8a2be2]"></i>
                        <h3 class="text-base font-bold lg:text-xl">Description</h3>
                    </div>
                    <i class="transition-transform fas fa-chevron-down lg:hidden text-[#8a2be2]"></i>
                </div>

                <div class="space-y-4 text-sm leading-relaxed text-gray-300 mobile-collapsible">
                    <div class="whitespace-pre-wrap">{{ $product->description }}</div>

                    <div class="p-4 mt-4 border-l-4 border-yellow-400 rounded bg-yellow-400/10">
                        <p class="text-sm text-yellow-400">
                            <i class="mr-2 fas fa-exclamation-triangle"></i>
                            <strong>Important:</strong> Please verify all product details before purchasing.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Specifications -->
            @if($product->product_details && count($product->getFormattedSpecs()) > 0)
            <div class="p-4 mt-4 border lg:p-6 lg:mt-6 rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center justify-between gap-2 mb-4 cursor-pointer lg:cursor-default" onclick="toggleMobileSection(this)">
                    <div class="flex items-center gap-2">
                        <i class="text-lg lg:text-xl fas fa-list text-[#8a2be2]"></i>
                        <h3 class="text-base font-bold lg:text-xl">Specifications</h3>
                    </div>
                    <i class="transition-transform fas fa-chevron-down lg:hidden text-[#8a2be2]"></i>
                </div>

                <div class="mobile-collapsible">

                    <div class="grid grid-cols-2 gap-3 lg:gap-4">
                        @foreach($product->getFormattedSpecs() as $spec)
                        <div class="p-3 lg:p-4 rounded-lg bg-white/5">
                        <div class="mb-1 text-xs text-gray-400">{{ $spec['label'] }}</div>
                        <div class="font-semibold {{ in_array($spec['label'], ['Email Status', 'Delivery Time']) ? 'text-green-400' : '' }}">
                            {{ $spec['value'] }}
                        </div>
                    </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Seller Reviews -->
            <div class="p-4 mt-4 border lg:p-6 lg:mt-6 rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="flex items-center justify-between mb-4 cursor-pointer lg:mb-6 lg:cursor-default" onclick="toggleMobileSection(this)">
                    <div class="flex items-center gap-2">
                        <i class="text-lg lg:text-xl fas fa-star text-[#8a2be2]"></i>
                        <h3 class="text-base font-bold lg:text-xl">Seller Reviews</h3>
                        <span class="text-lg font-bold text-yellow-400 lg:hidden">{{ number_format($product->seller->rating, 1) }}</span>
                    </div>
                    <i class="transition-transform fas fa-chevron-down lg:hidden text-[#8a2be2]"></i>
                </div>

                <div class="mobile-collapsible">
                    <div class="items-center hidden gap-2 mb-6 lg:flex">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-yellow-400">{{ number_format($product->seller->rating, 1) }}</span>
                        <div class="flex gap-1 text-yellow-400">
                            @php
                                $rating = $product->seller->rating;
                                $fullStars = floor($rating);
                                $hasHalfStar = ($rating - $fullStars) >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fas fa-star"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="space-y-4" id="reviewsContainer">
                    @forelse($sellerReviews->take(3) as $review)
                    <div class="p-4 rounded-lg bg-white/5">
                        <div class="flex items-start gap-3">
                            <div class="flex items-center justify-center shrink-0 w-10 h-10 text-white rounded-full bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-semibold">{{ $review->buyer->username }}</span>
                                    <div class="flex gap-1 text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="text-xs fas fa-star"></i>
                                            @else
                                                <i class="text-xs far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-gray-300">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400">
                        <i class="mb-2 text-3xl fas fa-star-half-alt text-[#8a2be2]"></i>
                        <p>No reviews yet for this seller</p>
                    </div>
                    @endforelse

                    @if($sellerReviews->count() > 3)
                    <!-- Hidden Reviews -->
                    <div id="hiddenReviews" class="hidden space-y-4">
                        @foreach($sellerReviews->skip(3) as $review)
                        <div class="p-4 rounded-lg bg-white/5">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center shrink-0 w-10 h-10 text-white rounded-full bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-semibold">{{ $review->buyer->username }}</span>
                                        <div class="flex gap-1 text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="text-xs fas fa-star"></i>
                                                @else
                                                    <i class="text-xs far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-300">{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                    @if($sellerReviews->count() > 3)
                    <button onclick="toggleReviews()" id="showMoreBtn" class="w-full py-3 mt-4 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 bg-[#8a2be2]/20 hover:bg-[#8a2be2]/30">
                        Show More Reviews
                    </button>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column - Sidebar (Desktop Only) -->
        <div class="hidden lg:block lg:col-span-1">
            <div class="sticky top-4">

                <!-- Purchase Card -->
                <div class="overflow-hidden border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">

                    <!-- Seller Info -->
                    <div class="flex items-center gap-3 p-6 pb-4">
                        <div class="relative">
                            <div class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller->user->username) }}&background=8a2be2&color=fff"
                                     alt="{{ $product->seller->user->username }}"
                                     class="object-cover w-full h-full">
                            </div>
                            @if($product->seller->user->is_online ?? false)
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 rounded-full border-[#2d1b4e]"></div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h5 class="font-semibold text-white hover:text-[#8a2be2] transition">
                                {{ $product->seller->user->username }}
                            </h5>
                            <div class="flex items-center gap-3 text-xs">
                                @if($product->seller->user->is_online ?? false)
                                    <span class="flex items-center gap-1 text-green-400">
                                        <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                                        Online
                                    </span>
                                @else
                                    <span class="flex items-center gap-1 text-gray-400">
                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full"></div>
                                        Offline
                                    </span>
                                @endif
                                <span class="flex items-center gap-1 text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <span class="font-semibold">{{ number_format($product->seller->rating, 1) }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Title & Price -->
                    <div class="px-6 pb-4">
                        <p class="mb-3 text-sm leading-tight text-gray-300">
                            {{ $product->name_product }}
                        </p>
                        <div class="flex items-baseline gap-3">
                            <div class="text-2xl font-bold text-yellow-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</div>
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <div class="text-base text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="px-2 py-1 text-xs font-bold rounded bg-red-600">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</div>
                            @endif
                        </div>
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
                            <button onclick="buyNow()" class="flex-1 py-3 font-semibold text-white transition rounded-lg cursor-pointer bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                                Buy Now
                            </button>
                        </div>

                        <button onclick="addToCart()" class="w-full py-3 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 hover:bg-white/5">
                            Add to Cart
                        </button>

                        {{-- Negotiate Button (Only for buyers, not sellers viewing their own product) --}}
                        @auth
                            @if(auth()->user()->canBuy() && $product->id_seller !== auth()->id() && $product->status === 'available')
                                <a href="{{ route('negotiation.create', $product->id) }}"
                                   class="block w-full py-3 mt-3 font-semibold text-center transition border rounded-lg border-yellow-500/40 bg-yellow-500/20 hover:bg-yellow-500/30 text-yellow-400">
                                    <i class="ri-chat-3-line mr-2"></i>Negotiate Price
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- ZeusX Guarantee -->
                    <div class="flex gap-3 px-6 py-4 border-t bg-[#8a2be2]/5 border-[#8a2be2]/20">
                        <div class="shrink-0">
                            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
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
                            <span id="stockCount" class="font-semibold {{ $product->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                                {{ $product->stock }} {{ $product->stock > 0 ? 'Available' : 'Sold Out' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Seller Stats -->
                <div class="p-6 mt-4 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-4 text-lg font-bold">Seller Statistics</h3>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Member Since</span>
                            <span class="font-semibold">{{ $product->seller->created_at->format('M Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Total Sales</span>
                            <span class="font-semibold text-green-400">{{ $product->seller->user->sellerOrders()->where('order_status', 'completed')->count() }}+</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Total Products</span>
                            <span class="font-semibold text-blue-400">{{ $product->seller->user->products()->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400">Average Rating</span>
                            <span class="font-semibold text-yellow-400">{{ number_format($product->seller->rating, 1) }} <i class="fas fa-star text-xs"></i></span>
                        </div>
                    </div>

                    <button onclick="viewSellerProfile()" class="w-full py-3 mt-4 font-semibold transition border rounded-lg cursor-pointer border-[#8a2be2]/40 hover:bg-[#8a2be2]/20">
                        View Seller Profile
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Mobile Fixed Bottom Bar -->
    <div class="fixed bottom-0 left-0 right-0 z-40 px-4 py-3 border-t lg:hidden bg-[#2d1b4e]/98 backdrop-blur-lg border-[#8a2be2]/30 shadow-2xl">
        <div class="flex items-center gap-3">
            <div class="flex flex-col">
                <div class="text-[10px] text-gray-400">Total Price</div>
                <div class="text-lg font-bold text-yellow-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</div>
            </div>
            <div class="flex flex-1 gap-2">
                <button onclick="addToCart()" class="flex items-center justify-center flex-1 gap-2 py-3 font-semibold transition border rounded-xl cursor-pointer border-[#8a2be2]/50 bg-[#8a2be2]/30 hover:bg-[#8a2be2]/40">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="text-sm">Cart</span>
                </button>
                <button onclick="buyNow()" class="flex items-center justify-center flex-1 gap-2 py-3 font-semibold text-white transition rounded-xl cursor-pointer bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                    <i class="fas fa-bolt"></i>
                    <span class="text-sm">Buy Now</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Chat Button (Mobile) -->
    <button onclick="openChat()" class="fixed z-30 flex items-center justify-center w-14 h-14 text-2xl text-white transition shadow-2xl rounded-full lg:hidden bottom-24 right-4 bg-linear-to-br from-[#8a2be2] to-[#ff1493] hover:scale-110 active:scale-95">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Similar Items -->
    <div class="px-4 mx-auto mt-8 mb-8 lg:px-6 lg:mt-16 lg:mb-16 max-w-7xl">
        <h2 class="mb-4 text-xl font-bold lg:mb-6 lg:text-2xl">Similar Items You May Like</h2>

        <div class="grid grid-cols-2 gap-3 lg:gap-6 md:grid-cols-4">
            @forelse($relatedProducts as $related)
            <a href="{{ route('product.show', $related->slug) }}" class="overflow-hidden transition border cursor-pointer rounded-xl bg-[#2d1b4e]/90 border-[#8a2be2]/20 hover:border-[#8a2be2] hover:-translate-y-1">
                @php
                    $relatedImages = is_array($related->images) ? $related->images : [];
                @endphp
                <div class="relative h-48 {{ empty($relatedImages) ? 'bg-linear-to-br from-purple-900 to-purple-700' : 'bg-black' }}">
                    @if(!empty($relatedImages))
                        <img src="{{ asset('storage/' . $relatedImages[0]) }}"
                             alt="{{ $related->name_product }}"
                             class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full text-6xl">🎮</div>
                    @endif

                    @if($related->averageRating() >= 4.5)
                        <div class="absolute px-2 py-1 text-xs font-bold rounded top-2 right-2 bg-linear-to-r from-[#8a2be2] to-[#ff1493]">
                            TOP
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs text-[#8a2be2] font-semibold">{{ $related->category->name }}</div>
                    <h3 class="mb-2 text-sm font-medium leading-tight line-clamp-2">
                        {{ $related->name_product }}
                    </h3>
                    <div class="mb-2 text-lg font-bold text-yellow-400">Rp {{ number_format($related->getCurrentPrice(), 0, ',', '.') }}</div>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="text-yellow-400 fas fa-star"></i>
                            {{ number_format($related->averageRating(), 1) }}
                        </span>
                        <span>{{ $related->seller->user->username }}</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-4 p-8 text-center text-gray-400">No similar products found</div>
            @endforelse
        </div>
    </div>



    <!-- JavaScript -->
    <script>
    let quantity = 1;
    let isLiked = false;
    let showingAllReviews = false;

    // Mobile Section Toggle
    function toggleMobileSection(header) {
        if (window.innerWidth >= 1024) return; // Only work on mobile

        const icon = header.querySelector('.fa-chevron-down');
        const content = header.nextElementSibling;

        if (icon && content) {
            icon.classList.toggle('rotate-180');
            content.classList.toggle('hidden');
        }
    }

    // Open Chat
    function openChat() {
        alert('Opening chat with seller...');
        // Implement chat functionality here
    }

    // ✨ Hide loading screen when page loaded
    window.addEventListener('load', function() {
        const loader = document.getElementById('pageLoader');
        setTimeout(function() {
            loader.classList.add('hidden');
        }, 200);
    });

    // ✨ Back with loading animation
    function goBack() {
        window.history.back();
    }

        // Quantity Functions
        function increaseQuantity() {
            const maxStock = {{ $product->stock }};
            if (quantity < maxStock) {
                quantity++;
                updateQuantityDisplay();
            } else {
                alert('Maximum stock is ' + maxStock + ' items');
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
</x-layout>
