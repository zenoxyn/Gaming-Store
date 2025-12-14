<x-layout>
    <div class="min-h-screen px-4 py-8 mx-auto max-w-7xl lg:px-6">

        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold">
                    @if($tab === 'buyer')
                        My Purchases
                    @else
                        My Sales
                    @endif
                </h1>
                <p class="mt-2 text-gray-400">Track and manage your orders</p>
            </div>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 font-semibold text-white transition bg-white/10 rounded-xl hover:bg-white/20">
                <i class="ri-arrow-left-line"></i>
                Back to Dashboard
            </a>
        </div>

        <!-- Status Filters -->
        <div class="flex gap-2 mb-6 overflow-x-auto">
            <a href="{{ route('order.index', ['status' => 'all']) }}"
               class="px-4 py-2 text-sm font-medium transition rounded-lg whitespace-nowrap {{ $status === 'all' ? 'bg-[#8a2be2] text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10' }}">
                All Orders
            </a>
            <a href="{{ route('order.index', ['status' => 'pending']) }}"
               class="px-4 py-2 text-sm font-medium transition rounded-lg whitespace-nowrap {{ $status === 'pending' ? 'bg-yellow-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10' }}">
                Pending
            </a>
            <a href="{{ route('order.index', ['status' => 'processing']) }}"
               class="px-4 py-2 text-sm font-medium transition rounded-lg whitespace-nowrap {{ $status === 'processing' ? 'bg-blue-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10' }}">
                Processing
            </a>
            <a href="{{ route('order.index', ['status' => 'completed']) }}"
               class="px-4 py-2 text-sm font-medium transition rounded-lg whitespace-nowrap {{ $status === 'completed' ? 'bg-green-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10' }}">
                Completed
            </a>
            <a href="{{ route('order.index', ['status' => 'canceled']) }}"
               class="px-4 py-2 text-sm font-medium transition rounded-lg whitespace-nowrap {{ $status === 'canceled' ? 'bg-red-600 text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10' }}">
                Canceled
            </a>
        </div>

        <!-- Orders List -->
        <div class="space-y-4">
            @forelse($orders as $order)
                <a href="{{ route('order.show', $order->id) }}"
                   class="block p-4 transition border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30 hover:border-[#8a2be2] lg:p-6">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <!-- Product Info -->
                        <div class="flex gap-4">
                            @php
                                $productImages = is_array($order->product->images) ? $order->product->images : [];
                            @endphp
                            <div class="w-20 h-20 overflow-hidden rounded-lg lg:w-24 lg:h-24 shrink-0 {{ empty($productImages) ? 'bg-gradient-to-br from-purple-900 to-purple-700' : 'bg-black' }}">
                                @if(!empty($productImages))
                                    <img src="{{ asset('storage/' . $productImages[0]) }}"
                                         alt="{{ $order->product->name_product }}"
                                         class="object-cover w-full h-full">
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-3xl">🎮</div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h3 class="mb-1 text-base font-semibold lg:text-lg">{{ $order->product->name_product }}</h3>
                                <p class="mb-2 text-sm text-gray-400">
                                    Order #{{ $order->id }} • {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                                <p class="text-sm text-gray-400">
                                    {{ $tab === 'buyer' ? 'Seller' : 'Buyer' }}:
                                    <span class="font-semibold text-white">
                                        {{ $tab === 'buyer' ? $order->seller->username : $order->buyer->username }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="flex items-center justify-between gap-4 lg:flex-col lg:items-end">
                            <div class="text-right">
                                @if($order->original_price != $order->final_price)
                                    <div class="text-xs text-gray-500 line-through">Rp {{ number_format($order->original_price, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-400">Negotiated Price</div>
                                @else
                                    <div class="text-sm text-gray-400">Price</div>
                                @endif
                                <div class="text-xl font-bold text-yellow-400">Rp {{ number_format($order->final_price, 0, ',', '.') }}</div>

                                @if($tab === 'seller')
                                    @php $netAmount = $order->final_price - $order->platform_fee; @endphp
                                    <div class="text-xs text-gray-500 mt-1">Platform Fee: -Rp {{ number_format($order->platform_fee, 0, ',', '.') }}</div>
                                    <div class="text-sm font-semibold text-green-400 mt-1">You Receive: Rp {{ number_format($netAmount, 0, ',', '.') }}</div>
                                @endif

                                <div class="text-xs text-gray-400 mt-1">Qty: {{ $order->quantity }}</div>
                            </div>

                            <!-- Status Badge -->
                            <div>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-600/20 text-yellow-400 border-yellow-600/50',
                                        'processing' => 'bg-blue-600/20 text-blue-400 border-blue-600/50',
                                        'completed' => 'bg-green-600/20 text-green-400 border-green-600/50',
                                        'canceled' => 'bg-red-600/20 text-red-400 border-red-600/50',
                                    ];
                                    $statusColor = $statusColors[$order->order_status] ?? 'bg-gray-600/20 text-gray-400 border-gray-600/50';
                                @endphp
                                <span class="px-3 py-1.5 text-xs font-semibold border rounded-full {{ $statusColor }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="flex items-center gap-2 pt-3 mt-3 text-sm border-t border-white/10">
                        <i class="ri-wallet-line text-[#8a2be2]"></i>
                        <span class="text-gray-400">Payment:</span>
                        <span class="font-semibold {{ $order->payment_status === 'paid' ? 'text-green-400' : 'text-yellow-400' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                        <span class="text-gray-500">•</span>
                        <span class="text-gray-400">via {{ ucfirst($order->payment_method) }}</span>
                    </div>
                </a>
            @empty
                <div class="p-12 text-center border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <i class="mb-4 text-5xl ri-inbox-line text-[#8a2be2]"></i>
                    <h3 class="mb-2 text-xl font-semibold">No Orders Found</h3>
                    <p class="text-gray-400">
                        @if($tab === 'buyer')
                            You haven't made any purchases yet
                        @else
                            You haven't received any orders yet
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>
</x-layout>
