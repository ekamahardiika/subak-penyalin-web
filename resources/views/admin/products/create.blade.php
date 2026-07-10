@extends('layouts.app')

@section('content')
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Tambah Produk Baru</h2>
                <p class="text-xs text-gray-500 mt-0.5">Buat komoditas jenis gabah atau beras baru untuk dipajang pada
                    katalog konsumen.</p>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Nama Produk -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Produk</label>
                    <div class="relative">
                        <input type="text" name="nama_produk" required placeholder="Contoh: Gabah Kering Giling (KGD)"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-wheat-awn text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Grid Input Harga & Satuan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Harga Jual -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga Jual per
                            Satuan</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-bold text-gray-400 pointer-events-none">Rp</span>
                            <input type="number" name="harga_jual" required min="0" placeholder="0"
                                class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        </div>
                    </div>

                    <!-- Satuan Jual -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Satuan
                            Jual</label>
                        <div class="relative">
                            <input type="text" name="satuan" value="kg" required placeholder="Contoh: kg, karung"
                                class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                            <span
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                                <i class="fa-solid fa-weight-scale text-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Aktif -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Status
                        Visibilitas</label>
                    <div class="relative">
                        <select name="status"
                            class="block w-full pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 appearance-none cursor-pointer shadow-xs">
                            <option value="aktif">Aktif (Tampilkan di Katalog)</option>
                            <option value="nonaktif">Nonaktif (Sembunyikan)</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Deskripsi
                        Produk</label>
                    <textarea name="deskripsi" rows="3" placeholder="Tulis deskripsi spesifikasi kualitas gabah..."
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs resize-none"></textarea>
                </div>

                <!-- Gambar Produk -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Gambar
                        Komoditas</label>
                    <div
                        class="border border-dashed border-gray-200 rounded-xl p-4 bg-gray-50 flex items-center justify-between">
                        <input type="file" name="gambar"
                            class="block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all cursor-pointer" />
                        <i class="fa-regular fa-image text-gray-400 text-lg pr-2"></i>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Simpan Komoditas Baru <i class="fa-solid fa-circle-plus text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
