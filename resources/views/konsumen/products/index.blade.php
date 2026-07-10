@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Katalog Produk Gabah</h1>
        <p class="text-sm text-gray-500 mt-1">Silakan pilih varietas produk gabah unggulan yang tersedia untuk Anda beli.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
        @foreach ($products as $product)
            <div
                class="bg-white border border-gray-100 rounded-xl shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md hover:border-emerald-100 transition-all p-5">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg tracking-tight mb-1">{{ $product->nama_produk }}</h3>

                    <p class="text-lg font-black text-emerald-600 mb-2">
                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                        <span class="text-xs font-semibold text-gray-400">/ {{ $product->satuan ?? 'KG' }}</span>
                    </p>

                    <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed mb-4">
                        {{ $product->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                    </p>
                </div>

                <div>
                    <a href="{{ route('konsumen.products.show', $product->id) }}"
                        class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl text-xs font-semibold shadow-xs shadow-emerald-700/10 transition-all cursor-pointer">
                        Lihat Detail & Checkout <i class="fa-solid fa-arrow-right text-[10px] ml-1"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
