<x-layout title="Manage Categories - Admin">
    <div class="min-h-screen py-8">
        <div class="container px-4 mx-auto">
            <!-- Back Button -->
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center mb-6 text-gray-400 transition hover:text-white">
                <i class="mr-2 fas fa-arrow-left"></i>Back to Dashboard
            </a>

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-white">Category Management</h1>
                    <p class="text-gray-400">Manage game categories and specification templates</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                    <i class="mr-2 fas fa-plus"></i>Add Category
                </a>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="p-4 mb-6 text-green-400 border border-green-400 rounded-lg bg-green-400/10">
                <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="p-4 mb-6 text-red-400 border border-red-400 rounded-lg bg-red-400/10">
                <i class="mr-2 fas fa-exclamation-circle"></i>{{ session('error') }}
            </div>
            @endif

            <!-- Categories Table -->
            <div class="overflow-hidden border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#8a2be2]/20 border-b border-[#8a2be2]/30">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Icon</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Name</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Slug</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Products</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Spec Fields</th>
                                <th class="px-6 py-4 text-sm font-semibold text-left text-gray-300">Created</th>
                                <th class="px-6 py-4 text-sm font-semibold text-center text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#8a2be2]/20">
                            @forelse($categories as $category)
                            <tr class="transition hover:bg-white/5">
                                <td class="px-6 py-4">
                                    @if($category->icon)
                                        <img src="{{ str_starts_with($category->icon, 'http') ? $category->icon : asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="object-cover w-12 h-12 rounded-lg">
                                    @else
                                        <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-lg bg-linear-to-br from-[#8a2be2] to-[#ff1493]">
                                            🎮
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-white">{{ $category->name }}</div>
                                    @if($category->description)
                                        <div class="text-sm text-gray-400 line-clamp-1">{{ $category->description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $category->slug }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold text-blue-400 rounded-full bg-blue-400/10">
                                        {{ $category->products_count }} Products
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($category->spec_template && count($category->spec_template) > 0)
                                        <span class="px-3 py-1 text-sm font-semibold text-green-400 rounded-full bg-green-400/10">
                                            {{ count($category->spec_template) }} Fields
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">No template</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">
                                    {{ $category->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                           class="px-3 py-2 text-sm text-blue-400 transition rounded-lg hover:bg-blue-400/10">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete {{ $category->name }}? This cannot be undone!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-2 text-sm text-red-400 transition rounded-lg hover:bg-red-400/10">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-4 text-6xl fas fa-folder-open text-[#8a2be2]/30"></i>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-300">No Categories Yet</h3>
                                        <p class="mb-4 text-gray-500">Start by creating your first game category</p>
                                        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                                            <i class="mr-2 fas fa-plus"></i>Create Category
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
