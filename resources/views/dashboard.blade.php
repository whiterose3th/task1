@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Categories</h2>
            <a href="{{ route('categories.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center mb-3">
                Manage Categories
            </a>
            <a href="{{ route('categories.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block text-center">
                Add New Category
            </a>
        </div>

       <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Products</h2>
            <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center mb-3">
                Manage Products
            </a>
            <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block text-center">
                Add New Product
            </a>
        </div>
@endsection
