@extends('layouts.app')
@section('content')
    <div class="text-center py-12 bg-white rounded-lg shadow-sm mb-6 p-6">
        <h1 class="text-4xl font-bold text-emerald-600 mb-2">Selamat Datang di Sistem Gabah</h1>
        <p class="text-gray-600">Platform penghubung Petani dengan Konsumen secara transparan.</p>
        <div class="mt-4 flex justify-center gap-4">
            <a href="{{ route('tentang') }}" class="text-emerald-600 hover:underline">Tentang Kami</a>
            <a href="{{ route('produk') }}" class="text-emerald-600 hover:underline">Lihat Semua Produk</a>
            <a href="{{ route('kontak') }}" class="text-emerald-600 hover:underline">Hubungi Kontak</a>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-4">Produk Terbaru</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg">{{ $product->nama_produk }}</h3>
                <p class="text-emerald-600 font-semibold mb-2">Rp {{ number_format($product->harga_jual) }} /
                    {{ $product->satuan }}</p>
                <p class="text-sm text-gray-500 mb-4">{{ $product->deskripsi }}</p>
                <a href="{{ route('login') }}"
                    class="block text-center bg-emerald-500 text-white py-1 rounded text-sm">Login untuk Beli</a>
            </div>
        @endforeach
    </div>
@endsection
