@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Camp Infos</h2>
        <a href="{{ route('admin.camp-infos.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Camp Info
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Camp</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Last Updated</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campInfos as $campInfo)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $campInfo->camp->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $branch = $campInfo->camp->branch ?? null;
                        @endphp
                        {{ $branch ? ($branch->school->name ?? 'Unnamed School') . ' - ' . ($branch->city->name ?? 'Unknown City') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $campInfo->updated_at?->format('M d, Y H:i') ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.camp-infos.edit', $campInfo) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.camp-infos.destroy', $campInfo) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500">No camp infos found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $campInfos->links() }}
        </div>
    </div>
</div>
@endsection
