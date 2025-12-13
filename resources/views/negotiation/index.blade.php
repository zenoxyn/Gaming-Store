<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm transition border rounded-full cursor-pointer bg-white/10 hover:bg-white/20 border-white/20">
                <i class="ri-arrow-left-line"></i>
                <span>Back</span>
            </a>
        </div>

        <h1 class="text-3xl font-bold text-white mb-8 flex items-center gap-3">
            <i class="ri-auction-line"></i>
            My Negotiations
        </h1>

        @if($negotiations->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <i class="ri-chat-off-line text-6xl text-gray-500"></i>
                <p class="mt-4 text-xl text-gray-400">No negotiations yet</p>
                <p class="mt-2 text-gray-500">Start negotiating on products you want!</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($negotiations as $nego)
                    <a href="{{ route('negotiation.show', $nego->id) }}"
                       class="block p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center gap-6">
                            {{-- Product Image --}}
                            <img src="{{ asset('storage/' . json_decode($nego->product->images)[0]) }}"
                                 alt="{{ $nego->product->name }}"
                                 class="w-24 h-24 object-cover rounded-xl">

                            {{-- Info --}}
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-white group-hover:text-purple-400 transition">
                                    {{ $nego->product->name }}
                                </h3>
                                <div class="mt-2 flex items-center gap-4 text-sm">
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
                            <div>
                                @if($nego->status === 'ongoing')
                                    <span class="px-4 py-2 bg-blue-500/20 border border-blue-500/50 text-blue-400 rounded-xl text-sm font-semibold">
                                        Ongoing
                                    </span>
                                @elseif($nego->status === 'coinflip')
                                    <span class="px-4 py-2 bg-purple-500/20 border border-purple-500/50 text-purple-400 rounded-xl text-sm font-semibold">
                                        🎲 Coin Flip
                                    </span>
                                @elseif($nego->status === 'accepted')
                                    <span class="px-4 py-2 bg-green-500/20 border border-green-500/50 text-green-400 rounded-xl text-sm font-semibold">
                                        ✓ Accepted
                                    </span>
                                @elseif($nego->status === 'rejected')
                                    <span class="px-4 py-2 bg-red-500/20 border border-red-500/50 text-red-400 rounded-xl text-sm font-semibold">
                                        ✗ Rejected
                                    </span>
                                @else
                                    <span class="px-4 py-2 bg-gray-500/20 border border-gray-500/50 text-gray-400 rounded-xl text-sm font-semibold">
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
