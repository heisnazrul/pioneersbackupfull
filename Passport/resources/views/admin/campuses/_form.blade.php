@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Name</label>
        <input type="text" name="name" value="{{ old('name', $campus->name ?? '') }}" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Slug <span
                class="text-xs text-gray-500">(auto)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $campus->slug ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
        <select name="university_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select University</option>
            @foreach ($universities as $id => $name)
                <option value="{{ $id }}" @selected(old('university_id', $campus->university_id ?? '') == $id)>{{ $name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">City</label>
        <select name="city_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select City</option>
            @foreach ($cities as $id => $name)
                <option value="{{ $id }}" @selected(old('city_id', $campus->city_id ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Address</label>
        <textarea name="address" rows="2"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">{{ old('address', $campus->address ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Map Coordinates</label>
        <input type="text" name="map_coordinates" value="{{ old('map_coordinates', $campus->map_coordinates ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>