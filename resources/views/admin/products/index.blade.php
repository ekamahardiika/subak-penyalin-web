@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Katalog Produk Internal</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-emerald-600 text-white px-3 py-1 rounded text-sm">Tambah
            Komoditas Produk</a>
    </div>
    <table class="w-full bg-white border text-sm">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">Nama Produk</th>
                <th class="p-2 text-left">Harga Jual</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-b">
                    <td class="p-2">{{ $product->nama_produk }}</td>
                    <td class="p-2">Rp {{ number_format($product->harga_jual) }} / {{ $product->satuan }}</td>
                    <td class="p-2 uppercase text-xs font-bold">{{ $product->status }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('admin.products.show', $product->id) }}"
                            class="text-green-500 hover:underline text-xs">Detail & Stok</a>
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="text-blue-500 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $products->links() }}</div>
@endsection
