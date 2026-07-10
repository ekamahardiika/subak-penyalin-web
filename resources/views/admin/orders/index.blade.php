@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Semua Pesanan Masuk</h1>
    <table class="w-full bg-white border text-sm">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">No Order</th>
                <th class="p-2 text-left">Konsumen</th>
                <th class="p-2 text-left">Total</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
                <tr class="border-b">
                    <td class="p-2">{{ $o->no_order }}</td>
                    <td class="p-2">{{ $o->user->name }}</td>
                    <td class="p-2">Rp {{ number_format($o->total_harga) }}</td>
                    <td class="p-2">
                        <span
                            class="px-2 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">{{ $o->status }}</span>
                    </td>
                    <td class="p-2">
                        <a href="{{ route('admin.orders.show', $o->id) }}" class="text-blue-500 hover:underline">Kelola</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $orders->links() }}</div>
@endsection
