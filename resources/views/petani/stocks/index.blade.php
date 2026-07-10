@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Stok Gabah Mandiri</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola pasokan hasil panen gabah Anda ke dalam gudang alokasi pesanan konsumen.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-4">
                <h2 class="font-bold text-gray-900 text-base">Setor Pasokan</h2>
                <p class="text-xs text-gray-400 mt-0.5">Tambahkan kuantitas panen baru.</p>
            </div>

            <form action="{{ route('petani.stok.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Varietas
                        Komoditas</label>
                    <div class="relative">
                        <select name="product_id" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs appearance-none cursor-pointer">
                            @foreach ($products as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_produk }} (Rp
                                    {{ number_format($p->harga_jual, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jumlah Kuantitas
                        (KG)</label>
                    <div class="relative">
                        <input type="number" step="0.01" name="stok_kg" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            min="0" placeholder="0.00" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 font-bold text-xs pointer-events-none">
                            KG
                        </span>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Setor Tambah Stok <i class="fa-solid fa-plus text-xs"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs md:col-span-2">
            <div class="mb-4">
                <h2 class="font-bold text-gray-900 text-base">Daftar Stok Gabah di Gudang</h2>
                <p class="text-xs text-gray-400 mt-0.5">Sisa stok aktif mandiri Anda yang siap dialokasikan untuk pesanan.
                </p>
            </div>

            <div class="space-y-3">
                @forelse($stocks as $stock)
                    <div
                        class="p-4 bg-gray-50/70 border border-gray-100 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all hover:border-emerald-100">
                        <div class="flex items-center gap-3.5">
                            <div class="bg-emerald-50 text-emerald-600 p-2.5 rounded-xl border border-emerald-100">
                                <i class="fa-solid fa-wheat-awn text-sm"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">
                                    {{ $stock->product->nama_produk ?? 'Varietas Gabah' }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">Sisa Siap Alokasi: <span
                                        class="text-emerald-600 font-bold">{{ number_format($stock->stok_kg, 2, ',', '.') }}
                                        KG</span></p>
                            </div>
                        </div>

                        <form action="{{ route('petani.stok.update', $stock->id) }}" method="POST"
                            class="flex items-center gap-2 bg-white p-1.5 border border-gray-200 rounded-xl shadow-xs w-fit">
                            @csrf
                            @method('PATCH')
                            <input type="number" step="0.01" name="stok_kg" value="{{ $stock->stok_kg }}" required
                                class="w-20 px-2 py-1 text-center bg-gray-50 border border-gray-100 text-xs font-bold text-gray-800 rounded-lg focus:outline-none focus:border-emerald-500"
                                min="0">
                            <button type="submit"
                                class="bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white font-bold px-3 py-1.5 rounded-lg text-xs border border-emerald-200/60 transition-all cursor-pointer">
                                Koreksi
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="py-8 text-center text-gray-400 flex flex-col items-center justify-center space-y-2">
                        <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
                        <p class="text-xs">Anda belum menyetor pasokan produk apa pun.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
