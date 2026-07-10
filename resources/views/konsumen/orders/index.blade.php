@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Riwayat Belanja Saya</h1>
    <table class="w-full bg-white border text-sm shadow-sm rounded">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">No Order</th>
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-left">Total Belanja</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
                <tr class="border-b">
                    <td class="p-2 font-mono font-bold">{{ $o->no_order }}</td>
                    <td class="p-2">{{ $o->tanggal_pesan->format('Y-m-d') }}</td>
                    <td class="p-2">Rp {{ number_format($o->total_harga) }}</td>
                    <td class="p-2 uppercase text-xs font-bold text-yellow-600">{{ $o->status }}</td>
                    <td class="p-2">
                        <a href="{{ route('konsumen.orders.show', $o->id) }}"
                            class="text-blue-500 hover:underline text-xs">Lihat Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $orders->links() }}</div>
@endsection
