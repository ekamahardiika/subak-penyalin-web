@extends('layouts.app')

@section('content')
    <!-- Top Bar Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Katalog Produk Internal</h1>
            <p class="text-sm text-gray-500 mt-0.5">Pantau status visibilitas dan harga komoditas produk utama.</p>
        </div>
        <div>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                Tambah Komoditas <i class="fa-solid fa-circle-plus text-[10px]"></i>
            </a>
        </div>
    </div>

    <!-- Container Data Tabel -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">Nama Produk</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Harga Jual / Satuan</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Status</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $product->nama_produk }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-emerald-700">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }} <span
                                    class="text-xs text-gray-400 font-normal">/ {{ $product->satuan }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if (strtolower($product->status) == 'aktif')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-wide">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Detail & Stok -->
                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                        class="inline-flex items-center gap-1 bg-gray-50 hover:bg-emerald-50 text-gray-600 hover:text-emerald-700 font-bold px-2.5 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-emerald-200 transition-all cursor-pointer">
                                        <i class="fa-solid fa-cubes text-xs"></i> Stok Antrean
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="inline-flex items-center gap-1 bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-700 font-bold px-2.5 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-blue-200 transition-all cursor-pointer">
                                        <i class="fa-regular fa-pen-to-square text-xs"></i> Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Menghapus produk dapat berdampak pada data relasi antrean stok petani. Lanjutkan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 text-xs font-bold transition-all border border-red-200/50 px-2.5 py-1.5 rounded-lg cursor-pointer">
                                            <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-boxes-blank text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada komoditas terdaftar dalam katalog.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
