@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="form-group">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $pioneersDiscount->name ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        @error('name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="ar_name" class="block text-sm font-medium text-gray-700">Arabic Name</label>
        <input type="text" name="ar_name" id="ar_name" value="{{ old('ar_name', $pioneersDiscount->ar_name ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('ar_name')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="form-group">
        <label for="weeks" class="block text-sm font-medium text-gray-700">Weeks</label>
        <input type="number" name="weeks" id="weeks" value="{{ old('weeks', $pioneersDiscount->weeks ?? '') }}" min="1" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <p class="text-xs text-gray-500 mt-1">Duration in weeks (e.g. 4, 8, 12).</p>
        @error('weeks')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="discount_amount" class="block text-sm font-medium text-gray-700">Discount Amount</label>
        <input type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount', $pioneersDiscount->discount_amount ?? '') }}" step="0.01" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <p class="text-xs text-gray-500 mt-1">Optional fixed amount (e.g. 30.00).</p>
        @error('discount_amount')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="form-group">
        <label for="discount_full_for" class="block text-sm font-medium text-gray-700">Discount Full For</label>
        <input type="text" name="discount_full_for" id="discount_full_for" value="{{ old('discount_full_for', $pioneersDiscount->discount_full_for ?? '') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <p class="text-xs text-gray-500 mt-1">Optional note (e.g. Pickup fee, IELTS fee).</p>
        @error('discount_full_for')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
    </div>
</div>

<div class="flex items-center gap-3 mt-4">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" name="is_active" value="1" id="is_active" class="rounded border-gray-300 text-primary focus:ring-primary" {{ old('is_active', isset($pioneersDiscount) ? ($pioneersDiscount->is_active ? '1' : '0') : '1') === '1' ? 'checked' : '' }}>
    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
</div>
