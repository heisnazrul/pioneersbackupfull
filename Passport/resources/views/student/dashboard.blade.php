@extends('student.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-body p-8 space-y-6">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-3">
                            Welcome back, {{ $user->name ?? 'Student' }}
                        </h1>
                        <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed max-w-3xl">
                            Track your intake milestones, manage documents, and message your counselor — everything you need to stay on track lives right here.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($progress as $step)
                            <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-4">
                                <div class="flex items-center justify-between text-sm text-gray-500 dark:text-white/60">
                                    <span>{{ $step['label'] }}</span>
                                    <span>{{ $step['value'] }}%</span>
                                </div>
                                <div class="mt-2 h-2 rounded-full bg-gray-100 dark:bg-white/10">
                                    <div class="h-2 rounded-full bg-primary" style="width: {{ $step['value'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Next steps</h2>
                            <ul class="space-y-3">
                                @foreach ($tasks as $task)
                                    <li class="flex items-center justify-between rounded-xl border border-gray-100 dark:border-white/10 px-4 py-3">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $task['title'] }}</p>
                                        </div>
                                        <span class="text-xs font-semibold rounded-full px-3 py-1 {{ $task['status'] === 'Done' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $task['status'] }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Quick links</h2>
                            <div class="space-y-3">
                                @foreach ($shortcuts as $shortcut)
                                    <a href="{{ $shortcut['url'] }}" class="block rounded-xl border border-gray-100 dark:border-white/10 px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/10 transition">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ $shortcut['label'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-white/60">{{ $shortcut['description'] }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-dashed border-primary/40 bg-primary/5 p-6 text-sm text-gray-600 dark:text-white/70">
                        Need help? Message your counselor or email <a href="mailto:support@pioneerscourse.com" class="text-primary font-semibold">support@pioneerscourse.com</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
