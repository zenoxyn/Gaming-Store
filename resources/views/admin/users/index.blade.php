<x-layout>
    <div class="min-h-screen px-4 py-8 mx-auto max-w-7xl lg:px-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold">
                    <i class="mr-2 ri-user-settings-line text-[#8a2be2]"></i>
                    User Management
                </h1>
                <p class="mt-1 text-sm text-gray-400">Manage all users in the system</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="px-6 py-3 font-semibold text-white transition rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:scale-105">
                <i class="mr-2 ri-user-add-line"></i>
                Add New User
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="p-4 mb-6 text-green-400 bg-green-600/20 border border-green-600/50 rounded-xl flex items-center gap-2">
                <i class="ri-check-line text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-6 text-red-400 bg-red-600/20 border border-red-600/50 rounded-xl flex items-center gap-2">
                <i class="ri-error-warning-line text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filters -->
        <div class="p-6 mb-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-wrap gap-4">
                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search by username, email, name..."
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition">
                </div>

                <!-- Role Filter -->
                <select name="role"
                        class="px-4 py-3 bg-[#8a2be2]/50 border border-[#8a2be2]/50 rounded-xl text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 outline-none transition">
                    <option value="">All Roles</option>
                    <option value="buyer" {{ request('role') === 'buyer' ? 'selected' : '' }}>Buyer</option>
                    <option value="seller" {{ request('role') === 'seller' ? 'selected' : '' }}>Seller</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <!-- Buttons -->
                <button type="submit"
                        class="px-6 py-3 font-semibold text-white transition rounded-xl bg-[#8a2be2] hover:bg-[#8a2be2]/80">
                    <i class="mr-2 ri-search-line"></i>
                    Filter
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="px-6 py-3 font-semibold text-white transition border rounded-xl border-white/20 hover:bg-white/10">
                    Reset
                </a>
            </form>
        </div>

        <!-- Users Table -->
        <div class="border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#8a2be2]/20">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">ID</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">User</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Email</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Role</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Wallet</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Verified</th>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Joined</th>
                            <th class="px-6 py-4 text-sm font-semibold text-right text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($users as $user)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 text-sm text-gray-400">#{{ $user->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gradient-to-br from-[#8a2be2] to-[#ff1493]">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=8a2be2&color=fff"
                                                 alt="{{ $user->username }}"
                                                 class="object-cover w-full h-full">
                                        </div>
                                        <div>
                                            <p class="font-semibold text-white">{{ $user->username }}</p>
                                            <p class="text-xs text-gray-400">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $roleColors = [
                                            'admin' => 'bg-red-600/20 text-red-400 border-red-600/50',
                                            'seller' => 'bg-blue-600/20 text-blue-400 border-blue-600/50',
                                            'buyer' => 'bg-green-600/20 text-green-400 border-green-600/50',
                                        ];
                                        $roleColor = $roleColors[$user->role_user] ?? 'bg-gray-600/20 text-gray-400 border-gray-600/50';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold border rounded-full {{ $roleColor }}">
                                        {{ ucfirst($user->role_user) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-yellow-400">
                                    Rp {{ number_format($user->wallet->balance ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_verified)
                                        <span class="px-3 py-1 text-xs font-semibold text-green-400 border border-green-600/50 rounded-full bg-green-600/20">
                                            <i class="ri-check-line mr-1"></i>Verified
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-yellow-400 border border-yellow-600/50 rounded-full bg-yellow-600/20">
                                            <i class="ri-time-line mr-1"></i>Unverified
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Toggle Status -->
                                        <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="p-2 text-sm transition rounded-lg hover:bg-white/10"
                                                    title="{{ $user->is_verified ? 'Unverify' : 'Verify' }}">
                                                <i class="{{ $user->is_verified ? 'ri-close-circle-line text-yellow-400' : 'ri-checkbox-circle-line text-green-400' }}"></i>
                                            </button>
                                        </form>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="p-2 text-sm transition rounded-lg hover:bg-white/10"
                                           title="Edit">
                                            <i class="ri-edit-line text-blue-400"></i>
                                        </a>

                                        <!-- Delete -->
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                  method="POST"
                                                  class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 text-sm transition rounded-lg hover:bg-white/10"
                                                        title="Delete">
                                                    <i class="ri-delete-bin-line text-red-400"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                    <i class="text-6xl ri-user-line opacity-20"></i>
                                    <p class="mt-4">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->withQueryString()->links() }}
        </div>

    </div>
</x-layout>
