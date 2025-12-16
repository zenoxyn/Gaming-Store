<x-layout>
<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-4">
        <a href="{{ route('chat.index') }}"
           class="flex items-center gap-2 px-3 py-2 text-sm text-white bg-white/10 rounded-lg hover:bg-white/20">
            <i class="ri-arrow-left-line"></i>
            Back
        </a>

        @php
            $otherParticipant = $chat->participants->where('id_user', '!=', auth()->id())->first();
        @endphp
        <div class="flex-1">
            <h2 class="text-xl font-bold text-white">
                {{ $otherParticipant->user->username ?? 'Chat' }}
            </h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        {{-- CHAT --}}
        <div class="lg:col-span-3 bg-white/5 border border-white/10 rounded-2xl p-4 h-[520px] flex flex-col">
            {{-- Messages --}}
            <div id="chatBox" class="flex-1 space-y-4 overflow-y-auto pr-2">
                @forelse($chat->messages as $message)
                    <div class="flex {{ $message->id_sender == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs md:max-w-md">
                            <div class="text-xs mb-1
                                {{ $message->id_sender == auth()->id() ? 'text-purple-400 text-right' : 'text-green-400' }}">
                                {{ $message->sender->username }}
                            </div>

                            <div class="px-4 py-2 rounded-2xl
                                {{ $message->id_sender == auth()->id()
                                    ? 'bg-purple-600/30 text-white rounded-br-none'
                                    : 'bg-green-600/30 text-white rounded-bl-none' }}">
                                {{ $message->message }}
                            </div>

                            <div class="text-[10px] text-gray-400 mt-1
                                {{ $message->id_sender == auth()->id() ? 'text-right' : 'text-left' }}">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 mt-40">
                        <i class="ri-chat-1-line text-4xl mb-2"></i>
                        <p>No messages yet</p>
                        <p class="text-sm">Say hello 👋</p>
                    </div>
                @endforelse
            </div>

            {{-- Send Message --}}
            <form action="{{ route('chat.message.send', $chat->id) }}"
                method="POST"
                class="mt-4 flex gap-2">
                @csrf

                <input
                    type="text"
                    name="message"
                    autocomplete="off"
                    placeholder="Type your message..."
                    class="flex-1 px-4 py-3 rounded-xl bg-white/10 text-white border border-white/10
                        focus:outline-none focus:ring-2 focus:ring-purple-500 "
                    required
                >

                <button
                    type="submit"
                    class="px-5 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold">
                    <i class="ri-send-plane-2-fill"></i>
                </button>
            </form>
        </div>

        {{-- PRODUCT --}}
        @if($chat->product)
            <a href="{{ route('product.show', $chat->product->slug) }}" class="hover:scale-[1.02] transition-transform">
                <div class="lg:col-span-1 p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30 h-fit">
                    <h2 class="mb-4 text-xl font-bold">Product Details</h2>
                    <div class="space-y-2">
                        @php
                            $order = $chat->order ?? null;
                            $product = $order->product ?? $chat->product;
                            $productImages = is_array($product->images ?? null) ? $product->images : [];
                        @endphp
                        <div class="w-full h-40 rounded-lg shrink-0 {{ empty($productImages) ? 'bg-linear-to-br from-purple-900 to-purple-700' : 'bg-black' }}">
                            @if(!empty($productImages))
                                <img src="{{ asset('storage/' . $productImages[0]) }}"
                                        alt="{{ $product->name_product }}"
                                        class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-3xl">🎮</div>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <h3 class="mb-1 text-md font-semibold">{{ $product->name_product ?? '-' }}</h3>
                            <p class="mb-2 text-sm text-gray-400">{{ $product->category->name ?? '-' }}</p>
                            <p class="mb-2 text-sm text-gray-400">{{ $product->description ?? '-' }}</p>
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-gray-400">Price: <span class="font-semibold text-yellow-400">Rp {{ number_format($product->getCurrentPrice(), 0, ',', '.') }}</span></span>
                            </div>
                        </div>
                    </div>


                </div>
            </a>
        @endif

    </div>


</div>

{{-- Auto scroll to bottom --}}
<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
</x-layout>
