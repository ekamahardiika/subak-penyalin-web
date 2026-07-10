@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('konsumen.products.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Katalog Produk
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-xl border border-gray-100 shadow-xs">

            <div class="flex flex-col justify-between space-y-4">
                <div>
                    <span
                        class="text-[10px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100 px-2 py-0.5 rounded-md">Varietas
                        Pilihan</span>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight mt-2">{{ $product->nama_produk }}</h2>

                    <p class="text-2xl font-black text-emerald-600 mt-2 mb-4">
                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                        <span class="text-xs font-semibold text-gray-400">/ {{ $product->satuan ?? 'KG' }}</span>
                    </p>

                    <div class="border-t border-gray-50 pt-3">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Deskripsi Produk</p>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $product->deskripsi ?? 'Tidak ada deskripsi mendalam untuk produk ini.' }}</p>
                    </div>
                </div>

                <div
                    class="p-3.5 bg-amber-50/70 border border-amber-200/60 text-amber-800 rounded-xl text-xs flex items-center gap-2.5">
                    <i class="fa-solid fa-boxes-stacked text-amber-600 text-sm"></i>
                    <div>
                        Sisa Total Ketersediaan Stok Nasional: <strong
                            class="font-bold">{{ number_format($stokTersedia, 2, ',', '.') }} KG</strong>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50/70 p-6 border border-gray-100 rounded-xl flex flex-col justify-center">
                <div class="mb-4">
                    <h3 class="font-bold text-gray-800 text-base">Masukkan Jumlah Pesanan</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Sistem mengalokasikan stok secara real-time berdasarkan prinsip
                        FIFO.</p>
                </div>

                <form action="{{ route('konsumen.orders.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div>
                        <label for="qty"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kuantitas Pembelian
                            (KG)</label>
                        <div class="relative">
                            <input type="number" id="qty" name="qty" required
                                class="block w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                                min="1" max="{{ $stokTersedia }}" placeholder="Contoh: 500" />
                            <span
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 font-bold text-xs pointer-events-none">
                                KG
                            </span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                            Buat Pesanan & Bayar <i class="fa-solid fa-cart-shopping text-xs"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
