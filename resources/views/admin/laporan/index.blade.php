@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-4">Laporan Penjualan Selesai</h1>
    <form action="{{ route('admin.laporan.index') }}" method="GET"
        class="flex gap-2 items-end mb-4 bg-white p-3 border rounded text-sm">
        <div>
            <label class="block text-xs text-gray-500">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-1 rounded">
        </div>
        <div>
            <label class="block text-xs text-gray-500">Tanggal Akhir</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-1 rounded">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Filter</button>
        <a href="{{ route('admin.laporan.index') }}" class="bg-gray-300 px-3 py-1 rounded">Reset</a>
    </form>

    <div class="bg-emerald-50 border p-3 rounded mb-4 font-bold text-sm">
        Total Omset Penjualan Terfilter: Rp {{ number_format($totalPenjualan, 2) }}
    </div>

    <table class="w-full bg-white border text-sm">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-2 text-left">No Order</th>
                <th class="p-2 text-left">Konsumen</th>
                <th class="p-2 text-left">Tgl Selesai</th>
                <th class="p-2 text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $o)
                <tr class="border-b">
                    <td class="p-2">{{ $o->no_order }}</td>
                    <td class="p-2">{{ $o->user->name }}</td>
                    <td class="p-2">{{ $o->updated_at->format('Y-m-d') }}</td>
                    <td class="p-2 text-right">Rp {{ number_format($o->total_harga) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">{{ $orders->links() }}</div>
@endsection
