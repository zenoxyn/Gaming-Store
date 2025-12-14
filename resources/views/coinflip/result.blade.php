<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-6">

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

        @if(session('info'))
            <div class="mb-6 p-4 bg-blue-500/20 border border-blue-500/50 rounded-xl text-blue-400">
                {{ session('info') }}
            </div>
        @endif

        <div class="text-center mb-8">
            {{-- Coin Animation --}}
            <div class="inline-block mb-6">
                <i class="ri-copper-coin-line text-9xl
                    {{ $coinFlip->result === 'heads' ? 'text-blue-400' : 'text-orange-400' }}
                    animate-spin"></i>
            </div>

            <h1 class="text-4xl font-bold text-white mb-2">
                The Coin Shows:
                <span class="{{ $coinFlip->result === 'heads' ? 'text-blue-400' : 'text-orange-400' }}">
                    {{ strtoupper($coinFlip->result) }}!
                </span>
            </h1>

            @if($coinFlip->winner === 'buyer')
                <p class="text-2xl text-green-400 font-bold mt-4">🎉 BUYER WINS!</p>
            @else
                <p class="text-2xl text-orange-400 font-bold mt-4">🎯 SELLER WINS!</p>
            @endif
        </div>

        {{-- Result Details --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <p class="text-sm text-gray-400 mb-2">Buyer's Choice</p>
                <p class="text-3xl font-bold {{ $coinFlip->buyer_call === 'heads' ? 'text-blue-400' : 'text-orange-400' }}">
                    {{ strtoupper($coinFlip->buyer_call) }}
                </p>
            </div>

            <div class="p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <p class="text-sm text-gray-400 mb-2">Coin Result</p>
                <p class="text-3xl font-bold {{ $coinFlip->result === 'heads' ? 'text-blue-400' : 'text-orange-400' }}">
                    {{ strtoupper($coinFlip->result) }}
                </p>
            </div>
        </div>

        {{-- Final Price --}}
        <div class="p-8 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-2xl text-center mb-8">
            <p class="text-lg text-gray-300 mb-3">Final Price</p>
            <p class="text-5xl font-bold text-white">
                Rp {{ number_format($coinFlip->final_price, 0, ',', '.') }}
            </p>
            <p class="text-sm text-gray-400 mt-3">
                @if($coinFlip->winner === 'buyer')
                    (Buyer's offer accepted)
                @else
                    (Seller's price accepted)
                @endif
            </p>
        </div>

        {{-- Payment Section --}}
        @if(auth()->id() == $coinFlip->id_buyer && !$coinFlip->buyer_paid)
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-white mb-4 text-center">Complete Payment</h2>

                <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                    <div>
                        <p class="text-sm text-gray-400">Deposit Paid</p>
                        <p class="text-xl font-bold text-green-400">Rp {{ number_format($coinFlip->dp_amount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Remaining Payment</p>
                        <p class="text-xl font-bold text-yellow-400">Rp {{ number_format($coinFlip->getRemainingPayment(), 0, ',', '.') }}</p>
                    </div>
                </div>

                <form action="{{ route('coinflip.payRemaining', $coinFlip->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl hover:scale-105 transition">
                        Pay Remaining Amount
                    </button>
                </form>

                <p class="text-sm text-gray-400 text-center mt-4">
                    Your balance: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}
                </p>

                @if($coinFlip->payment_deadline)
                    <p class="text-xs text-red-400 text-center mt-2">
                        ⚠️ Payment deadline: {{ $coinFlip->payment_deadline->format('d M Y, H:i') }}
                    </p>
                @endif
            </div>
        @elseif($coinFlip->buyer_paid)
            <div class="text-center p-8 bg-green-500/20 border border-green-500/50 rounded-2xl">
                <i class="ri-check-double-line text-6xl text-green-400"></i>
                <h3 class="text-2xl font-bold text-white mt-4">Payment Completed!</h3>
                <p class="text-gray-300 mt-2">Transaction successful. Your order has been created!</p>

                <div class="flex gap-4 justify-center mt-6">
                    <a href="{{ route('order.index') }}"
                       class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:scale-105 transition">
                        <i class="ri-shopping-bag-line mr-2"></i>
                        View My Orders
                    </a>
                    <a href="{{ route('negotiation.show', $coinFlip->id_negotiation) }}"
                       class="px-6 py-3 bg-white/10 text-white font-semibold rounded-xl hover:bg-white/20 transition">
                        Back to Negotiation
                    </a>
                </div>
            </div>
        @else
            <div class="text-center p-8 bg-blue-500/20 border border-blue-500/50 rounded-2xl">
                <p class="text-xl text-white">Waiting for buyer payment...</p>
            </div>
        @endif
    </div>
</div>
</x-layout>
