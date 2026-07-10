@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Manajemen Stok Gabah Mandiri</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Form Tambah/Setor -->
        <div class="bg-white p-4 border rounded shadow-sm h-fit">
            <h2 class="font-bold text-sm mb-3">Setor / Tambah Pasokan Stok</h2>
            <form action="{{ route('petani.stok.store') }}" method="POST" class="space-y-3 text-sm">
                @csrf
                <div>
                    <label class="block text-xs font-medium">Pilih Varietas / Produk Komoditas</label>
                    <select name="product_id" required class="w-full border p-1 rounded bg-white">
                        @foreach ($products as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_produk }} (Rp
                                {{ number_format($p->harga_jual) }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium">Jumlah Ditambahkan (KG)</label>
                    <input type="number" step="0.01" name="stok_kg" required class="w-full border p-1 rounded"
                        min="0">
                </div>
                <button type="submit" class="w-full bg-emerald-600 text-white py-1 rounded font-medium">Setor Tambah
                    Stok</button>
            </form>
        </div>

        <!-- Tabel List Stok Aktif -->
        <div class="bg-white p-4 border rounded shadow-sm md:col-span-2">
            <h2 class="font-bold text-sm mb-3">Daftar Stok Gabah Anda di Gudang</h2>
            <div class="space-y-3">
                @forelse($stocks as $stock)
                    <div class="p-3 bg-gray-50 border rounded text-xs flex justify-between items-center">
                        <div>
                            <p class="font-bold text-sm">{{ $stock->product->nama_produk }}</p>
                            <p class="text-gray-500">Sisa Stok Siap Alokasi: <span
                                    class="text-emerald-600 font-bold">{{ number_format($stock->stok_kg, 2) }} KG</span></p>
                        </div>
                        <!-- Form Koreksi/Update Langsung -->
                        <form action="{{ route('petani.stok.update', $stock->id) }}" method="POST"
                            class="flex items-center gap-1">
                            @csrf @method('PATCH')
                            <input type="number" step="0.01" name="stok_kg" value="{{ $stock->stok_kg }}" required
                                class="w-16 border p-0.5 text-center bg-white rounded" min="0">
                            <button type="submit"
                                class="bg-blue-600 text-white px-2 py-0.5 rounded text-[10px]">Koreksi</button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 text-xs">Anda belum menyetor stok produk apa pun.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
