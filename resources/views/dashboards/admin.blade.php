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
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-4 border border-white/20">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-red-500/20">
                            <i class="text-lg text-red-400 fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\Report::where('status', 'pending')->count() }}</p>
                            <p class="text-xs text-gray-400">Reports</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 mb-8">
                <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center justify-center p-4 bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90 rounded-lg transition">
                        <span class="text-2xl mb-2">🎮</span>
                        <span class="text-sm">Categories</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                        <span class="text-2xl mb-2">👥</span>
                        <span class="text-sm">Manage Users</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                        <span class="text-2xl mb-2">✅</span>
                        <span class="text-sm">Verify Sellers</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-green-600 hover:bg-green-700 rounded-lg transition">
                        <span class="text-2xl mb-2">📦</span>
                        <span class="text-sm">Manage Products</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-yellow-600 hover:bg-yellow-700 rounded-lg transition">
                        <span class="text-2xl mb-2">⚠️</span>
                        <span class="text-sm">Handle Reports</span>
                    </a>
                    <a href="#" class="flex flex-col items-center justify-center p-4 bg-red-600 hover:bg-red-700 rounded-lg transition">
                        <span class="text-2xl mb-2">📊</span>
                        <span class="text-sm">View Analytics</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pending Seller Verification -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
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
                                        <button class="flex-1 px-3 py-2 bg-green-600 hover:bg-green-700 rounded text-sm transition">
                                            Approve
                                        </button>
                                        <button class="flex-1 px-3 py-2 bg-red-600 hover:bg-red-700 rounded text-sm transition">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No pending verifications</p>
                    @endif
                </div>

                <!-- Recent Reports -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20">
                    <h2 class="text-xl font-bold mb-4">Recent Reports</h2>
                    @php
                        $recentReports = \App\Models\Report::latest()->take(5)->get();
                    @endphp
                    @if($recentReports->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentReports as $report)
                                <div class="p-4 bg-white/5 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <p class="font-semibold">Order #{{ $report->order_id }}</p>
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $report->status === 'resolved' ? 'bg-green-600' : 'bg-yellow-600' }}">
                                            {{ strtoupper($report->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400 mb-2">{{ Str::limit($report->description, 60) }}</p>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-gray-500">Reporter: {{ $report->reporter->username }}</p>
                                        <p class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if($report->status === 'pending')
                                        <button class="w-full mt-3 px-3 py-2 bg-blue-600 hover:bg-blue-700 rounded text-sm transition">
                                            Review Report
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-center py-8">No reports yet</p>
                    @endif
                </div>
            </div>

            <!-- Recent Orders Overview -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 mt-6">
                <h2 class="text-xl font-bold mb-4">Recent Orders</h2>
                @php
                    $recentOrders = \App\Models\Order::latest()->take(10)->get();
                @endphp
                @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-2">Order ID</th>
                                    <th class="text-left py-3 px-2">Product</th>
                                    <th class="text-left py-3 px-2">Buyer</th>
                                    <th class="text-left py-3 px-2">Seller</th>
                                    <th class="text-left py-3 px-2">Price</th>
                                    <th class="text-left py-3 px-2">Status</th>
                                    <th class="text-left py-3 px-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr class="border-b border-white/5 hover:bg-white/5">
                                        <td class="py-3 px-2">#{{ $order->id }}</td>
                                        <td class="py-3 px-2">{{ Str::limit($order->product->name_product, 25) }}</td>
                                        <td class="py-3 px-2">{{ $order->buyer->username }}</td>
                                        <td class="py-3 px-2">{{ $order->seller->username }}</td>
                                        <td class="py-3 px-2">Rp {{ number_format($order->final_price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-2">
                                            <span class="px-2 py-1 text-xs rounded-full
                                                {{ $order->order_status === 'completed' ? 'bg-green-600' : ($order->order_status === 'pending' ? 'bg-yellow-600' : 'bg-blue-600') }}">
                                                {{ strtoupper($order->order_status) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-2">{{ $order->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-400 text-center py-8">No orders yet</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
