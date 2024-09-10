@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Categories</h1>

    <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Add New Category
    </a>

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $category->name }}</td>
                <td class="py-2 px-4">
                    <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">
                        Edit
                    </a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
