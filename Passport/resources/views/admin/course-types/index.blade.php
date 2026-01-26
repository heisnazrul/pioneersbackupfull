@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Course Types List</h2>
        <a href="{{ route('admin.course-types.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Course Type
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Type Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Arabic Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courseTypes as $courseType)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $courseType->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $courseType->ar_name }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.course-types.edit', $courseType) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.course-types.destroy', $courseType) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $courseTypes->links() }}
        </div>
    </div>
</div>
@endsection
