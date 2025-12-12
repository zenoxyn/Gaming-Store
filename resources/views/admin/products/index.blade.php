<x-layout>
    <div class="min-h-screen py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Manage Products</h1>
                    <p class="text-gray-300 mt-1">Moderate and manage all products</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition border border-white/20">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Products Table -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/20 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Image</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Product</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Category</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Price</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Stock</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($products as $product)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                @php
                                    $images = is_array($product->images) ? $product->images : [];
                                @endphp
                                @if(!empty($images))
                                    <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $product->name_product }}" class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-purple-900/50 flex items-center justify-center text-2xl">
                                        🎮
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">{{ $product->name_product }}</div>
                                <div class="text-sm text-gray-400">by {{ $product->seller->user->username }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-300">{{ $product->category->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $product->type_product === 'account' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                    {{ $product->type_product === 'topup' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                    {{ $product->type_product === 'ingame_item' ? 'bg-purple-500/20 text-purple-400' : '' }}
                                ">
                                    {{ ucfirst($product->type_product) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-white font-medium">Rp {{ number_format($product->price) }}</div>
                                @if($product->discount_price)
                                    <div class="text-xs text-green-400">Disc: Rp {{ number_format($product->discount_price) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-300">{{ $product->stock }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $product->status === 'available' ? 'bg-green-500/20 text-green-400' : '' }}
                                    {{ $product->status === 'sold' ? 'bg-gray-500/20 text-gray-400' : '' }}
                                    {{ $product->status === 'removed' ? 'bg-red-500/20 text-red-400' : '' }}
                                    {{ $product->status === 'out_of_stock' ? 'bg-orange-500/20 text-orange-400' : '' }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $product->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded transition text-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded transition text-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                No products found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-layout>
