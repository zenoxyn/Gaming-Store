<x-layout>
    <div class="min-h-screen py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Seller Dashboard</h1>
                    <p class="text-gray-300 mt-1">Welcome, {{ auth()->user()->username }}!</p>
                    @if(auth()->user()->seller)
                        @php
                            $statusClass = match(auth()->user()->seller->verification_status) {
                                'verified' => 'bg-green-600',
                                'pending' => 'bg-yellow-600',
                                default => 'bg-red-600'
                            };
                        @endphp
                        <span class="inline-block px-3 py-1 text-xs rounded-full mt-2 {{ $statusClass }}">
                            {{ strtoupper(auth()->user()->seller->verification_status) }}
                        </span>
                    @endif
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('buyer.dashboard') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition flex items-center gap-2">
                        <span>🛒</span>
                        <span>Buyer Dashboard</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Wallet Balance</h3>
                    <p class="text-3xl font-bold text-green-400">Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Total Products</h3>
                    <p class="text-3xl font-bold text-blue-400">{{ auth()->user()->products()->count() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Total Sales</h3>
                    <p class="text-3xl font-bold text-purple-400">{{ auth()->user()->sellerOrders()->count() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Rating</h3>
                    <p class="text-3xl font-bold text-yellow-400">
                        {{ number_format(auth()->user()->seller->rating ?? 0, 1) }} ⭐
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 mb-8">
                <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('seller.products.create') }}" class="flex flex-col items-center justify-center p-4 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                        <span class="text-2xl mb-2">➕</span>
                        <span class="text-sm">Add Product</span>
                    </a>
                    <a href="{{ route('seller.products.index') }}" class="flex flex-col items-center justify-center p-4 bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                        <span class="text-2xl mb-2">📦</span>
                        <span class="text-sm">My Products</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-green-600 hover:bg-green-700 rounded-lg transition">
                        <span class="text-2xl mb-2">📊</span>
                        <span class="text-sm">Sales Report</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-yellow-600 hover:bg-yellow-700 rounded-lg transition">
                        <span class="text-2xl mb-2">💬</span>
                        <span class="text-sm">Negotiations</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h2 class="text-xl font-bold mb-4">Incoming Orders</h2>
                    @if(auth()->user()->sellerOrders()->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->sellerOrders()->latest()->take(5)->get() as $order)
                                <div class="p-4 bg-white/5 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="font-semibold">{{ $order->product->name_product }}</p>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $order->order_status === 'completed' ? 'bg-green-600' : ($order->order_status === 'pending' ? 'bg-yellow-600' : 'bg-blue-600') }}">
                                            {{ strtoupper($order->order_status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400">Buyer: {{ $order->buyer->username }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}</p>
                                        <p class="font-bold text-green-400">Rp {{ number_format($order->final_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No orders yet</p>
                    @endif
                </div>

                <!-- My Products -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h2 class="text-xl font-bold mb-4">My Products</h2>
                    @if(auth()->user()->products()->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->products()->latest()->take(5)->get() as $product)
                                <div class="p-4 bg-white/5 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="font-semibold">{{ $product->name_product }}</p>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $product->stock > 0 ? 'bg-green-600' : 'bg-red-600' }}">
                                            {{ $product->stock > 0 ? 'READY' : 'SOLD' }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400">{{ $product->category->name }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <p class="text-sm text-gray-400">Stock: {{ $product->stock }}</p>
                                        <p class="font-bold text-green-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No products yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
