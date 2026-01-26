@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Camp Media</h2>
        <a href="{{ route('admin.camp-media.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Upload Camp Media
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Preview</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Camp</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Alt Text</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Caption</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campMedia as $media)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm">
                        @if ($media->path)
                            <img src="{{ asset('storage/'.$media->path) }}" alt="{{ $media->alt_text }}" class="h-16 w-16 object-cover rounded-md border">
                        @else
                            <span class="text-gray-400 text-xs uppercase tracking-wide">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $branch = $media->camp->branch ?? null;
                        @endphp
                        {{ $media->camp->name ?? 'N/A' }} <br>
                        <span class="text-xs text-gray-500">
                            {{ $branch ? ($branch->school->name ?? 'Unnamed School').' - '.($branch->city->name ?? 'Unknown City') : 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $media->alt_text }}</td>
                    <td class="px-6 py-4 text-sm">{{ $media->caption ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.camp-media.edit', $media) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.camp-media.destroy', $media) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500">No camp media found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $campMedia->links() }}
        </div>
    </div>
</div>
@endsection
