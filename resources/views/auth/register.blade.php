<x-layout>
    <div class="relative min-h-screen overflow-x-hidden bg-linear-to-br from-dark via-dark-purple to-dark flex items-center justify-center py-8">

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <!-- Card Register -->
        <div class="relative z-10 w-[900px] mt-15 rounded-2xl flex overflow-hidden shadow-2xl glass-effect animate-slide-in">

            <!-- Kiri (Poster / Gambar) -->
            <div class="relative w-1/2 group bg-image-dim">
                <div class="absolute inset-0 bg-purple-600/25 group-hover:opacity-40 transition-opacity duration-500 z-10 flex items-center justify-center">
                    <img src="{{ asset('images/icons/logo.png') }}" alt=""class="opacity-30">
                </div>

                <!-- Overlay Text -->
                <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center z-20">
                    <div class="mb-6">
                        <i class="ri-user-add-line text-6xl text-white drop-shadow-lg"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4 drop-shadow-lg">Join Our Community</h3>
                    <p class="text-white/90 text-sm drop-shadow-md">Start your gaming journey with us today</p>
                </div>
            </div>

            <!-- Kanan (Form Registrasi) -->
            <div class="w-1/2 p-12 text-white bg-linear-to-br from-[#2C1450] to-[#1a0b2e]">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">Create Account</h2>
                        <p class="text-sm text-gray-300 mt-1">Sign up to get started</p>
                    </div>
                    <a href="{{ route('home') }}" class="group">
                        <i class="ri-close-line text-3xl text-gray-400 hover:text-secondary transition-all duration-300 group-hover:rotate-90"></i>
                    </a>
                </div>


                <form class="space-y-4" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div>
                        <label for="username" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                            <i class="ri-user-line"></i>
                            Username
                        </label>
                        <input id="username" name="username" type="text" required
                            value="{{ old('username') }}"
                            placeholder="Enter your username"
                            class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                    </div>

                    <div>
                        <label for="email" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                            <i class="ri-mail-line"></i>
                            Email
                        </label>
                        <input id="email" name="email" type="email" required
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                    </div>

                    <div>
                        <label for="phone" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                            <i class="ri-phone-line"></i>
                            No. HP <span class="text-xs text-gray-400">(Optional)</span>
                        </label>
                        <input id="phone" name="phone" type="text"
                            value="{{ old('phone') }}"
                            placeholder="Enter your phone number"
                            class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                    </div>

                    <div>
                        <label for="password" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                            <i class="ri-lock-line"></i>
                            Password
                        </label>
                        <input id="password" name="password" type="password" required
                            placeholder="Enter your password"
                            class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                        <p class="text-xs text-gray-400 mt-1">Minimal 6 characters</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="text-sm font-medium text-gray-300 flex items-center gap-2 mb-2">
                            <i class="ri-lock-password-line"></i>
                            Confirm Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            placeholder="Confirm your password"
                            class="w-full p-4 rounded-xl bg-[#1C093C]/60 border border-white/10 placeholder-gray-500 text-white focus:outline-none focus:border-primary transition-all duration-300 input-glow">
                    </div>

                    <button type="submit"
                            class="w-full p-4 rounded-xl bg-linear-to-r from-purple-500 to-pink-500 font-bold text-white shadow-lg hover:shadow-purple-500/50 transform hover:scale-[1.02] transition-all duration-300 relative overflow-hidden group">
                        <span class="relative z-10">Sign Up</span>
                        <div class="absolute inset-0 bg-linear-to-r from-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </form>

                <p class="mt-8 text-sm text-center text-gray-300">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-semibold transition-colors">Login Here</a>
                </p>
            </div>
        </div>

        {{-- <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-4xl font-extrabold text-white">
                    Daftar Akun Baru
                </h2>
                <p class="mt-2 text-center text-sm text-gray-300">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-purple-400 hover:text-purple-300">
                        Login di sini
                    </a>
                </p>
            </div>



            <form class="mt-8 space-y-6" action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                        <input id="username" name="username" type="text" required
                            value="{{ old('username') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-600 bg-gray-800/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-600 bg-gray-800/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">No. HP (Opsional)</label>
                        <input id="phone" name="phone" type="tel"
                            value="{{ old('phone') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-600 bg-gray-800/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-600 bg-gray-800/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-400">Minimal 6 karakter</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-600 bg-gray-800/50 placeholder-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
                        Daftar
                    </button>
                </div>
            </form>
        </div> --}}


    </div>
</x-layout>
