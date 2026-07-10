@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Akun Konsumen</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
        class="max-w-md bg-white p-4 border rounded space-y-3">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $user->name }}" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ $user->phone }}" class="w-full border p-1 rounded">
        </div>
        <div>
            <label class="block text-sm">Ganti Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border p-1 rounded">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 text-sm rounded">Update Data</button>
    </form>
@endsection
