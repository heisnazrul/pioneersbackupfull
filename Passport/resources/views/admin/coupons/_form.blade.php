@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="form-group">
        <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
        <input type="text" name="code" id="code" value="{{ old('code', $coupon->code ?? '') }}" maxlength="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('code')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $coupon->name ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="form-group">
        <label for="discount_type" class="block text-sm font-medium text-gray-700">Discount Type</label>
        <select name="discount_type" id="discount_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            @php
                $selectedType = old('discount_type', $coupon->discount_type ?? 'percent');
            @endphp
            <option value="percent" {{ $selectedType === 'percent' ? 'selected' : '' }}>Percent</option>
            <option value="flat" {{ $selectedType === 'flat' ? 'selected' : '' }}>Flat</option>
        </select>
        @error('discount_type')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="discount_value" class="block text-sm font-medium text-gray-700">Discount Value</label>
        <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value', $coupon->discount_value ?? '') }}" step="0.01" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <p class="text-xs text-gray-500 mt-1">Percent example: 20 = 20%. Flat example: 30 = 30.00 currency.</p>
        @error('discount_value')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="minimum_purchase_amount" class="block text-sm font-medium text-gray-700">Minimum Purchase (optional)</label>
        <input type="number" name="minimum_purchase_amount" id="minimum_purchase_amount" value="{{ old('minimum_purchase_amount', $coupon->minimum_purchase_amount ?? '') }}" step="0.01" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('minimum_purchase_amount')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="form-group">
        <label for="usage_limit" class="block text-sm font-medium text-gray-700">Usage Limit</label>
        <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit ?? 1) }}" min="1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('usage_limit')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="used_count" class="block text-sm font-medium text-gray-700">Used Count</label>
        <input type="number" name="used_count" id="used_count" value="{{ old('used_count', $coupon->used_count ?? 0) }}" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('used_count')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="expiration_date" class="block text-sm font-medium text-gray-700">Expiration Date</label>
        <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date', isset($coupon) && $coupon->expiration_date ? $coupon->expiration_date->format('Y-m-d') : '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('expiration_date')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="flex items-center gap-3">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1" id="is_active" class="rounded border-gray-300 text-primary focus:ring-primary" {{ old('is_active', isset($coupon) ? ($coupon->is_active ? '1' : '0') : '1') === '1' ? 'checked' : '' }}>
    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
</div>
