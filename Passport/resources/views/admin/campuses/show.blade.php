@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="mx-auto max-w-4xl space-y-6 text-gray-800 dark:text-white">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">{{ $universityCampus->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-white/60">
                        {{ $universityCampus->university->name }} - {{ $universityCampus->city->name }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.campuses.edit', $universityCampus) }}"
                        class="ti-btn rounded-full ti-btn-primary">Edit</a>
                    <a href="{{ route('admin.campuses.index') }}" class="ti-btn rounded-full ti-btn-ghost">Back</a>
                </div>
            </div>

            <div class="box">
                <div class="box-body space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2">Details</h3>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Address:</dt>
                                    <dd>{{ $universityCampus->address ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Coordinates:</dt>
                                    <dd>{{ $universityCampus->map_coordinates ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Slug:</dt>
                                    <dd>{{ $universityCampus->slug }}</dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Courses ({{ $universityCampus->courses->count() }})</h3>
                            @if ($universityCampus->courses->count() > 0)
                                <ul class="list-disc list-inside text-sm text-gray-600 dark:text-white/70">
                                    @foreach ($universityCampus->courses->take(10) as $course)
                                        <li>{{ $course->name }} ({{ $course->level->name }})</li>
                                    @endforeach
                                    @if ($universityCampus->courses->count() > 10)
                                        <li>...and {{ $universityCampus->courses->count() - 10 }} more.</li>
                                    @endif
                                </ul>
                            @else
                                <p class="text-sm text-gray-400">No courses assigned to this campus.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection