@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">University Campuses</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Manage physical and online hub locations.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.campuses.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Add Campus</a>
            </div>
        </div>

        <form method="GET" class="box">
            <div class="box-body grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Campus name" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
                    <select name="university_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All</option>
                        @foreach ($universities as $id => $university)
                            <option value="{{ $id }}" @selected(request('university_id') == $id)>{{ $university }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">City</label>
                    <select name="city_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All</option>
                        @foreach ($cities as $id => $city)
                            <option value="{{ $id }}" @selected(request('city_id') == $id)>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <label class="flex items-center gap-2 mt-6 text-sm text-gray-700 dark:text-white/80">
                        <input type="checkbox" name="is_online_hub" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(request('is_online_hub'))>
                        Online hubs only
                    </label>
                    <label class="flex items-center gap-2 mt-6 text-sm text-gray-700 dark:text-white/80">
                        <input type="checkbox" name="archived" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(request('archived'))>
                        Archived only
                    </label>
                    <div class="flex items-end">
                        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary w-full">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="box">
            <div class="box-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">University</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Online</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Coordinates</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($campuses as $campus)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $campus->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-white/70">{{ $campus->university?->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-white/70">{{ $campus->city?->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $campus->is_online_hub ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $campus->is_online_hub ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    @if ($campus->latitude && $campus->longitude)
                                        {{ number_format($campus->latitude, 4) }}, {{ number_format($campus->longitude, 4) }}
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <div class="flex justify-end gap-2">
                                        @if (request('archived'))
                                            <form action="{{ route('admin.campuses.restore', $campus->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="ti-btn ti-btn-outline ti-btn-outline-warning rounded-full text-xs">Restore</button>
                                            </form>
                                        @else
                                            <a href="{{ route('admin.campuses.show', $campus) }}" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs">View</a>
                                            <a href="{{ route('admin.campuses.edit', $campus) }}" class="ti-btn ti-btn-outline ti-btn-outline-success rounded-full text-xs">Edit</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No campuses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $campuses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
