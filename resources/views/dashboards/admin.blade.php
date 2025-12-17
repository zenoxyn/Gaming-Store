<x-layout>
    <div class="min-h-screen py-8 px-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
                    <p class="text-gray-300 mt-1">Welcome, {{ auth()->user()->username }}!</p>
                    <span class="inline-block px-3 py-1 text-xs rounded-full mt-2 bg-red-600">
                        ADMINISTRATOR
                    </span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-500/20">
                            <i class="text-lg text-blue-400 fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\User::count() }}</p>
                            <p class="text-xs text-gray-400">Users</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-yellow-500/20">
                            <i class="text-lg text-yellow-400 fas fa-th-large"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\Category::count() }}</p>
                            <p class="text-xs text-gray-400">Categories</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-500/20">
                            <i class="text-lg text-purple-400 fas fa-box"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\Product::count() }}</p>
                            <p class="text-xs text-gray-400">Products</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-500/20">
                            <i class="text-lg text-green-400 fas fa-shopping-cart"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\Order::count() }}</p>
                            <p class="text-xs text-gray-400">Orders</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="ri-flashlight-line"></i>
                    Quick Actions
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-purple-500/20 border border-purple-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-gamepad-line text-3xl text-purple-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-purple-400 transition">Categories</h3>
                                <p class="text-sm text-gray-400 mt-1">Manage categories</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.sellers.verification') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-green-500/20 border border-green-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-check-line text-3xl text-green-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-green-400 transition">Verify Sellers</h3>
                                <p class="text-sm text-gray-400 mt-1">Approve or reject seller accounts</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.products.index') }}" class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-yellow-500/20 border border-yellow-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-box-3-line text-3xl text-yellow-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-yellow-400 transition">Manage Products</h3>
                                <p class="text-sm text-gray-400 mt-1">Manage product listings</p>
                            </div>
                        </div>
                    </a>

                    <a href="# " class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-blue-500/20 border border-blue-500/50 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="ri-user-line text-3xl text-blue-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition">Manage Users</h3>
                                <p class="text-sm text-gray-400 mt-1">View and manage user accounts</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Pending Seller Verification -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 mt-6">
                <h2 class="text-xl font-bold mb-4">Pending Seller Verification</h2>
                @php
                    $pendingSellers = \App\Models\Seller::where('verification_status', 'pending')->latest()->take(5)->get();
                @endphp
                @if($pendingSellers->count() > 0)
                    <div class="space-y-3">
                        @foreach($pendingSellers as $seller)
                            <div class="p-4 bg-white/5 rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-semibold">{{ $seller->user->username }}</p>
                                        <p class="text-sm text-gray-400">{{ $seller->user->email }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-600">
                                        PENDING
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 mt-2">Phone: {{ $seller->user->phone }}</p>
                                <p class="text-sm text-gray-400">Registered: {{ $seller->created_at->format('d M Y') }}</p>
                                <div class="flex gap-2 mt-3">
                                    <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Approve this seller?')" class="w-full px-3 py-2 bg-green-600 hover:bg-green-700 rounded text-sm transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Reject this seller?')" class="w-full px-3 py-2 bg-red-600 hover:bg-red-700 rounded text-sm transition">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-center py-8">No pending verifications</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
