<x-layout>
    <div class="min-h-screen px-4 py-8 mx-auto max-w-4xl lg:px-6">

        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 mb-4 text-sm transition border rounded-full bg-white/10 hover:bg-white/20 border-white/20">
                <i class="ri-arrow-left-line"></i>
                <span>Back to Users</span>
            </a>
            <h1 class="text-3xl font-bold">
                <i class="mr-2 ri-user-add-line text-[#8a2be2]"></i>
                Create New User
            </h1>
        </div>

        <!-- Form -->
        <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Username -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">Username *</label>
                        <input type="text"
                               name="username"
                               value="{{ old('username') }}"
                               required
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                               placeholder="Enter username">
                        @error('username')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">Full Name *</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                               placeholder="Enter full name">
                        @error('name')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-300">Email *</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                           placeholder="Enter email address">
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-300">Role *</label>
                    <select name="role_user"
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition">
                        <option value="">Select Role</option>
                        <option value="buyer" {{ old('role_user') === 'buyer' ? 'selected' : '' }}>Buyer</option>
                        <option value="seller" {{ old('role_user') === 'seller' ? 'selected' : '' }}>Seller</option>
                        <option value="admin" {{ old('role_user') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role_user')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Password -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">Password *</label>
                        <input type="password"
                               name="password"
                               required
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                               placeholder="Enter password">
                        @error('password')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">Confirm Password *</label>
                        <input type="password"
                               name="password_confirmation"
                               required
                               class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition"
                               placeholder="Confirm password">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                            class="flex-1 px-6 py-3 font-semibold text-white transition rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:scale-105">
                        <i class="mr-2 ri-save-line"></i>
                        Create User
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-3 font-semibold text-white transition border rounded-xl border-white/20 hover:bg-white/10">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-layout>
