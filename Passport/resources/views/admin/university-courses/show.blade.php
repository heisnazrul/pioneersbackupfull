@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="mx-auto max-w-4xl space-y-6 text-gray-800 dark:text-white">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">{{ $universityCourse->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-white/60">
                        {{ $universityCourse->university->name }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.university-courses.edit', $universityCourse) }}"
                        class="ti-btn rounded-full ti-btn-primary">Edit</a>
                    <a href="{{ route('admin.university-courses.index') }}"
                        class="ti-btn rounded-full ti-btn-ghost">Back</a>
                </div>
            </div>

            <div class="box">
                <div class="box-body space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium mb-2">Details</h3>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Level:</dt>
                                    <dd>{{ $universityCourse->level->name }}</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Faculty:</dt>
                                    <dd>{{ $universityCourse->faculty_name ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Duration:</dt>
                                    <dd>{{ $universityCourse->duration_months }} Months</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Tuition:</dt>
                                    <dd>{{ $universityCourse->currency }}
                                        {{ number_format($universityCourse->tuition_fee) }}</dd>
                                </div>
                                <div class="flex justify-between border-b py-2 dark:border-white/10">
                                    <dt class="text-gray-500">Campus:</dt>
                                    <dd>{{ $universityCourse->campus?->name ?? 'All/Main' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection