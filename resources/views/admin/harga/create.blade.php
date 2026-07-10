@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Buat Broadcast Harga Gabah</h1>
    <form action="{{ route('admin.harga.store') }}" method="POST" class="max-w-md bg-white p-4 border rounded space-y-3">
        @csrf
        <div>
            <label class="block text-sm">Tanggal Berlaku</label>
            <input type="date" name="tanggal" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Harga Gabah (Rp/KG)</label>
            <input type="number" name="harga_gabah" required class="w-full border p-1 rounded" min="0">
        </div>
        <div>
            <label class="block text-sm">Keterangan</label>
            <textarea name="keterangan" class="w-full border p-1 rounded"></textarea>
        </div>
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 text-sm rounded">Simpan & Siarkan</button>
    </form>
@endsection
