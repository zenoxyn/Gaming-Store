<x-layout title="Create Category - Admin">
    <div class="min-h-screen py-8 bg-linear-to-b from-[#1a0b2e] via-[#160b28] to-[#0d0221]">
        <div class="container px-4 mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center mb-4 text-gray-400 transition hover:text-white">
                    <i class="mr-2 fas fa-arrow-left"></i>Back to Categories
                </a>
                <h1 class="text-3xl font-bold text-white">Create New Category</h1>
                <p class="mt-2 text-gray-400">Add a new game category with custom specification template</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Basic Info Card -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-6 text-xl font-bold text-white">Basic Information</h3>

                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Category Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="e.g., Genshin Impact">
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Slug (URL-friendly name)</label>
                            <input type="text" name="slug" value="{{ old('slug') }}"
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="Auto-generated if empty">
                            <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from name</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon Upload -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Category Icon</label>
                            <div class="flex items-start gap-4">
                                <div id="iconPreview" class="flex items-center justify-center w-24 h-24 text-3xl border-2 border-dashed rounded-lg border-[#8a2be2]/30 bg-[#1a0b2e]">
                                    🎮
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="icon" id="iconInput" accept="image/jpeg,image/jpg,image/png,image/webp"
                                           class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                           onchange="previewIcon(event)">
                                    <p class="mt-1 text-xs text-gray-500">Max 2MB. Formats: JPG, PNG, WEBP</p>
                                    @error('icon')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Description</label>
                            <textarea name="description" rows="3"
                                      class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                      placeholder="Brief description of this category...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Spec Template Card -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-white">Specification Template</h3>
                            <p class="mt-1 text-sm text-gray-400">Define custom fields for products in this category</p>
                        </div>
                        <button type="button" onclick="addSpecField()" class="px-4 py-2 text-sm font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                            <i class="mr-2 fas fa-plus"></i>Add Field
                        </button>
                    </div>

                    <div id="specFieldsContainer" class="space-y-4">
                        <!-- Spec fields will be added here dynamically -->
                    </div>

                    <input type="hidden" name="spec_template" id="specTemplateInput">
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-4">
                    <button type="submit" class="px-8 py-3 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                        <i class="mr-2 fas fa-save"></i>Create Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="px-8 py-3 font-semibold text-gray-400 transition border rounded-lg border-[#8a2be2]/30 hover:bg-white/5">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let specFields = [];

        function addSpecField() {
            const fieldId = Date.now();
            const field = {
                id: fieldId,
                key: '',
                label: '',
                type: 'text',
                options: []
            };
            specFields.push(field);
            renderSpecFields();
        }

        function removeSpecField(fieldId) {
            specFields = specFields.filter(f => f.id !== fieldId);
            renderSpecFields();
        }

        function updateSpecField(fieldId, property, value) {
            const field = specFields.find(f => f.id === fieldId);
            if (field) {
                field[property] = value;
                updateHiddenInput();
            }
        }

        function renderSpecFields() {
            const container = document.getElementById('specFieldsContainer');

            if (specFields.length === 0) {
                container.innerHTML = `
                    <div class="py-8 text-center text-gray-500">
                        <i class="mb-2 text-4xl fas fa-inbox"></i>
                        <p>No specification fields yet. Click "Add Field" to create one.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = specFields.map(field => `
                <div class="p-4 border rounded-lg border-[#8a2be2]/20 bg-white/5">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-3">
                            <label class="block mb-2 text-xs font-semibold text-gray-400">Field Key</label>
                            <input type="text" value="${field.key}"
                                   onchange="updateSpecField(${field.id}, 'key', this.value)"
                                   class="w-full px-3 py-2 text-sm text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30"
                                   placeholder="e.g., server">
                        </div>
                        <div class="col-span-4">
                            <label class="block mb-2 text-xs font-semibold text-gray-400">Display Label</label>
                            <input type="text" value="${field.label}"
                                   onchange="updateSpecField(${field.id}, 'label', this.value)"
                                   class="w-full px-3 py-2 text-sm text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30"
                                   placeholder="e.g., Server Region">
                        </div>
                        <div class="col-span-3">
                            <label class="block mb-2 text-xs font-semibold text-gray-400">Field Type</label>
                            <select onchange="updateSpecField(${field.id}, 'type', this.value)"
                                    class="w-full px-3 py-2 text-sm text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30">
                                <option value="text" ${field.type === 'text' ? 'selected' : ''}>Text</option>
                                <option value="number" ${field.type === 'number' ? 'selected' : ''}>Number</option>
                                <option value="select" ${field.type === 'select' ? 'selected' : ''}>Select</option>
                                <option value="textarea" ${field.type === 'textarea' ? 'selected' : ''}>Textarea</option>
                            </select>
                        </div>
                        <div class="flex items-end col-span-2">
                            <button type="button" onclick="removeSpecField(${field.id})"
                                    class="w-full px-3 py-2 text-sm text-red-400 transition border rounded-lg border-red-400/30 hover:bg-red-400/10">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    ${field.type === 'select' ? `
                        <div class="mt-3">
                            <label class="block mb-2 text-xs font-semibold text-gray-400">Options (comma-separated)</label>
                            <input type="text" value="${(field.options || []).join(', ')}"
                                   onchange="updateSpecField(${field.id}, 'options', this.value.split(',').map(o => o.trim()))"
                                   class="w-full px-3 py-2 text-sm text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30"
                                   placeholder="e.g., Asia, EU, NA, OCE">
                        </div>
                    ` : ''}
                </div>
            `).join('');

            updateHiddenInput();
        }

        function updateHiddenInput() {
            const cleanFields = specFields.map(f => ({
                key: f.key,
                label: f.label,
                type: f.type,
                ...(f.type === 'select' && f.options ? { options: f.options } : {})
            }));
            document.getElementById('specTemplateInput').value = JSON.stringify(cleanFields);
        }

        // Icon preview function
        function previewIcon(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('iconPreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="object-cover w-full h-full rounded-lg">`;
                };
                reader.readAsDataURL(file);
            }
        }

        // Initialize
        renderSpecFields();
    </script>
</x-layout>
