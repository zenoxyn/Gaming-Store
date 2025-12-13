<x-layout>
<div class="min-h-screen pt-24 pb-12">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Back Button --}}
        <a href="{{ route('wallet.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white mb-8 transition group">
            <i class="ri-arrow-left-line group-hover:-translate-x-1 transition-transform"></i>
            Back to Wallet
        </a>

        {{-- Top-up Form --}}
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl mb-4">
                    <i class="ri-wallet-3-fill text-3xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Top-up Wallet</h1>
                <p class="text-gray-400">Add balance to your Gaming Store wallet</p>
            </div>

            {{-- Current Balance --}}
            <div class="mb-8 p-6 bg-gradient-to-r from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl">
                <p class="text-gray-400 text-sm mb-1 flex items-center gap-2">
                    <i class="ri-money-dollar-circle-line"></i>
                    Current Balance
                </p>
                <p class="text-4xl font-bold text-white">
                    Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                </p>
            </div>

            {{-- Amount Input --}}
            <form id="topupForm" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Top-up Amount (Rp)
                    </label>
                    <input type="number"
                           name="amount"
                           id="amount"
                           min="10000"
                           max="10000000"
                           step="1000"
                           required
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                           placeholder="Enter amount (min 10,000)">
                    <p class="mt-2 text-sm text-gray-400">Minimum: Rp 10,000 | Maximum: Rp 10,000,000</p>
                </div>

                {{-- Quick Amount Buttons --}}
                <div>
                    <p class="text-sm font-medium text-gray-300 mb-3 flex items-center gap-2">
                        <i class="ri-flashlight-line"></i>
                        Quick Select
                    </p>
                    <div class="grid grid-cols-3 gap-3">
                        <button type="button" onclick="setAmount(50000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 50K
                        </button>
                        <button type="button" onclick="setAmount(100000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 100K
                        </button>
                        <button type="button" onclick="setAmount(250000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 250K
                        </button>
                        <button type="button" onclick="setAmount(500000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 500K
                        </button>
                        <button type="button" onclick="setAmount(1000000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 1M
                        </button>
                        <button type="button" onclick="setAmount(2000000)"
                                class="px-4 py-3 bg-gradient-to-br from-purple-600/20 to-pink-600/20 border border-purple-500/30 rounded-xl text-white font-semibold hover:from-purple-600/30 hover:to-pink-600/30 hover:scale-105 transition-all">
                            Rp 2M
                        </button>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="payButton"
                        class="w-full px-6 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl hover:from-purple-700 hover:to-pink-700 hover:scale-105 transition-all shadow-lg flex items-center justify-center gap-2">
                    <i class="ri-secure-payment-line text-xl"></i>
                    <span>Proceed to Payment</span>
                </button>
            </form>
        </div>

        {{-- Payment Methods Info --}}
        <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/30 rounded-xl">
            <p class="text-sm text-blue-300">
                ℹ️ Payment powered by <strong>Midtrans</strong>. You can pay with Credit/Debit Card, Bank Transfer, E-Wallet, and more.
            </p>
        </div>
    </div>
</div>

{{-- Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
function setAmount(amount) {
    document.getElementById('amount').value = amount;
}

document.getElementById('topupForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const amount = document.getElementById('amount').value;
    const button = document.getElementById('payButton');

    // Disable button
    button.disabled = true;
    button.innerHTML = '<i class="ri-loader-4-line text-xl animate-spin"></i> <span>Processing...</span>';

    // Call backend to get Snap token
    fetch('{{ route("wallet.topup.process") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ amount: parseInt(amount) })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            button.disabled = false;
            button.innerHTML = '<i class="ri-secure-payment-line text-xl"></i> <span>Proceed to Payment</span>';
            return;
        }

        // Open Midtrans Snap popup
        window.snap.pay(data.snap_token, {
            onSuccess: function(result) {
                window.location.href = '{{ route("wallet.success") }}';
            },
            onPending: function(result) {
                window.location.href = '{{ route("wallet.pending") }}';
            },
            onError: function(result) {
                window.location.href = '{{ route("wallet.error") }}';
            },
            onClose: function() {
                button.disabled = false;
                button.innerHTML = '<i class="ri-secure-payment-line text-xl"></i> <span>Proceed to Payment</span>';
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to initialize payment. Please try again.');
        button.disabled = false;
        button.innerHTML = '<i class="ri-secure-payment-line text-xl"></i> <span>Proceed to Payment</span>';
    });
});
</script>
</x-layout>
