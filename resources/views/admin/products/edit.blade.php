@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="w-full">
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Edit Produk</h2>
                <p class="text-xs text-gray-500 mt-0.5">Perbarui detail parameter produk komoditas gabah internal platform.
                </p>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Produk</label>
                    <div class="relative">
                        <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-wheat-awn text-sm"></i>
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga Jual per
                            Satuan</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-bold text-gray-400 pointer-events-none">Rp</span>
                            <input type="number" name="harga_jual" value="{{ $product->harga_jual }}" required
                                min="0"
                                class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Satuan
                            Jual</label>
                        <div class="relative">
                            <input type="text" name="satuan" value="{{ $product->satuan }}" required
                                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                            <span
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                                <i class="fa-solid fa-weight-scale text-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Status
                        Visibilitas</label>
                    <div class="relative">
                        <select name="status"
                            class="block w-full pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 appearance-none cursor-pointer shadow-xs">
                            <option value="aktif" {{ $product->status == 'aktif' ? 'selected' : '' }}>Aktif (Tampilkan di
                                Katalog)</option>
                            <option value="nonaktif" {{ $product->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                (Sembunyikan)</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi
                        Produk</label>
                    <textarea name="deskripsi" rows="3"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs resize-none">{{ $product->deskripsi }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ganti Gambar
                        Komoditas</label>
                    <div
                        class="border border-dashed border-gray-200 rounded-xl p-4 bg-gray-50 flex items-center justify-between">
                        <input type="file" name="gambar"
                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer" />
                        <i class="fa-regular fa-image text-gray-400 text-lg pr-2"></i>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Perbarui Data Produk <i class="fa-solid fa-circle-check text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
