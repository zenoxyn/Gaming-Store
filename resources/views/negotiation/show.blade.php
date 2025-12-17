<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Back Button --}}
        <a href="{{ route('negotiation.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white mb-6 transition group">
            <i class="ri-arrow-left-line group-hover:-translate-x-1 transition-transform"></i>
            Back to Negotiations
        </a>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-400">
                {{ session('error') }}
            </div>
        @endif

        {{-- Product Info Card --}}
        <div class="mb-6 p-6 bg-linear-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-2xl">
            <div class="flex items-center gap-6">
                {{-- Product Image --}}
                @php
                    $imageUrl = !empty($negotiation->product->images) && isset($negotiation->product->images[0])
                        ? (str_starts_with($negotiation->product->images[0], 'http')
                            ? $negotiation->product->images[0]
                            : asset('storage/' . $negotiation->product->images[0]))
                        : asset('images/icon/logo.png');
                @endphp
                    <img src="{{ $imageUrl }}"
                    alt="{{ $negotiation->product->name }}"
                    class="w-32 h-32 object-cover rounded-xl">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white">{{ $negotiation->product->name }}</h2>
                    <p class="text-gray-300 mt-2">{{ $negotiation->product->category->name }}</p>
                    <div class="mt-3 flex items-center gap-4">
                        <span class="text-sm text-gray-400">
                            Original Price: <span class="text-orange-400 font-semibold text-lg">Rp {{ number_format($negotiation->product->getCurrentPrice(), 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    @if($negotiation->status === 'ongoing')
                        <span class="px-4 py-2 bg-blue-500/20 border border-blue-500/50 text-blue-400 rounded-xl text-sm font-semibold">
                            Ongoing
                        </span>
                    @elseif($negotiation->status === 'coinflip')
                        <span class="px-4 py-2 bg-purple-500/20 border border-purple-500/50 text-purple-400 rounded-xl text-sm font-semibold">
                            🎲 Coin Flip Mode
                        </span>
                    @endif
                    @if($negotiation->expires_at && $negotiation->status === 'ongoing')
                        <p class="text-xs text-gray-500 mt-2">
                            Expires {{ $negotiation->expires_at->diffForHumans() }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Negotiation Chat --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-6">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                <i class="ri-message-2-line"></i>
                Offer History
            </h3>

            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($negotiation->offers as $offer)
                    <div class="flex {{ $offer->id_sender == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-md">
                            <div class="flex items-center gap-2 mb-1 {{ $offer->id_sender == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <span class="text-sm font-semibold {{ $offer->id_sender == auth()->id() ? 'text-purple-400' : 'text-green-400' }}">
                                    {{ $offer->sender->username }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $offer->created_at->format('d M, H:i') }}
                                </span>
                            </div>
                            <div class="p-4 rounded-2xl {{ $offer->id_sender == auth()->id() ? 'bg-purple-600/20 border border-purple-500/30' : 'bg-green-600/20 border border-green-500/30' }}">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs px-2 py-1 rounded
                                        @if($offer->status === 'pending') bg-yellow-500/20 text-yellow-400
                                        @elseif($offer->status === 'accepted') bg-green-500/20 text-green-400
                                        @elseif($offer->status === 'rejected') bg-red-500/20 text-red-400
                                        @elseif($offer->status === 'countered') bg-gray-500/20 text-gray-400
                                        @else bg-gray-500/20 text-gray-400
                                        @endif">
                                        {{ ucfirst($offer->status) }}
                                    </span>
                                </div>
                                <p class="text-2xl font-bold text-white">
                                    Rp {{ number_format($offer->offered_price, 0, ',', '.') }}
                                </p>
                                @if($offer->notes)
                                    <p class="text-sm text-gray-300 mt-2">{{ $offer->notes }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Action Buttons --}}
        @if($negotiation->status === 'ongoing')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Counter Offer Form --}}
                <form action="{{ route('negotiation.counter', $negotiation->id) }}" method="POST" class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                    @csrf
                    <h4 class="text-lg font-bold text-white mb-4">Make Counter Offer</h4>
                    <input type="number" name="offered_price" required min="1000"
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition mb-3"
                           placeholder="Your offer (Rp)">
                    <textarea name="notes" rows="2"
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition mb-3"
                              placeholder="Optional notes..."></textarea>
                    <button type="submit" class="w-full px-6 py-3 bg-linear-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:scale-105 transition">
                        Send Counter Offer
                    </button>
                </form>

                {{-- Quick Actions --}}
                <div class="space-y-3">
                    @php
                        // Get last offer to check who made it
                        $lastOffer = $negotiation->offers()->latest()->first();
                        $canAcceptReject = $lastOffer && $lastOffer->id_sender != auth()->id();
                    @endphp

                    @if($canAcceptReject)
                        <form action="{{ route('negotiation.accept', $negotiation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-6 py-4 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition flex items-center justify-center gap-2">
                                <i class="ri-check-line text-xl"></i>
                                Accept Current Offer
                            </button>
                        </form>

                        <form action="{{ route('negotiation.reject', $negotiation->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                            @csrf
                            <button type="submit" class="w-full px-6 py-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition flex items-center justify-center gap-2">
                                <i class="ri-close-line text-xl"></i>
                                Reject Negotiation
                            </button>
                        </form>
                    @else
                        <div class="p-4 bg-blue-500/20 border border-blue-500/50 rounded-xl text-center">
                            <p class="text-sm text-blue-300">
                                <i class="ri-information-line"></i>
                                Waiting for other party's response...
                            </p>
                        </div>
                    @endif

                    <form action="{{ route('negotiation.coinflip', $negotiation->id) }}" method="POST">
                        @csrf
                        @if($negotiation->coinflip_proposed_by)
                            @if($negotiation->coinflip_proposed_by == auth()->id())
                                <button type="button" disabled class="w-full px-6 py-4 bg-gray-600 text-white font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                    <i class="ri-time-line text-xl"></i>
                                    Waiting for Other Party...
                                </button>
                            @else
                                <button type="submit" class="w-full px-6 py-4 bg-linear-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:scale-105 transition flex items-center justify-center gap-2">
                                    <i class="ri-check-double-line text-xl"></i>
                                    Accept Coin Flip ({{ $negotiation->coinflip_proposed_by == $negotiation->id_buyer ? 'Buyer' : 'Seller' }} Proposed)
                                </button>
                            @endif
                        @else
                            <button type="submit" class="w-full px-6 py-4 bg-linear-to-r from-yellow-600 to-orange-600 text-white font-bold rounded-xl hover:scale-105 transition flex items-center justify-center gap-2">
                                <i class="ri-copper-coin-line text-xl"></i>
                                Propose Coin Flip
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        @elseif($negotiation->status === 'accepted')
            @php
                // Check if order already created for THIS negotiation (payment completed)
                $orderExists = \App\Models\Order::where('id_negotiation', $negotiation->id)
                    ->where('payment_status', 'paid')
                    ->exists();
            @endphp

            @if($orderExists)
                {{-- Payment completed, show success --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
                    <div class="text-center">
                        <i class="ri-check-double-line text-6xl text-green-400"></i>
                        <h3 class="text-2xl font-bold text-white mt-4">Payment Completed!</h3>
                        <p class="text-gray-300 mt-2">Your order has been created successfully</p>

                        <a href="{{ route('order.index') }}" class="inline-block mt-6 px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:scale-105 transition">
                            <i class="ri-shopping-bag-line mr-2"></i>
                            View My Orders
                        </a>
                    </div>
                </div>
            @else
                {{-- Payment not yet completed --}}
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
                    <div class="text-center">
                        <i class="ri-check-double-line text-6xl text-green-400"></i>
                        <h3 class="text-2xl font-bold text-white mt-4">Offer Accepted!</h3>
                        <p class="text-gray-300 mt-2">Final Price: <span class="text-2xl font-bold text-green-400">Rp {{ number_format($negotiation->latest_seller_offer ?? $negotiation->latest_buyer_offer, 0, ',', '.') }}</span></p>

                        @if(auth()->id() == $negotiation->id_buyer)
                            <div class="mt-6 p-4 bg-yellow-500/20 border border-yellow-500/50 rounded-xl">
                                <p class="text-yellow-300 font-semibold mb-4">
                                    <i class="ri-wallet-3-line"></i> Please complete payment to proceed
                                </p>
                                <form action="{{ route('negotiation.pay', $negotiation->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="text-left">
                                        <label class="block mb-2 text-sm font-semibold text-gray-300">
                                            <i class="ri-information-line mr-1"></i>
                                            Account Information (Optional)
                                        </label>
                                        <textarea name="buyer_notes" rows="3" maxlength="500"
                                                  class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition text-sm"
                                                  placeholder="Player ID, Server, or any information needed for delivery...">{{ old('buyer_notes') }}</textarea>
                                        <p class="mt-1 text-xs text-gray-500">Example: Player ID: 123456789 | Server: Asia</p>
                                    </div>
                                    <button type="submit" class="w-full px-8 py-4 bg-linear-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:scale-105 transition flex items-center justify-center gap-2">
                                        <i class="ri-money-dollar-circle-line text-xl"></i>
                                        Pay Now (Wallet)
                                    </button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-400 mt-4">
                                <i class="ri-time-line"></i> Waiting for buyer to complete payment...
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        @elseif($negotiation->status === 'coinflip' && $negotiation->coinFlipGame)
            <div class="text-center p-8 bg-linear-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-2xl">
                <i class="ri-copper-coin-line text-6xl text-yellow-400"></i>
                <h3 class="text-2xl font-bold text-white mt-4">Coin Flip Game Started!</h3>
                <p class="text-gray-300 mt-2">Proceed to the coin flip game to continue.</p>
                <a href="{{ route('coinflip.show', $negotiation->coinFlipGame->id) }}"
                   class="inline-block mt-6 px-8 py-4 bg-linear-to-r from-yellow-600 to-orange-600 text-white font-bold rounded-xl hover:scale-105 transition">
                    Go to Coin Flip Game
                </a>
            </div>
        @endif
    </div>
</div>
</x-layout>
