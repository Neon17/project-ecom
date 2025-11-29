<x-layouts.admin>
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Coupon</h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Update coupon details</p>
                </div>
                <a href="{{ route('admin.coupons.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    ← Back to Coupons
                </a>
            </div>
        </div>

        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST"
            class="bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Usage Stats -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-300 mb-2">Usage Statistics</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-blue-700 dark:text-blue-400">Times Used:</span>
                            <span class="ml-2 font-bold text-blue-900 dark:text-blue-200">{{ $coupon->used_count }}</span>
                        </div>
                        <div>
                            <span class="text-blue-700 dark:text-blue-400">Created:</span>
                            <span class="ml-2 font-bold text-blue-900 dark:text-blue-200">{{ $coupon->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Coupon Code -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Coupon Code <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}" required
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white font-mono uppercase"
                        placeholder="SAVE20">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type and Value -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Discount Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white"
                            onchange="updateValueLabel()">
                            <option value="percentage" {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>Fixed Amount (NPR)</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <span id="value-label">{{ $coupon->type === 'percentage' ? 'Discount Value (%)' : 'Discount Value (NPR)' }}</span> <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="value" id="value" value="{{ old('value', $coupon->value) }}" required
                            step="0.01" min="0"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                        @error('value')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Min Purchase and Max Uses -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="min_purchase" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Minimum Purchase (NPR)
                        </label>
                        <input type="number" name="min_purchase" id="min_purchase" 
                            value="{{ old('min_purchase', $coupon->min_purchase ? $coupon->min_purchase / 100 : '') }}"
                            step="0.01" min="0"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Leave empty for no minimum</p>
                        @error('min_purchase')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_uses" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Maximum Uses
                        </label>
                        <input type="number" name="max_uses" id="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}"
                            min="1"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Total uses across all customers</p>
                        @error('max_uses')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Expiration Date -->
                <div>
                    <label for="expires_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Expiration Date
                    </label>
                    <input type="datetime-local" name="expires_at" id="expires_at" 
                        value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:text-white">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Leave empty for no expiration</p>
                    @error('expires_at')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active (customers can use this coupon)</span>
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 dark:bg-slate-800 px-6 py-4 border-t border-gray-200 dark:border-slate-700 rounded-b-lg">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.coupons.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-900 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Update Coupon
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateValueLabel() {
            const type = document.getElementById('type').value;
            const label = document.getElementById('value-label');
            
            label.textContent = type === 'percentage' ? 'Discount Value (%)' : 'Discount Value (NPR)';
        }

        document.getElementById('code').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>
</x-layouts.admin>
