@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">{{ isset($courseFee) ? 'Edit' : 'Create' }} Course Fee</h2>
        <a href="{{ route('admin.course-fees.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Course Fees
        </a>
    </div>

    <form action="{{ isset($courseFee) ? route('admin.course-fees.update', $courseFee) : route('admin.course-fees.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($courseFee))
            @method('PUT')
        @endif

        <!-- Course -->
        <div class="form-group">
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
            <select name="course_id" id="course_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm" required>
                <option value="">-- Select a course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                        @selected((isset($selectedCourseId) && (int)$selectedCourseId === (int)$course->id) || (isset($courseFee) && $courseFee->course_id === $course->id))>
                        {{ $course->name }} - {{ $course->branch->school->name ?? '' }} - {{ $course->branch->city->name ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
            <input type="number" name="year" id="year"
                value="{{ old('year', $year ?? date('Y')) }}"
                min="2000" max="2100"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
        </div>

        <!-- Weeks & Fees -->
        <div class="form-group">
            <div class="flex items-center justify-between">
                <label class="block text-sm font-medium text-gray-700">Weeks and Fees</label>
                <button type="button" id="add-week-fee"
                    class="ti-btn ti-btn-outline border-green-500 text-green-500 hover:text-white hover:bg-green-500 hover:border-green-500 focus:ring-green-500 dark:focus:ring-offset-white/10">
                    Add Week
                </button>
            </div>

            <div id="weeks-fees" class="grid grid-cols-8 gap-4 mt-4"></div>

            <p class="text-xs text-gray-500 mt-2">Tip: Leave a fee empty to delete that week’s price.</p>
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                {{ isset($courseFee) ? 'Update' : 'Save' }} Course Fee
            </button>
            <a href="{{ route('admin.course-fees.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>

{{-- Prefill data passed from controller for SSR load (edit or ?course_id=) --}}
<script>
    const MAX_WEEKS = 48;
    const weeksContainer = document.getElementById('weeks-fees');
    const courseSelect = document.getElementById('course_id');
    const addBtn = document.getElementById('add-week-fee');

    // Prefill from PHP if provided
    const prefill = @json($prefill ?? []);
    let currentWeeks = []; // array of weekNumbers present

    function renderWeeks(prefillMap = {}) {
        weeksContainer.innerHTML = '';
        currentWeeks = Object.keys(prefillMap).map(n => parseInt(n, 10)).sort((a,b)=>a-b);

        // If no prefill, start with week 1
        if (currentWeeks.length === 0) {
            currentWeeks = [1];
        }

        for (const week of currentWeeks) {
            addWeekRow(week, prefillMap[week] ?? '');
        }
    }

    function addWeekRow(weekNumber, feeValue = '') {
        const div = document.createElement('div');
        div.className = 'week-fee-item col-span-1';
        div.innerHTML = `
            <ol class="list-decimal pl-6">
                <li>Week ${weekNumber}:
                    <input type="hidden" name="weeks[${weekNumber - 1}][week_number]" value="${weekNumber}">
                    <input type="number" step="0.01" name="weeks[${weekNumber - 1}][fee]" value="${feeValue}"
                        placeholder="Fee"
                        class="mt-1 block w-full px-3 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                </li>
            </ol>
        `;
        weeksContainer.appendChild(div);
    }

    function addNextWeek() {
        let next = 1;
        if (currentWeeks.length) {
            next = Math.max(...currentWeeks) + 1;
        }
        if (next > MAX_WEEKS) {
            alert('You can only add up to 48 weeks.');
            return;
        }
        // Prefill with last fee if any
        let lastFee = '';
        if (currentWeeks.length) {
            const lastWeek = Math.max(...currentWeeks);
            const lastInput = document.querySelector(`input[name="weeks[${lastWeek - 1}][fee]"]`);
            lastFee = lastInput ? lastInput.value : '';
        }
        currentWeeks.push(next);
        addWeekRow(next, lastFee);
    }

    addBtn.addEventListener('click', addNextWeek);

    // Load via AJAX when course changes
    async function loadCourseFees(courseId) {
        if (!courseId) { renderWeeks({}); return; }
        try {
            const res = await fetch(`{{ route('admin.course-fees.fetch', ['course' => 'COURSE_ID']) }}`.replace('COURSE_ID', courseId));
            if (!res.ok) throw new Error('Failed to fetch fees');
            const data = await res.json();
            const map = {};
            (data.fees || []).forEach(item => { map[item.week_number] = item.fee; });
            renderWeeks(map);
        } catch (e) {
            console.error(e);
            renderWeeks({});
        }
    }

    // Initial render (SSR prefill)
    renderWeeks(prefill);

    // On change
    courseSelect.addEventListener('change', (e) => loadCourseFees(e.target.value));
</script>
@endsection
