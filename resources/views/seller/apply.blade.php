<x-layout>
    <div class="min-h-screen p-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('buyer.dashboard') }}" class="text-purple-400 hover:text-purple-300 transition-colors mb-4 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Become a Seller</h1>
                <p class="text-gray-400">Fill out the form below to apply as a seller on our platform</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg">
                    <p class="text-red-400 font-semibold mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-red-400 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Application Form -->
            <form action="{{ route('seller.apply.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Legal Information -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/20 p-6">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <span>📋</span>
                        Legal Information
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label for="legal_name" class="block text-gray-300 font-medium mb-2">Legal Name *</label>
                            <input type="text"
                                   id="legal_name"
                                   name="legal_name"
                                   value="{{ old('legal_name') }}"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('legal_name') border-red-500 @enderror"
                                   placeholder="Full name as on ID card"
                                   required>
                            @error('legal_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_card_number" class="block text-gray-300 font-medium mb-2">ID Card Number (NIK) *</label>
                            <input type="text"
                                   id="id_card_number"
                                   name="id_card_number"
                                   value="{{ old('id_card_number') }}"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('id_card_number') border-red-500 @enderror"
                                   placeholder="16-digit NIK"
                                   maxlength="20"
                                   required>
                            @error('id_card_number')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_card_photo" class="block  text-gray-300 font-medium mb-2">ID Card Photo *</label>
                            <input type="file"
                                   id="id_card_photo"
                                   name="id_card_photo"
                                   accept="image/jpeg,image/png,image/jpg"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white file:ml-0.5 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-600 file:text-white hover:file:bg-purple-700 file:cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-500 @error('id_card_photo') border-red-500 @enderror"
                                   required>
                            <p class="text-gray-400 text-sm mt-1">Upload a clear photo of your ID card (max 2MB)</p>
                            @error('id_card_photo')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Bank Information -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/20 p-6">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <span>🏦</span>
                        Bank Information
                    </h2>
                    <p class="text-gray-400 text-sm mb-4">This information will be used for payouts</p>

                    <div class="space-y-4">
                        <div>
                            <label for="bank_name" class="block text-gray-300 font-medium mb-2">Bank Name *</label>
                            <select id="bank_name"
                                    name="bank_name"
                                    class="w-full px-4 py-3 bg-gray-800 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('bank_name') border-red-500 @enderror"
                                    required>
                                <option value="" class="bg-gray-800 text-white">Select your bank</option>
                                <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }} class="bg-gray-800 text-white">BCA</option>
                                <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }} class="bg-gray-800 text-white">Mandiri</option>
                                <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }} class="bg-gray-800 text-white">BNI</option>
                                <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }} class="bg-gray-800 text-white">BRI</option>
                                <option value="CIMB Niaga" {{ old('bank_name') == 'CIMB Niaga' ? 'selected' : '' }} class="bg-gray-800 text-white">CIMB Niaga</option>
                                <option value="Permata" {{ old('bank_name') == 'Permata' ? 'selected' : '' }} class="bg-gray-800 text-white">Permata</option>
                                <option value="Danamon" {{ old('bank_name') == 'Danamon' ? 'selected' : '' }} class="bg-gray-800 text-white">Danamon</option>
                                <option value="BSI" {{ old('bank_name') == 'BSI' ? 'selected' : '' }} class="bg-gray-800 text-white">BSI (Bank Syariah Indonesia)</option>
                                <option value="Other" {{ old('bank_name') == 'Other' ? 'selected' : '' }} class="bg-gray-800 text-white">Other</option>
                            </select>
                            @error('bank_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bank_account_number" class="block text-gray-300 font-medium mb-2">Bank Account Number *</label>
                            <input type="text"
                                   id="bank_account_number"
                                   name="bank_account_number"
                                   value="{{ old('bank_account_number') }}"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('bank_account_number') border-red-500 @enderror"
                                   placeholder="Your bank account number"
                                   maxlength="30"
                                   required>
                            @error('bank_account_number')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bank_account_name" class="block text-gray-300 font-medium mb-2">Bank Account Name *</label>
                            <input type="text"
                                   id="bank_account_name"
                                   name="bank_account_name"
                                   value="{{ old('bank_account_name') }}"
                                   class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('bank_account_name') border-red-500 @enderror"
                                   placeholder="Account holder name"
                                   maxlength="100"
                                   required>
                            <p class="text-gray-400 text-sm mt-1">Must match the name on your bank account</p>
                            @error('bank_account_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Terms & Submit -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg border border-white/20 p-6">
                    <div class="flex items-start gap-3 mb-6">
                        <input type="checkbox"
                               id="terms"
                               required
                               class="mt-1 w-5 h-5 rounded border-white/20 bg-white/5 text-purple-600 focus:ring-2 focus:ring-purple-500">
                        <label for="terms" class="text-gray-300 text-sm">
                            I agree to the <a href="#" class="text-purple-400 hover:underline">Terms & Conditions</a> and confirm that all information provided is accurate and truthful. I understand that my application will be reviewed by administrators and may be rejected if the information is found to be false.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-200 shadow-lg hover:shadow-purple-500/50">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
