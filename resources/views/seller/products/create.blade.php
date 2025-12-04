<x-layout title="Add Product - Seller">
    <div class="min-h-screen py-8">
        <div class="container px-4 mx-auto max-w-4xl">
            <!-- Back Button -->
            <a href="{{ route('seller.products.index') }}" class="inline-flex items-center mb-6 text-gray-400 transition hover:text-white">
                <i class="mr-2 fas fa-arrow-left"></i>Back to My Products
            </a>

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">Add New Product</h1>
                <p class="mt-2 text-gray-400">Create a new product listing for your store</p>
            </div>

            <!-- Form -->
            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Basic Info -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-6 text-xl font-bold text-white">Basic Information</h3>

                    <div class="space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Product Name *</label>
                            <input type="text" name="name_product" value="{{ old('name_product') }}" required
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="e.g., Genshin Impact AR55 Account">
                            @error('name_product')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category & Type -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-300">Category *</label>
                                <select name="id_category" id="categorySelect" required onchange="loadSpecTemplate()"
                                        class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-template='@json($category->spec_template)'>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-300">Product Type *</label>
                                <select name="type_product" required
                                        class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none">
                                    <option value="">Select Type</option>
                                    <option value="account">Game Account</option>
                                    <option value="topup">Top-Up / Currency</option>
                                    <option value="ingame_item">In-Game Item</option>
                                </select>
                                @error('type_product')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Description *</label>
                            <textarea name="description" rows="4" required
                                      class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                      placeholder="Detailed description of your product...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-6 text-xl font-bold text-white">Pricing & Stock</h3>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Price (Rp) *</label>
                            <input type="number" name="price" id="priceInput" value="{{ old('price') }}" required min="0" step="1000"
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="50000" onkeyup="calculateFinalPrice()">
                            @error('price')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Discount Price (Rp)</label>
                            <input type="number" name="discount_price" id="discountInput" value="{{ old('discount_price') }}" min="0" step="1000"
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="45000" onkeyup="calculateFinalPrice()">
                            <p class="mt-1 text-xs text-gray-500">Optional discount price</p>
                            @error('discount_price')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-300">Stock *</label>
                            <input type="number" name="stock" value="{{ old('stock', 1) }}" required min="0"
                                   class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30 focus:border-[#8a2be2] focus:outline-none"
                                   placeholder="1">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Price Calculator Display -->
                    <div id="priceCalculator" class="hidden p-4 mt-4 border rounded-lg bg-[#1a0b2e]/50 border-[#8a2be2]/20">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-400">Original Price:</span>
                            <span id="originalPrice" class="font-semibold text-white">Rp 0</span>
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-400">Discount:</span>
                            <span id="discountPercent" class="font-semibold text-red-400">0%</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-[#8a2be2]/20">
                            <span class="font-semibold text-white">Final Price:</span>
                            <span id="finalPrice" class="text-xl font-bold text-yellow-400">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- Product Images -->
                <div class="p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-6 text-xl font-bold text-white">Product Images</h3>

                    <!-- Drag & Drop Area -->
                    <div id="dropZone" class="relative border-2 border-dashed rounded-lg border-[#8a2be2]/30 bg-[#1a0b2e]/50 p-8 text-center transition hover:border-[#8a2be2] hover:bg-[#1a0b2e]/80">
                        <input type="file" name="images[]" id="imageInput" accept="image/*" multiple class="hidden"
                               onchange="handleFiles(this.files)">
                        <div class="pointer-events-none">
                            <i class="mb-4 text-5xl fas fa-cloud-upload-alt text-[#8a2be2]/50"></i>
                            <p class="mb-2 text-lg font-semibold text-white">Drag & Drop Images Here</p>
                            <p class="mb-4 text-sm text-gray-400">or click to browse</p>
                            <p class="text-xs text-gray-500">Support: JPG, PNG, WEBP (Max 2MB each)</p>
                        </div>
                    </div>

                    @error('images.*')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview -->
                    <div id="imagePreviewContainer" class="grid grid-cols-4 gap-4 mt-4"></div>
                </div>

                <!-- Dynamic Specifications -->
                <div id="specContainer" class="hidden p-6 border rounded-2xl bg-[#2d1b4e]/90 border-[#8a2be2]/30">
                    <h3 class="mb-6 text-xl font-bold text-white">Product Specifications</h3>
                    <div id="specFields" class="grid grid-cols-2 gap-4"></div>
                </div>

                <input type="hidden" name="product_details" id="productDetailsInput">

                <!-- Submit -->
                <div class="flex gap-4">
                    <button type="submit" class="px-8 py-3 font-semibold text-white transition rounded-lg bg-linear-to-r from-[#8a2be2] to-[#ff1493] hover:opacity-90">
                        <i class="mr-2 fas fa-save"></i>Create Product
                    </button>
                    <a href="{{ route('seller.products.index') }}" class="px-8 py-3 font-semibold text-gray-400 transition border rounded-lg border-[#8a2be2]/30 hover:bg-white/5">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let specTemplate = [];
        let selectedFiles = [];

        // Drag & Drop functionality
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('imageInput');

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-[#8a2be2]', 'bg-[#8a2be2]/10');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-[#8a2be2]', 'bg-[#8a2be2]/10');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-[#8a2be2]', 'bg-[#8a2be2]/10');
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            selectedFiles = Array.from(files);
            previewImages();
        }

        function previewImages() {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative h-24 overflow-hidden border-2 rounded-lg border-[#8a2be2]/30 group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="object-cover w-full h-full">
                        <button type="button" onclick="removeImage(${index})"
                                class="absolute flex items-center justify-center w-6 h-6 transition bg-red-600 rounded opacity-0 top-1 right-1 hover:bg-red-700 group-hover:opacity-100">
                            <i class="text-xs text-white fas fa-times"></i>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 px-2 py-1 text-xs text-center text-white bg-black/70">
                            ${(file.size / 1024 / 1024).toFixed(2)} MB
                        </div>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            // Update file input
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            previewImages();
        }

        // Price Calculator
        function calculateFinalPrice() {
            const price = parseFloat(document.getElementById('priceInput').value) || 0;
            const discount = parseFloat(document.getElementById('discountInput').value) || 0;
            const calculator = document.getElementById('priceCalculator');

            if (price > 0) {
                calculator.classList.remove('hidden');

                const finalPrice = discount > 0 && discount < price ? discount : price;
                const discountPercent = discount > 0 && discount < price
                    ? Math.round(((price - discount) / price) * 100)
                    : 0;

                document.getElementById('originalPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
                document.getElementById('discountPercent').textContent = discountPercent + '%';
                document.getElementById('finalPrice').textContent = 'Rp ' + finalPrice.toLocaleString('id-ID');
            } else {
                calculator.classList.add('hidden');
            }
        }

        function loadSpecTemplate() {
            const select = document.getElementById('categorySelect');
            const option = select.options[select.selectedIndex];
            const template = option.getAttribute('data-template');

            if (template && template !== 'null') {
                specTemplate = JSON.parse(template);
                renderSpecFields();
                document.getElementById('specContainer').classList.remove('hidden');
            } else {
                specTemplate = [];
                document.getElementById('specContainer').classList.add('hidden');
            }
        }

        function renderSpecFields() {
            const container = document.getElementById('specFields');

            container.innerHTML = specTemplate.map(field => {
                let inputHtml = '';

                if (field.type === 'select') {
                    inputHtml = `
                        <select id="spec_${field.key}" class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30" onchange="updateProductDetails()">
                            <option value="">Select ${field.label}</option>
                            ${field.options.map(opt => `<option value="${opt}">${opt}</option>`).join('')}
                        </select>
                    `;
                } else if (field.type === 'textarea') {
                    inputHtml = `<textarea id="spec_${field.key}" rows="3" class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30" placeholder="Enter ${field.label}" onchange="updateProductDetails()"></textarea>`;
                } else if (field.type === 'number') {
                    inputHtml = `<input type="number" id="spec_${field.key}" class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30" placeholder="Enter ${field.label}" onchange="updateProductDetails()">`;
                } else {
                    inputHtml = `<input type="text" id="spec_${field.key}" class="w-full px-4 py-3 text-white border rounded-lg bg-[#1a0b2e] border-[#8a2be2]/30" placeholder="Enter ${field.label}" onchange="updateProductDetails()">`;
                }

                return `
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-300">${field.label}</label>
                        ${inputHtml}
                    </div>
                `;
            }).join('');
        }

        function updateProductDetails() {
            const details = {};
            specTemplate.forEach(field => {
                const value = document.getElementById(`spec_${field.key}`)?.value;
                if (value) {
                    details[field.key] = value;
                }
            });
            document.getElementById('productDetailsInput').value = JSON.stringify(details);
        }
    </script>
</x-layout>
