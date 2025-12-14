<x-layout>
    <div class="min-h-screen py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Buyer Dashboard</h1>
                    <p class="text-gray-300 mt-1">Welcome, {{ auth()->user()->username }}!</p>
                </div>
                <div class="flex gap-3">
                    @if(!auth()->user()->seller)
                        <a href="{{ route('seller.apply') }}" class="px-4 py-2 bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90 rounded-lg transition flex items-center gap-2">
                            <span>💼</span>
                            <span>Become a Seller</span>
                        </a>
                    @elseif(auth()->user()->seller->verification_status === 'pending')
                        <span class="px-4 py-2 bg-yellow-600/20 border border-yellow-600 rounded-lg text-yellow-400 flex items-center gap-2">
                            <span>⏳</span>
                            <span>Verification Pending</span>
                        </span>
                    @elseif(auth()->user()->seller->verification_status === 'verified')
                        <a href="{{ route('seller.dashboard') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition flex items-center gap-2">
                            <span>✅</span>
                            <span>Go to Seller Dashboard</span>
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Wallet Balance</h3>
                    <p class="text-3xl font-bold text-green-400">Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Total Purchases</h3>
                    <p class="text-3xl font-bold text-blue-400">{{ auth()->user()->buyerOrders()->count() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Completed Transactions</h3>
                    <p class="text-3xl font-bold text-purple-400">{{ auth()->user()->buyerOrders()->where('order_status', 'completed')->count() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h3 class="text-sm text-gray-300 mb-2">Negotiations</h3>
                    <p class="text-3xl font-bold text-yellow-400">{{ auth()->user()->buyerNegotiations()->where('status', 'ongoing')->count() }}</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="ri-flashlight-line"></i>
                    Quick Actions
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="/" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-purple-500/20 border border-purple-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-gamepad-line text-3xl text-purple-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-purple-400 transition">Browse Products</h3>
                                <p class="text-sm text-gray-400 mt-1">Find gaming items</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('wallet.index') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-green-500/20 border border-green-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-wallet-3-line text-3xl text-green-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-green-400 transition">My Wallet</h3>
                                <p class="text-sm text-gray-400 mt-1">Top up & manage balance</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('negotiation.index') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-yellow-500/20 border border-yellow-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-chat-3-line text-3xl text-yellow-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-yellow-400 transition">Negotiations</h3>
                                <p class="text-sm text-gray-400 mt-1">Manage price offers</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('order.index') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-blue-500/20 border border-blue-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-shopping-bag-3-line text-3xl text-blue-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition">My Orders</h3>
                                <p class="text-sm text-gray-400 mt-1">Track purchases</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
                    @if(auth()->user()->buyerOrders()->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->buyerOrders()->latest()->take(5)->get() as $order)
                                <div class="flex justify-between items-center p-4 bg-white/5 rounded-lg">
                                    <div>
                                        <p class="font-semibold">{{ $order->product->name_product }}</p>
                                        <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-green-400">Rp {{ number_format($order->final_price, 0, ',', '.') }}</p>
                                        <span class="px-3 py-1 text-xs rounded-full {{
                                            $order->order_status === 'completed' ? 'bg-green-600' :
                                            ($order->order_status === 'pending' ? 'bg-yellow-600' : 'bg-blue-600')
                                        }}">
                                            {{ strtoupper($order->order_status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No orders yet</p>
                    @endif
                </div>

                <!-- My Reviews -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h2 class="text-xl font-bold mb-4">My Reviews</h2>
                    @if(auth()->user()->buyerReviews()->count() > 0)
                        <div class="space-y-3">
                            @foreach(auth()->user()->buyerReviews()->latest()->take(5)->get() as $review)
                                <div class="p-4 bg-white/5 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="font-semibold">{{ $review->product->name_product }}</p>
                                        <span class="text-yellow-400">
                                            {{ str_repeat('⭐', $review->rating) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400">{{ Str::limit($review->review_text, 50) }}</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No reviews yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
