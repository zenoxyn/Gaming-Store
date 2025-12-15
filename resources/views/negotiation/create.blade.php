<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-3xl mx-auto px-6">

        <h1 class="text-3xl font-bold text-white mb-8 text-center">
            Start Negotiation
        </h1>

        {{-- Product Card --}}
        <div class="mb-6 p-6 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
            <div class="flex items-center gap-6">
                @php
                    $productImages = is_array($product->images) ? $product->images : json_decode($product->images, true);
                @endphp
                @if(!empty($productImages))
                    <img src="{{ asset('storage/' . $productImages[0]) }}"
                         alt="{{ $product->name }}"
                         class="w-32 h-32 object-cover rounded-xl">
                @else
                    <div class="w-32 h-32 flex items-center justify-center bg-gradient-to-br from-purple-900 to-purple-700 rounded-xl text-4xl">
                        🎮
                    </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $product->name }}</h2>
                    <p class="text-gray-400 mt-2">{{ $product->category->name }}</p>
                    <p class="text-orange-400 font-bold text-2xl mt-3">
                        Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Offer Form --}}
        <form action="{{ route('negotiation.store', $product->id) }}" method="POST" class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Your Offer Price (Rp)
                </label>
                <input type="number" name="offered_price" required min="1000"
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                       placeholder="Enter your offer">
                <p class="mt-2 text-sm text-gray-400">Seller's price: Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Notes (Optional)
                </label>
                <textarea name="notes" rows="3" maxlength="500"
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                          placeholder="Add a message to the seller..."></textarea>
            </div>

            <button type="submit" class="w-full px-6 py-4 bg-linear-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:scale-105 transition flex items-center justify-center gap-2">
                <i class="ri-send-plane-fill text-xl"></i>
                Send Offer
            </button>
        </form>
    </div>
</div>
</x-layout>
