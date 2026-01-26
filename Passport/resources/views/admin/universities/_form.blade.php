@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Name</label>
        <input type="text" name="name" value="{{ old('name', $university->name ?? '') }}" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Slug <span
                class="text-xs text-gray-500">(leave blank to auto-generate)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $university->slug ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Country</label>
        <select name="country_id" id="country_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select a country</option>
            @foreach ($countries as $id => $country)
                <option value="{{ $id }}" @selected(old('country_id', $university->country_id ?? '') == $id)>{{ $country }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">City</label>
        <select name="city_id" id="city_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select a city</option>
            @foreach ($cities as $id => $city)
                <option value="{{ $id }}" @selected(old('city_id', $university->city_id ?? '') == $id)>{{ $city }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Type</label>
        <select name="type" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="public" @selected(old('type', $university->type ?? '') === 'public')>Public</option>
            <option value="private" @selected(old('type', $university->type ?? '') === 'private')>Private</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Established Year</label>
        <input type="number" name="established_year"
            value="{{ old('established_year', $university->established_year ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent"
            min="1000" max="{{ now()->year }}">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Overall Rank</label>
        <input type="number" name="rank" value="{{ old('rank', $university->rank ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Website</label>
        <input type="url" name="website" value="{{ old('website', $university->website ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>

    <div class="flex items-end gap-5">
        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $university->is_active ?? true))
                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <span class="text-sm font-medium text-gray-700 dark:text-white/80">Active</span>
            </label>
        </div>
        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $university->is_featured ?? false))
                    class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                <span class="text-sm font-medium text-gray-700 dark:text-white/80">Featured</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Description</label>
    <textarea name="description" rows="4"
        class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">{{ old('description', $university->details?->description ?? '') }}</textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Logo</label>
        <input type="file" name="logo" accept="image/*"
            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-primary hover:file:bg-primary/20">
        @if (!empty($university->logo))
            <p class="mt-2 text-xs text-gray-500 dark:text-white/50">Current: <a href="{{ asset($university->logo) }}"
                    target="_blank" class="text-primary hover:underline">View logo</a></p>
        @endif
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Cover Image</label>
        <input type="file" name="cover_image" accept="image/*"
            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-primary hover:file:bg-primary/20">
        @if (!empty($university->cover_image))
            <p class="mt-2 text-xs text-gray-500 dark:text-white/50">Current: <a
                    href="{{ asset($university->cover_image) }}" target="_blank" class="text-primary hover:underline">View
                    cover</a></p>
        @endif
    </div>
</div>