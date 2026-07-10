@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Katalog Produk Gabah (Silakan Pilih)</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        @foreach ($products as $product)
            <div class="bg-white p-4 border rounded shadow-sm">
                <h3 class="font-bold text-base">{{ $product->nama_produk }}</h3>
                <p class="text-emerald-600 font-bold mb-2">Rp {{ number_format($product->harga_jual) }} /
                    {{ $product->satuan }}</p>
                <p class="text-xs text-gray-500 mb-3">{{ $product->deskripsi }}</p>
                <a href="{{ route('konsumen.products.show', $product->id) }}"
                    class="block text-center bg-blue-600 text-white py-1 rounded text-xs font-semibold">Lihat Detail &
                    Checkout</a>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
