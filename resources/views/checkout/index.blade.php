<x-layout>
<div class="min-h-screen px-4 py-8 mx-auto max-w-4xl lg:px-6">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Checkout</h1>
        <p class="text-gray-400">Review your order before payment</p>
    </div>

    <!-- Flash Messages -->
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Product Info -->
            <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <h2 class="text-xl font-bold text-white mb-4">Order Details</h2>

                <div class="flex gap-4">
                    @php
                        $productImages = is_array($product->images) ? $product->images : [];
                    @endphp
                    <div class="w-24 h-24 overflow-hidden rounded-lg shrink-0 {{ empty($productImages) ? 'bg-linear-to-br from-purple-900 to-purple-700' : 'bg-black' }}">
                        @if(!empty($productImages))
                            <img src="{{ asset('storage/' . $productImages[0]) }}"
                                 alt="{{ $product->name_product }}"
                                 class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-3xl">🎮</div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $product->name_product }}</h3>
                        <p class="text-sm text-gray-400 mb-2">{{ $product->category->name }}</p>
                        <p class="text-gray-400 text-sm mb-2">Seller: <span class="text-white font-semibold">{{ $product->seller->username }}</span></p>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400">Price:</span>
                            <span class="text-xl font-bold text-yellow-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="mt-4 pt-4 border-t border-white/10">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400">Quantity</span>
                        <span class="text-white font-semibold">1 item</span>
                    </div>
                </div>
            </div>

            <!-- Buyer Info -->
            <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <h2 class="text-xl font-bold text-white mb-4">Buyer Information</h2>
                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Name</span>
                        <span class="text-white font-semibold">{{ auth()->user()->username }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Email</span>
                        <span class="text-white">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                
                <form id="checkoutForm" action="{{ route('product.buyNow', $product->id) }}" method="POST">
                    @csrf
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">
                            <i class="ri-information-line mr-1"></i>
                            Account Information (Optional)
                        </label>
                        <textarea name="buyer_notes" rows="3" maxlength="500"
                                  class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition text-sm"
                                  placeholder="Player ID, Server, or any information needed for delivery...">{{ old('buyer_notes') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Example: Player ID: 123456789 | Server: Asia</p>
                    </div>
                </form>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">

            <!-- Payment Summary -->
            <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30 sticky top-24">
                <h2 class="text-xl font-bold text-white mb-4">Payment Summary</h2>

                @php
                    $price = $product->getCurrentPrice();
                    $platformFee = $price * 0.03; // 3% fee
                    $total = $price;
                    $walletBalance = auth()->user()->wallet->balance ?? 0;
                    $sufficient = $walletBalance >= $total;
                @endphp

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Price</span>
                        <span class="font-semibold text-white">Rp {{ number_format($price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Quantity</span>
                        <span class="font-semibold text-white">1</span>
                    </div>
                    <div class="pt-3 border-t border-white/10">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold text-white">Total</span>
                            <span class="text-2xl font-bold text-yellow-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-gray-500">*Platform fee (3%) will be deducted from seller</p>
                    </div>
                </div>

                <!-- Wallet Balance -->
                <div class="p-3 rounded-lg mb-6 {{ $sufficient ? 'bg-green-600/20 border border-green-600/50' : 'bg-red-600/20 border border-red-600/50' }}">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-300">Wallet Balance</span>
                        <span class="font-bold {{ $sufficient ? 'text-green-400' : 'text-red-400' }}">
                            Rp {{ number_format($walletBalance, 0, ',', '.') }}
                        </span>
                    </div>
                    @if(!$sufficient)
                        <p class="text-xs text-red-400 mt-2">Insufficient balance. Please top-up first.</p>
                    @endif
                </div>

                <!-- Action Buttons -->
                <button type="submit" form="checkoutForm"
                        @if(!$sufficient) disabled @endif
                        class="w-full px-6 py-4 bg-linear-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:scale-105 transition disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 mb-3">
                    <i class="ri-check-line mr-2"></i>
                    Confirm & Pay
                </button>

                @if(!$sufficient)
                    <a href="{{ route('wallet.topup') }}" class="block w-full px-6 py-3 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition text-center mb-3">
                        <i class="ri-wallet-3-line mr-2"></i>
                        Top-up Wallet
                    </a>
                @endif

                <a href="{{ route('product.show', $product->slug) }}" class="block w-full px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-white/20 transition text-center">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Cancel
                </a>
            </div>

        </div>

    </div>

</div>
</x-layout>
