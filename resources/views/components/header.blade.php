<!-- Top Message -->
<div class="bg-[#140532] text-center py-2 text-xs font-small text-orange-400">
  🌟 Help us to make FRYN Better 🌟
</div>

<nav class="bg-[#11042A] shadow-md px-4 py-2 text-white">
  <div class="max-w-6xl mx-auto">
    <!-- Top Row: Logo & Right Side -->
    <div class="flex items-center justify-between my-4">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
      <img src="{{ asset('images/icons/logo.png') }}" alt="Logo" class="h-12 w-auto" />
      <span class="text-xl font-bold bg-linear-to-r from-yellow-500 via-orange-400 to-purple-500 bg-clip-text text-transparent">FRYN.COM</span>
    </a>

    <!-- Right Side -->
    <div class="flex items-center space-x-4">
      @auth
        @if(auth()->user()->role_user === 'seller' && auth()->user()->seller && auth()->user()->seller->verification_status === 'verified')
          <a href="{{ route('seller.products.create') }}" class="bg-purple-500 text-white px-4 py-3 rounded-xl hover:bg-purple-800 text-sm font-semibold">
            Sell Item
          </a>
        @elseif(auth()->user()->seller && auth()->user()->seller->verification_status === 'pending')
          <span class="bg-yellow-600/20 border border-yellow-600 text-yellow-400 px-4 py-3 rounded-xl text-sm font-semibold cursor-not-allowed">
            Pending Verification
          </span>
        @else
          <a href="{{ route('seller.apply') }}" class="bg-purple-500 text-white px-4 py-3 rounded-xl hover:bg-purple-800 text-sm font-semibold">
            Sell Item
          </a>
        @endif
        <a href="#" class="px-2 py-1.5 m-1 rounded-xl hover:bg-purple-600/20 transition">
          <i class="ri-message-2-line text-2xl"></i>
        </a>
        <a href="#" class="px-2 py-1.5 m-1 rounded-xl hover:bg-purple-600/20 transition">
          <i class="ri-notification-3-line text-2xl"></i>
        </a>

        <!-- User Dropdown -->
        <div class="relative group">
          <button class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-purple-600/20 transition">
            <i class="ri-user-line text-2xl"></i>
            <span class="text-sm">{{ auth()->user()->username }}</span>
            <i class="ri-arrow-down-s-line"></i>
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-[#1a0b2e] border border-purple-600/30 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 hover:bg-purple-600/20 transition">
              <i class="ri-dashboard-line mr-2"></i>Dashboard
            </a>
            <a href="{{ route('wallet.index') }}" class="block px-4 py-3 hover:bg-purple-600/20 transition">
              <i class="ri-wallet-line mr-2"></i>Wallet: Rp {{ number_format(auth()->user()->wallet->balance ?? 0, 0, ',', '.') }}
            </a>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-3 hover:bg-purple-600/20 transition text-red-400">
                <i class="ri-logout-box-line mr-2"></i>Logout
              </button>
            </form>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="bg-purple-500 text-white px-4 py-3 rounded-xl hover:bg-purple-800 text-sm font-semibold">
          Login
        </a>
        <a href="{{ route('register') }}" class="px-4 py-3 rounded-xl border border-purple-500 hover:bg-purple-600/20 text-sm font-semibold transition">
          Register
        </a>
      @endauth
    </div>
    </div>

  <!-- Bottom Row: Center Menu -->
  <div class="max-w-6xl mx-auto">
    <ul class="flex">
      <li><a href="{{ route('products.account') }}" class="hover:text-orange-300 border-b-2 border-transparent hover:border-orange-300 hover:bg-purple-800/5 p-4 px-8 transition inline-block {{ request()->is('account') ? 'border-orange-300 text-orange-300' : '' }}"><i class="ri-account-box-line text-xl"></i> Account</a></li>
      <li><a href="{{ route('products.ingame') }}" class="hover:text-orange-300 border-b-2 border-transparent hover:border-orange-300 hover:bg-purple-800/5 p-4 px-8 transition inline-block {{ request()->is('in-game-items') ? 'border-orange-300 text-orange-300' : '' }}"><i class="ri-sword-line text-xl"></i> In-Game Items</a></li>
      <li><a href="{{ route('products.topup') }}" class="hover:text-orange-300 border-b-2 border-transparent hover:border-orange-300 hover:bg-purple-800/5 p-4 px-8 transition inline-block {{ request()->is('top-up') ? 'border-orange-300 text-orange-300' : '' }}"><i class="ri-wallet-line text-xl"></i> Top-ups</a></li>
    </ul>
  </div>
</nav>
