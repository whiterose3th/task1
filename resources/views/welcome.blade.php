@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Selamat Datang di Aplikasi Kamu!</h1>
    <p class="mb-6">Ini adalah aplikasi Laravelku.</p>

    <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
        Lihat Produk
    </a>
    <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Lihat Kategori
    </a>
</div>
@endsection
