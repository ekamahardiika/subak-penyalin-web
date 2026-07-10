@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Tambah Produk Baru</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-md bg-white p-4 border rounded space-y-3">
        @csrf
        <div>
            <label class="block text-sm">Nama Produk</label>
            <input type="text" name="nama_produk" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Harga Jual</label>
            <input type="number" name="harga_jual" required class="w-full border p-1 rounded" min="0">
        </div>
        <div>
            <label class="block text-sm">Satuan Jual</label>
            <input type="text" name="satuan" value="kg" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Status</label>
            <select name="status" class="w-full border p-1 rounded">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
        <div>
            <label class="block text-sm">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-1 rounded"></textarea>
        </div>
        <div>
            <label class="block text-sm">Gambar Produk</label>
            <input type="file" name="gambar" class="w-full text-xs">
        </div>
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 text-sm rounded">Simpan Produk</button>
    </form>
@endsection
