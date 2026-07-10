@extends('layouts.landing')

@section('content')
    <!-- Mini Header -->
    <div class="bg-emerald-950 pt-32 pb-16 text-center text-white">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold">Semua Produk (Katalog Publik)</h1>
            <p class="text-emerald-300 text-sm mt-2 max-w-md mx-auto">Daftar komoditas gabah dan hasil tani unggulan yang
                terdaftar resmi pada sistem kami.</p>
        </div>
    </div>

    <!-- Catalog Grid -->
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            @foreach ($products as $product)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="h-44 bg-gray-50 flex items-center justify-center border-b border-gray-100">
                            <i class="fa-solid fa-box-open text-emerald-600/20 text-5xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $product->nama_produk }}</h3>
                            <p class="text-emerald-600 font-bold text-base mb-2">
                                Rp {{ number_format($product->harga_jual) }} <span
                                    class="text-xs text-gray-400 font-normal">/ {{ $product->satuan }}</span>
                            </p>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                {{ $product->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('login') }}"
                            class="block text-center border border-emerald-600 text-emerald-600 font-semibold py-2 rounded-xl text-xs hover:bg-emerald-600 hover:text-white transition-colors">
                            Detail Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination wrapper -->
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            {{ $products->links() }}
        </div>
    </div>
@endsection
