<x-layout>

    <!-- Hero Section -->
    <section class="px-5 mx-auto mt-8 max-w-7xl">

        <div class="from-primary/30 to-secondary/30 rounded-3xl p-16 relative overflow-hidden min-h-[300px] flex items-center">
            <img src="https://cdn-game-photos.zeusx.com/4a28aae3-9f69-46e8-bccc-4215613ade0e.png" alt="" class="absolute top-0 left-0 object-cover w-full h-full opacity-80">
            <div class="z-10 max-w-xl">
                <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm transition rounded-full cursor-pointer bg-white/20 hover:bg-white/30" aria-label="Back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back</span>
                </button>
                <h1 id="heroTitle" class="mb-4 text-6xl font-bold text-transparent translate-y-4 opacity-0 bg-linear-to-r from-white to-yellow-300 bg-clip-text">
                    {{ $category->name ?? $viewTitle ?? 'All Products' }}
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                    Find the best {{ strtolower($category->name ?? $viewTitle ?? 'products') }} here!
                </p>

                <div class="flex gap-4">
                    <a href="{{ route('products.account') }}" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none {{ request()->is('account') ? 'ring-2 ring-[#8a2be2] bg-[#8a2be2]/60' : '' }}" aria-pressed="false">
                        <i class="fas fa-user"></i>
                        <span>Accounts</span>
                        <span class="badge-new bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">NEW</span>
                    </a>
                    <a href="{{ route('products.ingame') }}" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition transform cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none {{ request()->is('in-game-items') ? 'ring-2 ring-[#8a2be2] bg-[#8a2be2]/60' : '' }}" aria-pressed="false">
                        <i class="fas fa-gamepad"></i>
                        <span>in-Game Items</span>
                        <span class="badge-hot bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">HOT</span>
                    </a>
                    <a href="{{ route('products.topup') }}" class="flex items-center gap-2 px-5 py-3 text-gray-100 transition transform cursor-pointer hero-control bg-white/10 rounded-xl hover:scale-105 focus:outline-none {{ request()->is('top-up') ? 'ring-2 ring-[#8a2be2] bg-[#8a2be2]/60' : '' }}" aria-pressed="false">
                        <i class="fas fa-tag"></i>
                        <span>Top-ups</span>
                        <span class="badge-new bg-linear-to-r from-secondary to-primary px-2 py-0.5 rounded-full text-xs font-bold">NEW</span>
                    </a>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-1/2 h-full bg-linear-to-l from-yellow-500/10 to-transparent"></div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="px-5 mx-auto mt-8 max-w-7xl">
        <div class="p-6 border-2 bg-[#2d1b4e]/90 border-[#8a2be2]/30 rounded-2xl">
            <h2 class="mb-4 text-xl font-semibold">Search Items</h2>
            <form action="{{ route('products.search') }}" method="GET" class="flex gap-4">
                <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Item search..."
                    class="flex-1 px-5 py-4 text-white border-2 rounded-xl border-[#8a2be2]/30 bg-[#1a0b2e]/80 focus:outline-none focus:border-[#8a2be2]">
                <button type="submit" class="bg-linear-to-r from-[#8a2be2] to-[#ff1493] px-10 py-4 rounded-xl font-bold hover:-translate-y-0.5 transition-transform">
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- Filters -->
    <section class="flex items-center justify-between px-5 mx-auto mt-6 max-w-7xl">
        <div class="flex items-center gap-4">
            <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border-2 border-[#8a2be2]/30 bg-[#2d1b4e]/60 cursor-pointer hover:border-[#ff1493]/60 transition-all group">
                <div class="relative">
                    <input id="chkOnline" type="checkbox" class="sr-only peer">
                    <div class="w-5 h-5 border-2 rounded border-[#8a2be2]/50 bg-[#1a0b2e]/80 peer-checked:bg-linear-to-br peer-checked:from-[#ff1493] peer-checked:to-[#ff1493] peer-checked:border-[#ff1493] transition-all"></div>
                    <i class="fas fa-check absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                </div>
                <span class="text-sm font-medium group-hover:text-[#ff1493] transition-colors">
                    <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                    Online sellers only
                </span>
            </label>
            <label class="flex items-center gap-3 px-4 py-2.5 rounded-xl border-2 border-[#8a2be2]/30 bg-[#2d1b4e]/60 cursor-pointer hover:border-[#8a2be2] transition-all group">
                <div class="relative">
                    <input id="chkPremium" type="checkbox" class="sr-only peer">
                    <div class="w-5 h-5 border-2 rounded border-[#8a2be2]/50 bg-[#1a0b2e]/80 peer-checked:bg-linear-to-br peer-checked:from-[#8a2be2] peer-checked:to-[#ff1493] peer-checked:border-[#8a2be2] transition-all"></div>
                    <i class="fas fa-check absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none"></i>
                </div>
                <span class="text-sm font-medium group-hover:text-[#8a2be2] transition-colors">
                    <i class="fas fa-crown text-yellow-400 text-xs mr-1"></i>
                    Premium sellers only
                </span>
            </label>
        </div>
        <div class="flex gap-4">
            <select id="sortPrice" class="px-4 py-2 font-medium text-white transition-colors border-2 rounded-lg cursor-pointer bg-[#8a2be2]/40 border-[#8a2be2]/50 hover:bg-[#8a2be2]/60">
                <option value="default">Price</option>
                <option value="low">Price: Low to High</option>
                <option value="high">Price: High to Low</option>
            </select>
            <select id="sortOrder" class="px-4 py-2 font-medium text-white transition-colors border-2 rounded-lg cursor-pointer bg-[#8a2be2]/40 border-[#8a2be2]/50 hover:bg-[#8a2be2]/60">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="popular">Most Popular</option>
            </select>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="grid grid-cols-5 gap-5 px-5 mx-auto mt-8 max-w-7xl" id="productsGrid">
        @forelse($products as $product)
            <a href="{{ route('product.show', $product->slug) }}" class="bg-[#2d1b4e]/90 rounded-2xl overflow-hidden border-2 border-[#8a2be2]/20 hover:-translate-y-1 hover:border-[#8a2be2] transition-all cursor-pointer"
               data-price="{{ $product->getCurrentPrice() }}"
               data-created="{{ $product->created_at->timestamp }}"
               data-popularity="{{ $product->averageRating() * 100 }}">
                @php
                    $productImages = is_array($product->images) ? $product->images : [];
                @endphp
                <div class="relative flex items-center justify-center text-5xl h-44 {{ empty($productImages) ? 'bg-linear-to-br from-[#2d1b4e] to-purple-900' : 'bg-black' }}">
                    @if(!empty($productImages))
                        <img src="{{ asset('storage/' . $productImages[0]) }}" alt="{{ $product->name_product }}" class="object-cover w-full h-full">
                    @else
                        <span>🎮</span>
                    @endif

                    @if($product->averageRating() >= 4.5)
                    <div class="absolute flex items-center gap-1 px-3 py-1 text-xs rounded-full top-2 right-2 bg-black/70">
                        <i class="text-yellow-400 fas fa-star"></i>
                        Top-rate
                    </div>
                    @endif

                    @if($product->discount_price && $product->discount_price < $product->price)
                    <div class="absolute flex items-center justify-center rounded-lg bottom-2 right-2 bg-[#8a2be2]/90 px-2 py-1 text-xs font-bold">
                        -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="mb-2 text-xs font-semibold text-[#8a2be2]">{{ $product->category->name }}</div>
                    <div class="h-10 mb-3 overflow-hidden text-sm leading-tight">{{ Str::limit($product->name_product, 50) }}</div>
                    <div class="mb-3 text-xl font-bold text-yellow-400">
                        Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <span class="block text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 pt-3 border-t border-[#8a2be2]/20">
                        <div class="flex items-center justify-center w-6 h-6 text-xs rounded-full bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex items-center flex-1 gap-1 text-xs">
                            <span class="text-gray-300">{{ $product->seller->user->username }}</span>
                            <span class="text-xs text-yellow-400">
                                <i class="fas fa-star"></i> {{ number_format($product->seller->rating, 1) }}
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-5 p-8 text-center text-gray-400">No products found.</div>
        @endforelse
    </section>

    <!-- Pagination -->
    <div class="flex justify-center gap-3 px-5 mx-auto mt-10 max-w-7xl">
        {{ $products->links() }}
    </div>

    <!-- Section Title -->
    <h2 class="px-5 mx-auto mt-16 mb-5 text-3xl font-bold max-w-7xl">
        {{ $category->name ?? 'All Products' }} for Sale
    </h2>

    <!-- Game Categories -->
    <section class="px-5 mx-auto mt-12 max-w-7xl">
        <h2 class="mb-5 text-2xl font-bold">Browse by Game</h2>
        <div class="grid grid-cols-5 gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('products.category', $cat->slug) }}" class="relative block overflow-hidden rounded-xl group aspect-square transition-all border-2 {{ isset($category) && $category->id == $cat->id ? 'border-[#8a2be2]' : 'border-[#8a2be2]/20' }} hover:border-[#8a2be2]">
                    @if($cat->icon)
                        <img src="{{ asset('storage/' . $cat->icon) }}" alt="{{ $cat->name }}" class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                    @else
                        <div class="w-full h-full bg-linear-to-br from-[#2d1b4e] to-purple-900 flex items-center justify-center text-6xl">
                            🎮
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p class="text-base font-semibold text-white">{{ $cat->name }}</p>
                        <span class="block mt-1 text-xs text-gray-300">{{ $cat->products_count }} items</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <script>
        // Animate hero title in
        const heroTitle = document.getElementById('heroTitle');
        setTimeout(() => {
            heroTitle.classList.remove('opacity-0', 'translate-y-4');
            heroTitle.classList.add('transition', 'duration-700', 'ease-out');
        }, 300);
    </script>
</x-layout>
