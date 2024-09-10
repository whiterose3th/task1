@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Products</h1>

    <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Add New Product
    </a>

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Category</th>
                <th class="py-2 px-4 text-left">Price</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-t">
                <td class="py-2 px-4">{{ $product->name }}</td>
                <td class="py-2 px-4">{{ $product->category->name }}</td>
                <td class="py-2 px-4">${{ $product->price }}</td>
                <td class="py-2 px-4">
                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">
                        Edit
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
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
