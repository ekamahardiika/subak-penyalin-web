@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Semua Produk (Katalog Publik)</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
        @foreach ($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-sm border">
                <h3 class="font-bold text-lg">{{ $product->nama_produk }}</h3>
                <p class="text-emerald-600 font-semibold">Rp {{ number_format($product->harga_jual) }} /
                    {{ $product->satuan }}</p>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
