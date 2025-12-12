<x-layout>
    <div class="min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Seller Verification</h1>
                    <p class="text-gray-300 mt-1">Review and approve pending seller registrations</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition border border-white/20">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pending Sellers List -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/20 p-6">
                @if($pendingSellers->count() > 0)
                    <div class="space-y-4">
                        @foreach($pendingSellers as $seller)
                            <div class="bg-white/5 border border-white/10 rounded-lg p-6 hover:bg-white/10 transition">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <!-- User Info -->
                                    <div>
                                        <h3 class="text-lg font-bold text-white mb-3">User Information</h3>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Username:</span>
                                                <span class="text-white font-medium">{{ $seller->user->username }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Email:</span>
                                                <span class="text-white">{{ $seller->user->email }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Phone:</span>
                                                <span class="text-white">{{ $seller->user->phone }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Registered:</span>
                                                <span class="text-white">{{ $seller->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Legal Info -->
                                    <div>
                                        <h3 class="text-lg font-bold text-white mb-3">Legal Information</h3>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Legal Name:</span>
                                                <span class="text-white font-medium">{{ $seller->legal_name }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">ID Card No:</span>
                                                <span class="text-white">{{ $seller->id_card_number }}</span>
                                            </div>
                                            @if($seller->id_card_photo)
                                                <div class="mt-3">
                                                    <span class="text-gray-400 block mb-2">ID Card Photo:</span>
                                                    <img src="{{ asset('storage/' . $seller->id_card_photo) }}"
                                                         alt="ID Card"
                                                         class="w-full max-w-xs rounded-lg border border-white/20 cursor-pointer hover:opacity-80 transition"
                                                         onclick="window.open(this.src, '_blank')">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Bank Info -->
                                    <div>
                                        <h3 class="text-lg font-bold text-white mb-3">Bank Information</h3>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Bank:</span>
                                                <span class="text-white font-medium">{{ $seller->bank_name }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Account No:</span>
                                                <span class="text-white">{{ $seller->bank_account_number }}</span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="text-gray-400 min-w-[100px]">Account Name:</span>
                                                <span class="text-white">{{ $seller->bank_account_name }}</span>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-3 mt-6">
                                            <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Approve this seller?')"
                                                        class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition text-white font-semibold">
                                                    <i class="fas fa-check mr-2"></i>Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Reject this seller?')"
                                                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition text-white font-semibold">
                                                    <i class="fas fa-times mr-2"></i>Reject
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pendingSellers->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">✅</div>
                        <p class="text-gray-300 text-lg">No pending verifications</p>
                        <p class="text-gray-400 text-sm mt-2">All sellers have been processed</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
