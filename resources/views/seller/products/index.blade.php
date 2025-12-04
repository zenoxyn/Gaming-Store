<x-layout title="My Products - Seller">
    <div class="min-h-screen py-8">
        <div class="container px-4 mx-auto">
            <!-- Back Button -->
            <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center mb-6 text-gray-400 transition hover:text-white">
                <i class="mr-2 fas fa-arrow-left"></i>Back to Dashboard
            </a>

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-white">My Products</h1>
                    <p class="text-gray-400">Manage your product listings</p>
                </div>
                <a href="{{ route('seller.products.create') }}" class="px-6 py-3 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                    <i class="mr-2 fas fa-plus"></i>Add Product
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="p-4 mb-6 text-green-400 border border-green-400 rounded-lg bg-green-400/10">
                <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
            </div>
            @endif

            <!-- Products Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($products as $product)
                <div class="overflow-hidden border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <!-- Product Image -->
                    <div class="relative h-48 bg-linear-to-br from-purple-900 to-purple-700">
                        @php
                            $productImages = is_array($product->images) ? $product->images : [];
                        @endphp
                        @if(!empty($productImages))
                            <img src="{{ asset('storage/' . $productImages[0]) }}"
                                 alt="{{ $product->name_product }}"
                                 class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-6xl">🎮</div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute px-3 py-1 text-xs font-bold rounded top-2 right-2
                            {{ $product->status === 'available' ? 'bg-green-600' : ($product->status === 'sold' ? 'bg-red-600' : 'bg-gray-600') }}">
                            {{ strtoupper($product->status) }}
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <div class="mb-2 text-xs text-[#8a2be2] font-semibold">{{ $product->category->name }}</div>
                        <h3 class="mb-2 text-lg font-semibold leading-tight text-white line-clamp-2">
                            {{ $product->name_product }}
                        </h3>

                        <div class="flex items-baseline gap-2 mb-3">
                            <div class="text-xl font-bold text-yellow-400">
                                Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}
                            </div>
                            @if($product->discount_price)
                                <div class="text-sm text-gray-400 line-through">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between mb-4 text-sm">
                            <span class="text-gray-400">Stock: <span class="font-semibold text-white">{{ $product->stock }}</span></span>
                            <span class="text-gray-400">Type: <span class="font-semibold text-white">{{ ucfirst($product->type_product) }}</span></span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('seller.products.edit', $product) }}"
                               class="flex-1 py-2 font-semibold text-center text-blue-400 transition border rounded-lg border-blue-400/30 hover:bg-blue-400/10">
                                <i class="mr-1 fas fa-edit"></i>Edit
                            </a>
                            <form action="{{ route('seller.products.destroy', $product) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this product? This cannot be undone!');"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 font-semibold text-red-400 transition border rounded-lg border-red-400/30 hover:bg-red-400/10">
                                    <i class="mr-1 fas fa-trash"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="flex flex-col items-center justify-center p-12 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                        <i class="mb-4 text-6xl fas fa-box-open text-[#8a2be2]/30"></i>
                        <h3 class="mb-2 text-lg font-semibold text-gray-300">No Products Yet</h3>
                        <p class="mb-4 text-gray-500">Start selling by creating your first product</p>
                        <a href="{{ route('seller.products.create') }}"
                           class="px-6 py-3 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                            <i class="mr-2 fas fa-plus"></i>Create Product
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-8">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layout>
