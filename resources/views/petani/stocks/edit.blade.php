@extends('layouts.app')

@section('title', 'Edit Stok')

@section('content')
    <a href="{{ route('petani.stok.index') }}"
        class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-emerald-700 mb-4 transition-colors">
        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Stok
    </a>

    <div class="mb-6">
        <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Koreksi Stok</p>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $stock->product->nama_produk ?? 'Varietas Gabah' }}
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- DETAIL PRODUK -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-sm text-gray-800">Detail Produk</h3>
            </div>

            <div class="p-6 flex items-start gap-5">
                <div
                    class="w-16 h-16 rounded-2xl overflow-hidden bg-emerald-50 border border-emerald-100 shrink-0 flex items-center justify-center">
                    @if (!empty($stock->product->gambar) && file_exists(public_path('storage/' . $stock->product->gambar)))
                        <img src="{{ asset('storage/' . $stock->product->gambar) }}"
                            alt="{{ $stock->product->nama_produk ?? 'Produk' }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-emerald-600 w-full h-full flex items-center justify-center">
                            <i class="fa-solid fa-wheat-awn text-2xl"></i>
                        </div>
                    @endif
                </div>

                <div class="flex-1 space-y-3">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Nama Produk</p>
                        <p class="text-sm font-bold text-gray-900 mt-0.5">
                            {{ $stock->product->nama_produk ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Harga Jual</p>
                        <p class="text-sm font-semibold text-gray-700 mt-0.5">
                            Rp {{ number_format($stock->product->harga_jual ?? 0, 0, ',', '.') }}
                            / {{ $stock->product->satuan ?? 'kg' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Stok Saat Ini</p>
                        <p class="text-sm font-bold text-emerald-700 mt-0.5">
                            {{ number_format($stock->stok_kg, 0, ',', '.') }} {{ $stock->product->satuan ?? 'kg' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM KOREKSI -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="bg-emerald-950 text-white px-5 py-4">
                <h3 class="font-bold text-sm tracking-wide uppercase">Koreksi Jumlah Stok</h3>
            </div>

            <form action="{{ route('petani.stok.update', $stock->id) }}" method="POST"
                @submit.prevent="$dispatch('open-confirm-modal', {
                    form: $el,
                    title: 'Koreksi Kuantitas Stok?',
                    message: `Kuantitas pasokan varietas '{{ $stock->product->nama_produk ?? 'Gabah' }}' akan diperbarui menjadi ${$el.stok_kg.value || 0} KG. Pastikan angka sudah sesuai kondisi gudang sebenarnya.`,
                    confirmLabel: 'Ya, Koreksi Sekarang',
                    type: 'primary'
                })"
                class="p-5 space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                        Jumlah Kuantitas Baru (KG)
                    </label>
                    <div class="relative">
                        <input type="number" step="1" name="stok_kg" value="{{ $stock->stok_kg }}" required
                            min="0"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs">
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 font-bold text-xs pointer-events-none">
                            KG
                        </span>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('petani.stok.index') }}"
                        class="flex-1 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2.5 rounded-xl text-sm transition-all cursor-pointer">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                        Koreksi <i class="fa-solid fa-check text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
