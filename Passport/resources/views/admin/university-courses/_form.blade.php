@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Name</label>
        <input type="text" name="name" value="{{ old('name', $course->name ?? '') }}" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Slug <span
                class="text-xs text-gray-500">(auto)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $course->slug ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
        <select name="university_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select University</option>
            @foreach ($universities as $id => $name)
                <option value="{{ $id }}" @selected(old('university_id', $course->university_id ?? '') == $id)>{{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Campus</label>
        <select name="campus_id"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select Campus (Optional)</option>
            @foreach ($campuses as $id => $name)
                <option value="{{ $id }}" @selected(old('campus_id', $course->campus_id ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
        <p class="text-xs text-gray-500 mt-1">If empty, course applies to all campuses or main.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Level</label>
        <select name="level_id" required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select Level</option>
            @foreach ($levels as $id => $name)
                <option value="{{ $id }}" @selected(old('level_id', $course->level_id ?? '') == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Faculty Name</label>
        <input type="text" name="faculty_name" value="{{ old('faculty_name', $course->faculty_name ?? '') }}"
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Duration (Months)</label>
        <input type="number" name="duration_months" value="{{ old('duration_months', $course->duration_months ?? '') }}"
            required
            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>

    <div class="grid grid-cols-2 gap-2">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Currency</label>
            <input type="text" name="currency" value="{{ old('currency', $course->currency ?? 'USD') }}" required
                maxlength="3"
                class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Tuition Fee</label>
            <input type="number" name="tuition_fee" value="{{ old('tuition_fee', $course->tuition_fee ?? '') }}"
                required
                class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
        </div>
    </div>
</div>