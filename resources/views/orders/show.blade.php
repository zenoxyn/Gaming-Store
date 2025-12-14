<x-layout>
    <div class="min-h-screen px-4 py-8 mx-auto max-w-7xl lg:px-6">

        <!-- Back Button -->
        <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 px-4 py-2 mb-6 text-sm transition border rounded-full bg-white/10 hover:bg-white/20 border-white/20">
            <i class="ri-arrow-left-line"></i>
            <span>Back to Orders</span>
        </a>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <!-- Main Content -->
            <div class="space-y-6 lg:col-span-2">

                <!-- Order Header -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
                            <p class="text-sm text-gray-400">Placed on {{ $order->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-600 text-white',
                                'processing' => 'bg-blue-600 text-white',
                                'completed' => 'bg-green-600 text-white',
                                'canceled' => 'bg-red-600 text-white',
                            ];
                            $statusColor = $statusColors[$order->order_status] ?? 'bg-gray-600 text-white';
                        @endphp
                        <span class="px-4 py-2 text-sm font-bold rounded-full {{ $statusColor }}">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>

                    <!-- Order Progress Tracker -->
                    <div class="relative pt-6">
                        <div class="flex items-center justify-between">
                            @php
                                $steps = [
                                    ['key' => 'pending', 'label' => 'Order Placed', 'icon' => 'ri-shopping-cart-line'],
                                    ['key' => 'processing', 'label' => 'Processing', 'icon' => 'ri-loader-line'],
                                    ['key' => 'completed', 'label' => 'Completed', 'icon' => 'ri-check-line'],
                                ];
                                $currentStep = array_search($order->order_status, array_column($steps, 'key'));
                                if ($currentStep === false) $currentStep = -1;
                            @endphp

                            @foreach($steps as $index => $step)
                                <div class="relative z-10 flex flex-col items-center flex-1">
                                    <div class="flex items-center justify-center w-12 h-12 mb-2 border-4 rounded-full
                                        {{ $index <= $currentStep ? 'bg-[#8a2be2] border-[#8a2be2]' : 'bg-[#2d1b4e] border-gray-600' }}">
                                        <i class="{{ $step['icon'] }} text-xl {{ $index <= $currentStep ? 'text-white' : 'text-gray-600' }}"></i>
                                    </div>
                                    <span class="text-xs font-semibold text-center {{ $index <= $currentStep ? 'text-white' : 'text-gray-500' }}">
                                        {{ $step['label'] }}
                                    </span>
                                </div>

                                @if($index < count($steps) - 1)
                                    <div class="relative flex-1 h-1 mx-2 -mt-8 rounded {{ $index < $currentStep ? 'bg-[#8a2be2]' : 'bg-gray-600' }}"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h2 class="mb-4 text-xl font-bold">Product Details</h2>

                    <div class="flex gap-4">
                        @php
                            $productImages = is_array($order->product->images) ? $order->product->images : [];
                        @endphp
                        <div class="w-24 h-24 overflow-hidden rounded-lg shrink-0 {{ empty($productImages) ? 'bg-gradient-to-br from-purple-900 to-purple-700' : 'bg-black' }}">
                            @if(!empty($productImages))
                                <img src="{{ asset('storage/' . $productImages[0]) }}"
                                     alt="{{ $order->product->name_product }}"
                                     class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-3xl">🎮</div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h3 class="mb-1 text-lg font-semibold">{{ $order->product->name_product }}</h3>
                            <p class="mb-2 text-sm text-gray-400">{{ $order->product->category->name }}</p>
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-gray-400">Quantity: <span class="font-semibold text-white">{{ $order->quantity }}</span></span>
                                <span class="text-gray-400">Price: <span class="font-semibold text-yellow-400">Rp {{ number_format($order->original_price, 0, ',', '.') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                @if($order->delivery_info)
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h2 class="mb-4 text-xl font-bold">
                        <i class="mr-2 ri-truck-line text-[#8a2be2]"></i>
                        Delivery Information
                    </h2>
                    <div class="p-4 rounded-lg bg-white/5">
                        <p class="text-sm text-gray-300 whitespace-pre-wrap">{{ $order->delivery_info }}</p>
                    </div>
                </div>
                @endif

                <!-- Notes -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @if($order->buyer_notes)
                    <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                        <h3 class="mb-2 font-semibold">
                            <i class="mr-2 ri-chat-3-line text-blue-400"></i>
                            Buyer Notes
                        </h3>
                        <p class="text-sm text-gray-300">{{ $order->buyer_notes }}</p>
                    </div>
                    @endif

                    @if($order->seller_notes)
                    <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                        <h3 class="mb-2 font-semibold">
                            <i class="mr-2 ri-store-line text-green-400"></i>
                            Seller Notes
                        </h3>
                        <p class="text-sm text-gray-300">{{ $order->seller_notes }}</p>
                    </div>
                    @endif
                </div>

            </div>

            <!-- Sidebar -->
            <div class="space-y-6 lg:col-span-1">

                <!-- Payment Summary -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h2 class="mb-4 text-xl font-bold">Payment Summary</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Original Price</span>
                            <span class="font-semibold">Rp {{ number_format($order->original_price * $order->quantity, 0, ',', '.') }}</span>
                        </div>

                        @if($order->original_price != $order->final_price)
                            <div class="flex justify-between text-sm">
                                <span class="text-green-400">Negotiation Discount</span>
                                <span class="font-semibold text-green-400">-Rp {{ number_format(($order->original_price - $order->final_price) * $order->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="pt-3 border-t border-white/10">
                            <div class="flex justify-between">
                                <span class="font-semibold">Total Paid</span>
                                <span class="text-2xl font-bold text-yellow-400">Rp {{ number_format($order->final_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if(auth()->id() == $order->id_seller)
                            @php $netAmount = $order->final_price - $order->platform_fee; @endphp
                            <div class="pt-3 border-t border-white/10">
                                <div class="flex justify-between text-sm text-red-400">
                                    <span>Platform Fee (3%)</span>
                                    <span>-Rp {{ number_format($order->platform_fee, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <span class="font-semibold text-green-400">You Receive</span>
                                    <span class="text-xl font-bold text-green-400">Rp {{ number_format($netAmount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="p-3 mt-4 rounded-lg bg-green-600/20 border border-green-600/50">
                        <div class="flex items-center gap-2 text-sm">
                            <i class="ri-check-line text-green-400"></i>
                            <span class="font-semibold text-green-400">Payment {{ ucfirst($order->payment_status) }}</span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400">via {{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>

                <!-- Buyer/Seller Info -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h2 class="mb-4 text-xl font-bold">
                        {{ auth()->id() === $order->id_buyer ? 'Seller' : 'Buyer' }} Information
                    </h2>

                    @php
                        $otherUser = auth()->id() === $order->id_buyer ? $order->seller : $order->buyer;
                    @endphp

                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($otherUser->username) }}&background=8a2be2&color=fff"
                                 alt="{{ $otherUser->username }}"
                                 class="object-cover w-full h-full">
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $otherUser->username }}</h3>
                            <p class="text-xs text-gray-400">{{ $otherUser->email }}</p>
                        </div>
                    </div>

                    <button onclick="alert('Chat feature coming soon!')"
                            class="w-full py-3 font-semibold transition border rounded-xl border-[#8a2be2]/40 bg-[#8a2be2]/20 hover:bg-[#8a2be2]/30">
                        <i class="mr-2 ri-chat-3-line"></i>
                        Contact {{ auth()->id() === $order->id_buyer ? 'Seller' : 'Buyer' }}
                    </button>
                </div>

                <!-- Order Timeline -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h2 class="mb-4 text-xl font-bold">Order Timeline</h2>

                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 bg-[#8a2be2]">
                                <i class="text-sm ri-shopping-cart-line"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Order Placed</p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($order->order_status === 'completed' && $order->completed_at)
                        <div class="flex gap-3">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 bg-green-600">
                                <i class="text-sm ri-check-line"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Order Completed</p>
                                <p class="text-xs text-gray-400">{{ $order->completed_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        @if($order->order_status === 'canceled' && $order->canceled_at)
                        <div class="flex gap-3">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 bg-red-600">
                                <i class="text-sm ri-close-line"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Order Canceled</p>
                                <p class="text-xs text-gray-400">{{ $order->canceled_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layout>
