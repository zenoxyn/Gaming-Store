<x-layout>
<div class="max-w-6xl mx-auto px-4 py-8">
    <a href="{{ route('home') }}" class="max-w-max flex items-center gap-2 px-4 py-2  font-semibold text-white transition bg-white/10 rounded-xl hover:bg-white/20">
                    <i class="ri-arrow-left-line"></i>
                    Back to Home
    </a>
    <div class="bg-purple-500/20 rounded-lg shadow-lg p-6 mt-4">
        <h2 class="text-2xl font-bold text-white mb-6">Chat Conversations</h2>

        @if($chats->isEmpty())
            <div class="text-center py-20 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl">
                <i class="ri-chat-off-line text-6xl text-gray-500"></i>
                <p class="text-gray-300 text-lg">No conversations yet</p>
                <p class="text-gray-400 text-sm mt-2">Start a new chat by viewing a product</p>
            </div>
        @else
            <div class=" space-y-4">
                @foreach($chats as $chat)
                    @php
                        $otherParticipant = $chat->participants->where('id_user', '!=', auth()->id())->first();
                        $myParticipant = $chat->participants->where('id_user', auth()->id())->first();
                    @endphp
                    <a href="{{ route('chat.show', $chat->id) }}" class="block p-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl hover:bg-white/10 transition group">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 rounded-full bg-linear-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold">
                                        {{ substr($otherParticipant->user->username ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-white">{{ $otherParticipant->user->username ?? 'Unknown' }}</h3>
                                        @if($chat->product)
                                            <p class="text-xs text-gray-500">{{ $chat->product->name_product }}</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-400 text-sm truncate">
                                    {{ $chat->last_message ?? 'No messages yet' }}
                                </p>
                                <p class="text-gray-500 text-xs mt-1">
                                    {{ $chat->last_message_at ? $chat->last_message_at->diffForHumans() : '' }}
                                </p>
                            </div>
                            <div>
                                @if($myParticipant && $myParticipant->unread_count > 0)
                                    <span class="inline-block bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        {{ $myParticipant->unread_count }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $chats->links() }}
            </div>
        @endif
    </div>
</div>
</x-layout>
