<x-layout>
    <div class="relative min-h-screen overflow-x-hidden bg-linear-to-br from-dark via-dark-purple to-dark flex items-center justify-center py-8">
        <div class="absolute top-8 left-1/2 transform -translate-x-1/2 w-full max-w-md px-4 z-50">
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif


            </div>

                <div>
                <div class="relative z-10 w-[900px] rounded-2xl flex overflow-hidden shadow-2xl glass-effect animate-slide-in">

                <!-- Kiri (Poster / Gambar) -->
                <div class="relative w-1/2 group bg-image-dim">
                    <div class="absolute inset-0 bg-purple-600/25 group-hover:opacity-40 transition-opacity duration-500 z-10 flex items-center justify-center">
                        <img src="{{ asset('images/icons/logo.png') }}" alt="" class="opacity-30">
                    </div>

                    <!-- Overlay Text -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center z-20">
                        <div class="mb-6">
                            <i class="ri-gamepad-line text-6xl text-white drop-shadow-lg"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-4 drop-shadow-lg">Level Up Your Game</h3>
                        <p class="text-white/90 text-sm drop-shadow-md">Join thousands of gamers in the ultimate marketplace</p>
                    </div>
                </div>

                <!-- Kanan (Form Login) -->
                <div class="w-1/2 p-12 text-white bg-linear-to-br from-[#2C1450] to-[#1a0b2e]">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">Welcome Back</h2>
                            <p class="text-sm text-gray-300 mt-1">Sign in to continue gaming</p>
                        </div>
                        <a href="{{ route('home') }}" class="group">
                            <i class="ri-close-line text-3xl text-gray-400 hover:text-secondary transition-all duration-300 group-hover:rotate-90"></i>
                        </a>
                    </div>

                    <form class="space-y-5" action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                                <i class="ri-user-line"></i>
                                Email
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                        </div>

                        <div>
                            <label for="password" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                                <i class="ri-lock-line"></i>
                                Password
                            </label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                placeholder="Enter your password"
                                class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                        </div>

                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-600 rounded bg-gray-800">
                                <label for="remember" class="ml-2 block text-sm text-gray-300">
                                    Remember me
                                </label>
                            </div>

                        <button type="submit"
                                class="w-full p-4 rounded-xl bg-linear-to-r from-purple-500/70 to-pink-500/70 font-bold text-white shadow-lg hover:shadow-purple-500/50 transform hover:scale-[1.02] transition-all duration-300 relative overflow-hidden group">
                            <span class="relative z-10">Sign In</span>
                            <div class="absolute inset-0 bg-linear-to-r from-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </form>

                    <p class="mt-8 text-sm text-center text-gray-300">
                        Dont have an account?
                        <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold transition-colors">Register</a>
                    </p>
                </div>
            </div>


            <!-- Test Accounts Info -->
            <div class="mt-6 bg-blue-500/20 border border-blue-500 rounded-lg p-4">
                <p class="text-sm font-semibold text-blue-200 mb-2">🔐 Test Accounts:</p>
                <div class="text-xs text-blue-100 space-y-1">
                    <p>Admin: admin@gamingstore.com / password</p>
                    <p>Seller: seller@example.com / password</p>
                    <p>Buyer: buyer1@example.com / password</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
