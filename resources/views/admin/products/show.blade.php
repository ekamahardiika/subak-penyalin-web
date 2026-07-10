@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-2">{{ $product->nama_produk }}</h1>
    <div class="bg-white p-4 border rounded text-sm space-y-2 mb-4">
        <p><strong>Harga Pokok Jual:</strong> Rp {{ number_format($product->harga_jual) }} / {{ $product->satuan }}</p>
        <p><strong>Deskripsi Singkat:</strong> {{ $product->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        <p><strong>Status Aktif Katalog:</strong> <span class="uppercase font-bold">{{ $product->status }}</span></p>
    </div>

    <h3 class="font-bold text-sm mb-2">Sebaran Kepemilikan Stok Mitra Petani (Sistem Antrean Real-time):</h3>
    <div class="space-y-1">
        @forelse($stocks as $stock)
            <div class="p-2 bg-gray-50 border rounded text-xs flex justify-between">
                <span>Nama Petani: <strong>{{ $stock->petani->name }}</strong></span>
                <span class="text-emerald-600 font-semibold">{{ number_format($stock->stok_kg, 2) }} KG</span>
            </div>
        @empty
            <p class="text-gray-500 text-xs">Belum ada pasokan stok gabah dari petani untuk produk ini.</p>
        @endforelse
    </div>
@endsection
