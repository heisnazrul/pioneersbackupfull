@php use Illuminate\Support\Str; @endphp
@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between items-center py-6">
        <div>
            <p class="text-sm text-gray-500">CMS</p>
            <h2 class="text-2xl font-bold">{{ $title }}</h2>
            <p class="text-sm text-gray-500 mt-1">Manage frontend pages for this app.</p>
        </div>
        <a href="{{ route('admin.cms.create', $app) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">New Page</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($pages as $page)
            <div class="bg-white shadow rounded-lg p-4 border">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $page->title }}</h3>
                        <p class="text-xs text-gray-500">/{{ $page->slug }}</p>
                    </div>
                    <span class="badge {{ $page->is_active ? 'bg-success/10 text-success' : 'bg-danger/10 text-danger' }}">
                        {{ $page->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="mt-2 text-sm text-gray-600 line-clamp-3">
                    {{ Str::limit(strip_tags($page->content), 120) }}
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('admin.cms.edit', $page) }}" class="ti-btn ti-btn-outline ti-btn-outline-primary ti-btn-sm">Edit</a>
                    <form action="{{ route('admin.cms.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                        @csrf
                        @method('DELETE')
                        <button class="ti-btn ti-btn-outline ti-btn-outline-danger ti-btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No pages yet.</p>
        @endforelse
    </div>
</div>
@endsection
