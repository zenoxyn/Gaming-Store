<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Back Button --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-2 md:gap-0">
            <h1 class="text-3xl font-bold text-white mb-4 md:mb-8 flex items-center gap-3">
                <i class="ri-auction-line"></i>
                My Negotiations
            </h1>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 md:px-4 md:py-2 font-semibold text-white transition bg-white/10 rounded-xl hover:bg-white/20 text-sm md:text-base">
                <i class="ri-arrow-left-line"></i>
                Back to Dashboard
            </a>
        </div>

        {{-- Flash Messages --}}
        @if($negotiations->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <i class="ri-chat-off-line text-6xl text-gray-500"></i>
                <p class="mt-4 text-xl text-gray-400">No negotiations yet</p>
                <p class="mt-2 text-gray-500">Start negotiating on products you want!</p>
            </div>
        @else
            <div class="grid gap-3 md:gap-4">
                @foreach($negotiations as $nego)
                    <a href="{{ route('negotiation.show', $nego->id) }}"
                       class="block p-3 md:p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 md:gap-6">
                            {{-- Product Image --}}
                            <img src="{{ asset('storage/' . $nego->product->images[0]) }}"
                                 alt="{{ $nego->product->name }}"
                                 class="w-60 h-xs md:w-50 md:h-xs object-cover rounded-xl mx-auto sm:mx-0">

                            {{-- Info --}}
                            <div class="flex-1">
                                <h3 class="text-base md:text-xl font-bold text-white group-hover:text-purple-400 transition">
                                    {{ $nego->product->name }}
                                </h3>
                                <div class="mt-2 flex flex-col md:flex-row md:items-center gap-1 md:gap-4 text-xs md:text-sm">
                                    <span class="text-gray-400">
                                        Your Offer: <span class="text-green-400 font-semibold">Rp {{ number_format($nego->latest_buyer_offer ?? 0, 0, ',', '.') }}</span>
                                    </span>
                                    <span class="text-gray-400">
                                        Seller Price: <span class="text-orange-400 font-semibold">Rp {{ number_format($nego->latest_seller_offer ?? 0, 0, ',', '.') }}</span>
                                    </span>
                                </div>
                                <div class="mt-2 text-xs text-gray-500">
                                    Updated: {{ $nego->updated_at->diffForHumans() }}
                                    @if($nego->expires_at)
                                        | Expires: {{ $nego->expires_at->diffForHumans() }}
                                    @endif
                                </div>
                            </div>

                            {{-- Status Badge --}}
                            <div class="mt-2 sm:mt-0">
                                @if($nego->status === 'ongoing')
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-blue-500/20 border border-blue-500/50 text-blue-400 rounded-xl text-xs md:text-sm font-semibold">
                                        Ongoing
                                    </span>
                                @elseif($nego->status === 'coinflip')
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-purple-500/20 border border-purple-500/50 text-purple-400 rounded-xl text-xs md:text-sm font-semibold">
                                        🎲 Coin Flip
                                    </span>
                                @elseif($nego->status === 'accepted')
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-green-500/20 border border-green-500/50 text-green-400 rounded-xl text-xs md:text-sm font-semibold">
                                        ✓ Accepted
                                    </span>
                                @elseif($nego->status === 'rejected')
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-red-500/20 border border-red-500/50 text-red-400 rounded-xl text-xs md:text-sm font-semibold">
                                        ✗ Rejected
                                    </span>
                                @else
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 bg-gray-500/20 border border-gray-500/50 text-gray-400 rounded-xl text-xs md:text-sm font-semibold">
                                        {{ ucfirst($nego->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $negotiations->links() }}
            </div>
        @endif
    </div>
</div>
</x-layout>
