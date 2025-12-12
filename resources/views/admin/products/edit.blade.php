<x-layout>
<div class="min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.products.index') }}" class="text-purple-400 hover:text-purple-300 transition-colors mb-4 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Products
            </a>
            <h1 class="text-3xl font-bold text-white mb-2">Moderate Product</h1>
            <p class="text-gray-400">Update product status for moderation</p>
        </div>

        <!-- Product Info Card -->
        <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-xl p-6 mb-6">
            <div class="flex gap-6">
                <!-- Product Image -->
                <div class="shrink-0">
                    @php
                        $images = is_array($product->images) ? $product->images : [];
                    @endphp
                    @if(!empty($images))
                        <img src="{{ asset('storage/' . $images[0]) }}"
                             alt="{{ $product->name_product }}"
                             class="w-32 h-32 object-cover rounded-lg">
                    @else
                        <div class="w-32 h-32 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <span class="text-5xl">🎮</span>
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $product->name_product }}</h2>

                    <div class="space-y-2 text-gray-300">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Category:</span>
                            <span class="font-medium">{{ $product->category->name_category }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Type:</span>
                            @if($product->type_product === 'account')
                                <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm font-medium">Account</span>
                            @elseif($product->type_product === 'topup')
                                <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 rounded-full text-sm font-medium">Top Up</span>
                            @else
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-full text-sm font-medium">In-Game Item</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Seller:</span>
                            <span class="font-medium">{{ $product->seller->user->name ?? 'Unknown' }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Price:</span>
                            <span class="font-medium">
                                @if($product->discount_price)
                                    <span class="line-through text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-green-400 ml-2">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                @else
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                @endif
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Stock:</span>
                            <span class="font-medium">{{ $product->stock }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-gray-400">Current Status:</span>
                            @if($product->status === 'available')
                                <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm font-medium">Available</span>
                            @elseif($product->status === 'sold')
                                <span class="px-3 py-1 bg-gray-500/20 text-gray-400 rounded-full text-sm font-medium">Sold</span>
                            @elseif($product->status === 'removed')
                                <span class="px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-sm font-medium">Removed</span>
                            @else
                                <span class="px-3 py-1 bg-orange-500/20 text-orange-400 rounded-full text-sm font-medium">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description -->
            @if($product->description)
                <div class="mt-6 pt-6 border-t border-white/10">
                    <h3 class="text-lg font-semibold text-white mb-2">Description</h3>
                    <p class="text-gray-300">{{ $product->description }}</p>
                </div>
            @endif
        </div>

        <!-- Status Update Form -->
        <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Update Status</h3>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="status" class="block text-gray-300 font-medium mb-2">Product Status</label>
                    <select name="status" id="status"
                            class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="available" {{ $product->status === 'available' ? 'selected' : '' }} class="bg-gray-800 text-white">Available - Product is active and can be purchased</option>
                        <option value="sold" {{ $product->status === 'sold' ? 'selected' : '' }} class="bg-gray-800 text-white">Sold - Product has been sold</option>
                        <option value="out_of_stock" {{ $product->status === 'out_of_stock' ? 'selected' : '' }} class="bg-gray-800 text-white">Out of Stock - Temporarily unavailable</option>
                        <option value="removed" {{ $product->status === 'removed' ? 'selected' : '' }} class="bg-gray-800 text-white">Removed - Violates policy or seller request</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-400 text-sm mt-2">
                        <strong>Note:</strong> As an admin, you can only moderate product status. Sellers manage product details through their dashboard.
                    </p>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-purple-500/50">
                        Update Status
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="flex-1 bg-white/5 hover:bg-white/10 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 text-center border border-white/10">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-layout>
