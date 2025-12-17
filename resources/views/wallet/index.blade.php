<x-layout>
<div class="min-h-screen pt-20 pb-8 md:pt-24 md:pb-12">
    <div class="max-w-6xl mx-auto px-2 md:px-4">

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

        {{-- Back Button --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-2 md:gap-0">
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-4 md:mb-8 flex items-center gap-3">
                <i class="ri-wallet-line"></i>
                My Wallet
            </h1>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 md:px-4 md:py-2 font-semibold text-white transition bg-white/10 rounded-xl hover:bg-white/20 text-sm md:text-base">
                <i class="ri-arrow-left-line"></i>
                Back to Dashboard
            </a>
        </div>

        {{-- Wallet Balance Card --}}
        <div class="mb-6 md:mb-8 p-4 md:p-8 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl shadow-2xl relative overflow-hidden">
            {{-- Decorative background --}}
            <div class="absolute inset-0 bg-white/5"></div>

            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-0">
                <div>
                    <p class="text-white/80 text-xs md:text-sm mb-2 flex items-center gap-2">
                        <i class="ri-wallet-3-line text-lg md:text-xl"></i>
                        Total Balance
                    </p>
                    <h1 class="text-3xl md:text-5xl font-bold text-white">
                        Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                    </h1>
                </div>
                <div>
                    <a href="{{ route('wallet.topup') }}"
                       class="inline-flex items-center gap-2 px-5 py-3 md:px-8 md:py-4 bg-white text-purple-600 font-bold rounded-xl hover:bg-gray-100 hover:scale-105 transition-all shadow-lg text-sm md:text-base">
                        <i class="ri-add-circle-line text-lg md:text-xl"></i>
                        Top-up
                    </a>
                </div>
            </div>
        </div>

        {{-- Transaction History --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-4 md:p-8">
            <div class="flex items-center justify-between mb-4 md:mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-white flex items-center gap-2">
                    <i class="ri-history-line"></i>
                    Transaction History
                </h2>
            </div>

            @if($transactions->isEmpty())
                <div class="text-center py-12 text-gray-400">
                    <p class="text-xl">📝</p>
                    <p class="mt-4">No transactions yet</p>
                </div>
            @else
                <div class="space-y-2 md:space-y-3">
                    @foreach($transactions as $transaction)
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 md:p-4 bg-white/5 rounded-xl hover:bg-white/10 transition">
                            <div class="flex items-center gap-3 md:gap-4">
                                {{-- Icon based on type --}}
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center
                                    @if(in_array($transaction->type, ['topup', 'refund', 'sale', 'escrow_out', 'deposit_release', 'penalty']))
                                        bg-green-500/20 text-green-400
                                    @else
                                        bg-red-500/20 text-red-400
                                    @endif">
                                    @if(in_array($transaction->type, ['topup', 'refund', 'sale', 'escrow_out', 'deposit_release', 'penalty']))
                                        ↓
                                    @else
                                        ↑
                                    @endif
                                </div>

                                <div>
                                    <p class="text-white font-semibold capitalize text-sm md:text-base">
                                        {{ str_replace('_', ' ', $transaction->type) }}
                                    </p>
                                    <p class="text-gray-400 text-xs md:text-sm">
                                        {{ $transaction->description ?? '-' }}
                                    </p>
                                    <p class="text-gray-500 text-xs mt-1">
                                        {{ $transaction->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="text-right mt-2 sm:mt-0">
                                <p class="text-base md:text-lg font-bold
                                    @if(in_array($transaction->type, ['topup', 'refund', 'sale', 'escrow_out', 'deposit_release', 'penalty']))
                                        text-green-400
                                    @else
                                        text-red-400
                                    @endif">
                                    @if(in_array($transaction->type, ['topup', 'refund', 'sale', 'escrow_out', 'deposit_release', 'penalty']))
                                        +
                                    @else
                                        -
                                    @endif
                                    Rp {{ number_format(abs($transaction->amount), 0, ',', '.') }}
                                </p>
                                <p class="text-gray-500 text-xs">
                                    Balance: Rp {{ number_format($transaction->balance_after, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
</x-layout>
