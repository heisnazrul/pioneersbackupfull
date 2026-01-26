@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
        <select name="university_id" id="university-select" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select university</option>
            @foreach ($universities as $university)
                <option value="{{ $university->id }}" data-country="{{ $university->country_id }}" @selected(old('university_id', $universityCampus->university_id ?? '') == $university->id)>{{ $university->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Name</label>
        <input type="text" name="name" value="{{ old('name', $universityCampus->name ?? '') }}" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">City</label>
        <select name="city_id" id="city-select" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Not set</option>
            @foreach ($cities as $id => $city)
                <option value="{{ $id }}" @selected(old('city_id', $universityCampus->city_id ?? '') == $id)>{{ $city }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_online_hub" value="0">
        <input type="checkbox" name="is_online_hub" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(old('is_online_hub', $universityCampus->is_online_hub ?? false))>
        <span class="text-sm text-gray-700 dark:text-white/80">Online Hub</span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Address Line 1</label>
        <input type="text" name="address_line1" value="{{ old('address_line1', $universityCampus->address_line1 ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Address Line 2</label>
        <input type="text" name="address_line2" value="{{ old('address_line2', $universityCampus->address_line2 ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Postal Code</label>
        <input type="text" name="postal_code" value="{{ old('postal_code', $universityCampus->postal_code ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Latitude</label>
        <input type="number" step="0.0000001" name="latitude" value="{{ old('latitude', $universityCampus->latitude ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Longitude</label>
        <input type="number" step="0.0000001" name="longitude" value="{{ old('longitude', $universityCampus->longitude ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Timezone</label>
    <input type="text" name="timezone" placeholder="e.g. Europe/London" value="{{ old('timezone', $universityCampus->timezone ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Use a valid IANA timezone identifier.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Admissions Email</label>
        <input type="email" name="contact[email]" value="{{ old('contact.email', $universityCampus->contact['email'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Admissions Phone</label>
        <input type="text" name="contact[phone]" value="{{ old('contact.phone', $universityCampus->contact['phone'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div class="flex items-center gap-2">
        <input type="hidden" name="housing_available" value="0">
        <input type="checkbox" name="housing_available" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(old('housing_available', $universityCampus->housing_available ?? false))>
        <span class="text-sm text-gray-700 dark:text-white/80">Housing Available</span>
    </div>
    <div class="flex items-center gap-2">
        <input type="hidden" name="intl_office_presence" value="0">
        <input type="checkbox" name="intl_office_presence" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(old('intl_office_presence', $universityCampus->intl_office_presence ?? false))>
        <span class="text-sm text-gray-700 dark:text-white/80">International Office Presence</span>
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Facilities <span class="text-xs text-gray-500">(comma separated)</span></label>
    @php
        $facilitiesDefault = isset($universityCampus) && is_array($universityCampus->facilities) ? implode(',', $universityCampus->facilities) : '';
        $facilitiesOld = old('facilities');
        if (is_array($facilitiesOld)) {
            $facilitiesDefault = implode(',', $facilitiesOld);
        }
    @endphp
    <input type="text" name="facilities_input" value="{{ $facilitiesDefault }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Notes</label>
    <textarea name="notes" rows="3" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">{{ old('notes', $universityCampus->notes ?? '') }}</textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form?.addEventListener('submit', function () {
            const facilitiesInput = form.querySelector('[name="facilities_input"]');
            if (facilitiesInput) {
                const values = facilitiesInput.value
                    ? facilitiesInput.value.split(',').map(v => v.trim()).filter(Boolean)
                    : [];

                values.forEach(function (value) {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'facilities[]';
                    hidden.value = value;
                    form.appendChild(hidden);
                });
            }
        }, { once: true });

        const universities = @json($universities->map(fn($u) => ['id' => $u->id, 'country_id' => $u->country_id])->values());
        const allCities = @json($allCities->map(fn($c) => ['id' => $c->id, 'name' => $c->name, 'country_id' => $c->country_id])->values());

        const universitySelect = document.getElementById('university-select');
        const citySelect = document.getElementById('city-select');

        function refreshCities(countryId) {
            if (! citySelect) return;
            const previous = citySelect.value;
            citySelect.innerHTML = '<option value="">Not set</option>';
            allCities
                .filter(city => Number(city.country_id) === Number(countryId))
                .forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    if (Number(previous) === Number(city.id)) {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
        }

        if (universitySelect) {
            const selectedUniversity = universities.find(u => Number(u.id) === Number(universitySelect.value));
            if (selectedUniversity) {
                refreshCities(selectedUniversity.country_id);
            }

            universitySelect.addEventListener('change', function (event) {
                const selected = universities.find(u => Number(u.id) === Number(event.target.value));
                citySelect.value = '';
                if (selected) {
                    refreshCities(selected.country_id);
                } else if (citySelect) {
                    citySelect.innerHTML = '<option value="">Not set</option>';
                }
            });
        }
    });
</script>
@endpush
