@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Daftar Akun Petani</h1>
        <a href="{{ route('admin.petani.create') }}" class="bg-emerald-600 text-white px-3 py-1 rounded text-sm">Tambah
            Petani</a>
    </div>
    <table class="w-full bg-white border text-sm">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Email</th>
                <th class="p-2 text-left">No. Hp</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petani as $p)
                <tr class="border-b">
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2">{{ $p->email }}</td>
                    <td class="p-2">{{ $p->phone ?? '-' }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('admin.petani.edit', $p->id) }}"
                            class="text-blue-500 hover:underline text-xs">Edit</a>
                        <form action="{{ route('admin.petani.destroy', $p->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $petani->links() }}</div>
@endsection
