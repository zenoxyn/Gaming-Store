<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-6">

        <h1 class="text-4xl font-bold text-white mb-8 text-center flex items-center justify-center gap-3">
            <i class="ri-copper-coin-line text-yellow-400"></i>
            Coin Flip Game
        </h1>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- Product Info --}}
        <div class="mb-6 p-6 bg-gradient-to-r from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-2xl">
            <div class="flex items-center gap-4">
                @php
                    $images = is_array($coinFlip->negotiation->product->images) 
                        ? $coinFlip->negotiation->product->images 
                        : json_decode($coinFlip->negotiation->product->images, true);
                    $firstImage = !empty($images) && isset($images[0]) ? $images[0] : null;
                    $imageUrl = $firstImage 
                        ? (str_starts_with($firstImage, 'http') ? $firstImage : asset('storage/' . $firstImage))
                        : 'https://via.placeholder.com/300x200?text=No+Image';
                @endphp
                <img src="{{ $imageUrl }}"
                     alt="{{ $coinFlip->negotiation->product->name }}"
                     class="w-24 h-24 object-cover rounded-xl">
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-white">{{ $coinFlip->negotiation->product->name }}</h2>
                    <div class="mt-2 flex items-center gap-6 text-sm">
                        <span class="text-gray-300">
                            Buyer Offer: <span class="text-green-400 font-bold text-lg">Rp {{ number_format($coinFlip->negotiation->latest_buyer_offer, 0, ',', '.') }}</span>
                        </span>
                        <span class="text-gray-300">
                            Seller Price: <span class="text-orange-400 font-bold text-lg">Rp {{ number_format($coinFlip->negotiation->latest_seller_offer, 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Game Status --}}
        @if($coinFlip->game_status === 'waiting_dp')
            {{-- DP Payment Section --}}
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 text-center">
                <i class="ri-wallet-3-line text-6xl text-purple-400"></i>
                <h2 class="text-2xl font-bold text-white mt-4">Deposit Required</h2>
                <p class="text-gray-300 mt-2">Buyer must pay 50% deposit before starting the game</p>

                <div class="mt-6 p-6 bg-purple-600/20 border border-purple-500/30 rounded-xl inline-block">
                    <p class="text-sm text-gray-400">Deposit Amount</p>
                    <p class="text-4xl font-bold text-white mt-2">
                        Rp {{ number_format($coinFlip->dp_amount, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-2">
                        (50% of price difference: Rp {{ number_format(abs($coinFlip->negotiation->latest_seller_offer - $coinFlip->negotiation->latest_buyer_offer), 0, ',', '.') }})
                    </p>
                </div>

                @if(auth()->id() == $coinFlip->id_buyer)
                    <form action="{{ route('coinflip.payDeposit', $coinFlip->id) }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:scale-105 transition">
                            Pay Deposit Now
                        </button>
                    </form>
                    <p class="text-sm text-gray-500 mt-3">
                        Your balance: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}
                    </p>
                @else
                    <p class="text-yellow-400 mt-6">Waiting for buyer to pay deposit...</p>
                @endif
            </div>

        @elseif($coinFlip->game_status === 'playing')
            {{-- Choose Side Section --}}
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 text-center">
                <i class="ri-copper-coin-line text-6xl text-yellow-400 animate-bounce"></i>
                <h2 class="text-2xl font-bold text-white mt-4">Choose Your Side!</h2>
                <p class="text-gray-300 mt-2">Pick Heads or Tails and flip the coin</p>

                @if(auth()->id() == $coinFlip->id_buyer)
                    <div class="mt-8 grid grid-cols-2 gap-6 max-w-md mx-auto">
                        <form action="{{ route('coinflip.choose', $coinFlip->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="choice" value="heads">
                            <button type="submit" class="w-full p-8 bg-gradient-to-br from-blue-600/20 to-cyan-600/20 border-2 border-blue-500/50 rounded-2xl hover:scale-105 hover:border-blue-400 transition group">
                                <i class="ri-coin-line text-5xl text-blue-400 group-hover:rotate-180 transition-transform duration-500"></i>
                                <p class="text-2xl font-bold text-white mt-3">HEADS</p>
                            </button>
                        </form>

                        <form action="{{ route('coinflip.choose', $coinFlip->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="choice" value="tails">
                            <button type="submit" class="w-full p-8 bg-gradient-to-br from-orange-600/20 to-red-600/20 border-2 border-orange-500/50 rounded-2xl hover:scale-105 hover:border-orange-400 transition group">
                                <i class="ri-coin-line text-5xl text-orange-400 group-hover:rotate-180 transition-transform duration-500"></i>
                                <p class="text-2xl font-bold text-white mt-3">TAILS</p>
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-yellow-400 mt-6">Waiting for buyer to choose...</p>
                @endif
            </div>

        @elseif($coinFlip->game_status === 'finished')
            {{-- Result Already Shown - Redirect --}}
            <script>window.location.href = "{{ route('coinflip.result', $coinFlip->id) }}";</script>
        @endif
    </div>
</div>
</x-layout>
