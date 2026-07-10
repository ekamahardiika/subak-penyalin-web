@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Riwayat Broadcast Harga</h1>
        <a href="{{ route('admin.harga.create') }}" class="bg-emerald-600 text-white px-3 py-1 rounded text-sm">Buat Broadcast
            Baru</a>
    </div>
    <table class="w-full bg-white border rounded text-sm">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-left">Harga / KG</th>
                <th class="p-2 text-left">Keterangan</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($broadcasts as $b)
                <tr class="border-b">
                    <td class="p-2">{{ $b->tanggal }}</td>
                    <td class="p-2">Rp {{ number_format($b->harga_gabah) }}</td>
                    <td class="p-2">{{ $b->keterangan }}</td>
                    <td class="p-2">
                        <form action="{{ route('admin.harga.destroy', $b->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $broadcasts->links() }}</div>
@endsection
