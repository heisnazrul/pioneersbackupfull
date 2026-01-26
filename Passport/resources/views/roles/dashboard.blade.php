@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10 max-w-5xl mx-auto space-y-6">
  <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-8 space-y-4">
    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ $config['title'] }}</h1>
    <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed">{{ $config['description'] }}</p>
    <div class="flex flex-wrap gap-3">
      @foreach ($config['actions'] as $action)
        <a href="{{ $action['url'] }}"
           class="ti-btn rounded-full {{ ($action['style'] ?? 'primary') === 'outline' ? 'ti-btn-outline ti-btn-outline-primary' : 'ti-btn-outline ti-btn-outline-success' }}">
          {{ $action['label'] }}
        </a>
      @endforeach
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="rounded-2xl border border-dashed border-primary/40 bg-primary/5 p-6">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Highlights</h2>
      <p class="text-sm text-gray-600 dark:text-white/70">Stay on top of key updates, KPIs, and deadlines relevant to your role.</p>
      <ul class="mt-4 list-disc pl-5 text-sm text-gray-600 dark:text-white/60 space-y-2">
        <li>Review the latest announcements posted by HQ.</li>
        <li>Check the upcoming deadlines and deliverables.</li>
        <li>Coordinate with teammates directly from the chat hub.</li>
      </ul>
    </div>
    <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-6">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Shortcuts</h2>
      <div class="mt-4 space-y-3 text-sm">
        <a href="#" class="flex items-center justify-between rounded-xl border border-gray-100 dark:border-white/10 px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/10 transition">
          <span>View notifications</span>
          <i class="ri-arrow-right-line text-primary"></i>
        </a>
        <a href="#" class="flex items-center justify-between rounded-xl border border-gray-100 dark:border-white/10 px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/10 transition">
          <span>Share an update</span>
          <i class="ri-arrow-right-line text-primary"></i>
        </a>
        <a href="#" class="flex items-center justify-between rounded-xl border border-gray-100 dark:border-white/10 px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/10 transition">
          <span>Meet the HQ team</span>
          <i class="ri-arrow-right-line text-primary"></i>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
