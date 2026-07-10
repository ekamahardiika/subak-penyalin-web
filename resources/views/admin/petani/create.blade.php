@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Tambah Akun Petani Baru</h1>
    <form action="{{ route('admin.petani.store') }}" method="POST" class="max-w-md bg-white p-4 border rounded space-y-3">
        @csrf
        <div>
            <label class="block text-sm">Nama Lengkap</label>
            <input type="text" name="name" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Email</label>
            <input type="email" name="email" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Nomor Telepon</label>
            <input type="text" name="phone" class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Password Minimal 6 Karakter</label>
            <input type="password" name="password" required class="w-full border p-1 rounded">
        </div>
        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 text-sm rounded">Simpan Petani</button>
    </form>
@endsection
