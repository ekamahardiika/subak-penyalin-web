@extends('layouts.app')

@section('content')
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Semua Produk
        </a>
    </div>

    <div class="w-full space-y-6">

        <!-- Info Kredensial Produk -->
        <div class="bg-white border border-gray-100 rounded-xl shadow-xs overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-emerald-900 to-emerald-950 text-white">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <span
                            class="text-[10px] font-bold uppercase tracking-widest bg-emerald-800 text-emerald-300 px-2.5 py-0.5 rounded-md border border-emerald-700/50">Profil
                            Komoditas</span>
                        <h1 class="text-2xl font-bold tracking-tight mt-1">{{ $product->nama_produk }}</h1>
                    </div>
                    <span
                        class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide border border-white/20 bg-white/10 backdrop-blur-xs">
                        {{ $product->status }}
                    </span>
                </div>
            </div>

            <div class="p-6 text-sm divide-y divide-gray-50">
                <div class="py-3 flex justify-between items-center">
                    <span class="font-bold text-gray-400 uppercase tracking-wider text-xs">Harga Pokok Jual</span>
                    <span class="text-base font-black text-emerald-600">
                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }} <span
                            class="text-xs text-gray-400 font-medium">/ {{ $product->satuan }}</span>
                    </span>
                </div>
                <div class="py-3.5">
                    <span class="font-bold text-gray-400 uppercase tracking-wider text-xs block mb-1">Deskripsi
                        Singkat</span>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $product->deskripsi ?? 'Tidak ada deskripsi tertulis untuk komoditas ini.' }}</p>
                </div>
            </div>
        </div>

        <!-- Sebaran Kepemilikan Stok Mitra Petani -->
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs space-y-4">
            <div>
                <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-list-ol text-emerald-600 text-xs"></i> Sebaran Kepemilikan Stok Mitra Petani
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Sistem antrean real-time pembagian kuota pasokan pasca-panen
                    mandiri.</p>
            </div>

            <div class="space-y-2">
                @forelse($stocks as $stock)
                    <div
                        class="p-3.5 bg-gray-50/70 hover:bg-gray-50 border border-gray-100 rounded-xl text-sm flex justify-between items-center shadow-2xs transition-colors">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="bg-white text-gray-400 p-2 rounded-lg border border-gray-100 flex items-center justify-center">
                                <i class="fa-regular fa-user text-xs"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-xs uppercase tracking-wider">Nama Petani Mitra</p>
                                <p class="text-sm font-semibold text-gray-600 mt-0.5">{{ $stock->petani->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-emerald-50 border border-emerald-100 text-emerald-700 font-mono font-bold rounded-lg text-xs">
                                {{ number_format($stock->stok_kg, 2, ',', '.') }} KG
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-6 border border-dashed border-gray-200 rounded-xl text-center text-gray-400">
                        <div class="flex flex-col items-center justify-center space-y-1.5">
                            <i class="fa-solid fa-layer-group text-2xl text-gray-300"></i>
                            <p class="text-xs">Belum ada suplai atau antrean pasokan stok gabah dari petani.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
