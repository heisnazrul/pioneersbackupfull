<div class="grid grid-cols-1 gap-6">
    <!-- Basic Info Section -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Name <span
                        class="text-red-500">*</span></label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="name" name="name" value="{{ old('name', $destination->name ?? '') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Slug <span
                        class="text-red-500">*</span></label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="slug" name="slug" value="{{ old('slug', $destination->slug ?? '') }}" required>
                <p class="text-xs text-gray-500 mt-1">Unique URL identifier (e.g. united-kingdom)</p>
                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="country_id" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Country
                    <span class="text-red-500">*</span></label>
                <select class="form-select w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="country_id" name="country_id" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $destination->country_id ?? '') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="region" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Region <span
                        class="text-red-500">*</span></label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="region" name="region" value="{{ old('region', $destination->region ?? '') }}" required>
                @error('region')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description"
                    class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Description <span
                        class="text-red-500">*</span></label>
                <textarea
                    class="form-textarea w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="description" name="description" rows="4"
                    required>{{ old('description', $destination->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Destination Image</label>
                
                @if(isset($destination) && $destination->image_url)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $destination->image_url) }}" alt="Current Image" class="h-32 w-auto object-cover rounded border">
                    </div>
                @endif
                
                <input type="file"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="image" name="image" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image. Supported formats: JPEG, PNG, JPG, GIF.</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="short_pitch" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Short
                    Pitch</label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="short_pitch" name="short_pitch"
                    value="{{ old('short_pitch', $destination->short_pitch ?? '') }}">
                @error('short_pitch')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-primary rounded border-gray-300" id="is_active"
                        name="is_active" value="1" {{ old('is_active', $destination->is_active ?? true) ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-gray-700 dark:text-white/70"
                        for="is_active">Active (Visible on Website)</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h3 class="text-lg font-bold mb-4">Quick Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="tuition_range"
                    class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Tuition Range</label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="tuition_range" name="tuition_range"
                    value="{{ old('tuition_range', $destination->tuition_range ?? '') }}">
            </div>
            <div>
                <label for="visa_timeline" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Visa
                    Timeline</label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="visa_timeline" name="visa_timeline"
                    value="{{ old('visa_timeline', $destination->visa_timeline ?? '') }}">
            </div>
            <div>
                <label for="work_rights" class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Work
                    Rights</label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="work_rights" name="work_rights"
                    value="{{ old('work_rights', $destination->work_rights ?? '') }}">
            </div>
            <div class="md:col-span-3">
                <label for="scholarships_summary"
                    class="block text-sm font-medium text-gray-700 dark:text-white/70 mb-2">Scholarships Summary</label>
                <input type="text"
                    class="form-input w-full rounded-md border-gray-300 dark:border-white/10 dark:text-white/70"
                    id="scholarships_summary" name="scholarships_summary"
                    value="{{ old('scholarships_summary', $destination->scholarships_summary ?? '') }}">
            </div>
        </div>
    </div>

    <!-- Dynamic Features -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Key Features</h3>
            <button type="button" class="ti-btn rounded-full ti-btn-sm ti-btn-outline-primary" onclick="addFeature()">+
                Add Feature</button>
        </div>
        <div id="features-container" class="space-y-3">
            @if(isset($destination) && $destination->features->count() > 0)
                @foreach($destination->features as $feature)
                    <div class="flex items-center gap-2">
                        <input type="text" name="features[]" class="form-input w-full rounded-md border-gray-300"
                            placeholder="Feature" value="{{ $feature->feature }}">
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                @endforeach
            @else
                <!-- Default empty row if new -->
                <div class="flex items-center gap-2">
                    <input type="text" name="features[]" class="form-input w-full rounded-md border-gray-300"
                        placeholder="Feature">
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Dynamic Stats -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Statistics</h3>
            <button type="button" class="ti-btn rounded-full ti-btn-sm ti-btn-outline-primary" onclick="addStat()">+ Add
                Stat</button>
        </div>
        <div id="stats-container" class="space-y-3">
            @if(isset($destination) && $destination->stats->count() > 0)
                @foreach($destination->stats as $stat)
                    <div class="flex items-center gap-2">
                        <input type="text" name="stats[{{ $loop->index }}][label]"
                            class="form-input w-1/3 rounded-md border-gray-300" placeholder="Label" value="{{ $stat->label }}">
                        <input type="text" name="stats[{{ $loop->index }}][value]"
                            class="form-input w-2/3 rounded-md border-gray-300" placeholder="Value" value="{{ $stat->value }}">
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Dynamic Intakes -->
    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Intakes</h3>
            <button type="button" class="ti-btn rounded-full ti-btn-sm ti-btn-outline-primary" onclick="addIntake()">+
                Add Intake</button>
        </div>
        <div id="intakes-container" class="space-y-3">
            @if(isset($destination) && $destination->intakes->count() > 0)
                @foreach($destination->intakes as $intake)
                    <div class="flex items-center gap-2">
                        <input type="text" name="intakes[{{ $loop->index }}][month]"
                            class="form-input w-1/3 rounded-md border-gray-300" placeholder="Month (e.g. Jan)"
                            value="{{ $intake->month }}">
                        <input type="text" name="intakes[{{ $loop->index }}][event]"
                            class="form-input w-2/3 rounded-md border-gray-300" placeholder="Event (e.g. Winter Intake)"
                            value="{{ $intake->event }}">
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>

<script>
    // Helper to create simple text row
    function createTextRow(name, placeholder) {
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="${name}[]" class="form-input w-full rounded-md border-gray-300" placeholder="${placeholder}">
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <i class="ri-delete-bin-line"></i>
            </button>
        `;
        return div;
    }

    // Features
    function addFeature() {
        document.getElementById('features-container').appendChild(createTextRow('features', 'Feature'));
    }

    // Stats
    function addStat() {
        const container = document.getElementById('stats-container');
        const index = container.children.length; // Simple index tracking
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="stats[${index}][label]" class="form-input w-1/3 rounded-md border-gray-300" placeholder="Label">
            <input type="text" name="stats[${index}][value]" class="form-input w-2/3 rounded-md border-gray-300" placeholder="Value">
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <i class="ri-delete-bin-line"></i>
            </button>
        `;
        container.appendChild(div);
    }

    // Intakes
    function addIntake() {
        const container = document.getElementById('intakes-container');
        const index = container.children.length;
        const div = document.createElement('div');
        div.className = 'flex items-center gap-2';
        div.innerHTML = `
            <input type="text" name="intakes[${index}][month]" class="form-input w-1/3 rounded-md border-gray-300" placeholder="Month">
            <input type="text" name="intakes[${index}][event]" class="form-input w-2/3 rounded-md border-gray-300" placeholder="Event">
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <i class="ri-delete-bin-line"></i>
            </button>
        `;
        container.appendChild(div);
    }
</script>