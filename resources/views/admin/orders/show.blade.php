@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-2">Detail Transaksi #{{ $order->no_order }}</h1>
    <div class="bg-white p-4 border rounded text-sm space-y-2 mb-4">
        <p><strong>Nama Konsumen:</strong> {{ $order->user->name }}</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($order->total_harga) }}</p>
        <p><strong>Status Saat Ini:</strong> <span class="uppercase font-bold">{{ $order->status }}</span></p>

        <div class="flex gap-2 pt-2 border-t">
            @if ($order->status == 'pending')
                <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs">Konfirmasi
                        Langsung</button>
                </form>
            @endif

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                class="flex gap-1 items-center">
                @csrf @method('PATCH')
                <select name="status" class="border text-xs p-1 rounded">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dikonfirmasi" {{ $order->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-xs">Update</button>
            </form>
        </div>
    </div>

    <h3 class="font-bold mb-2 text-sm">Item Produk Terbeli:</h3>
    @foreach ($order->items as $item)
        <div class="p-2 bg-gray-50 border rounded text-xs">
            {{ $item->product->nama_produk }} - {{ $item->qty }} {{ $item->product->satuan }} x Rp
            {{ number_format($item->harga_satuan) }}
        </div>
    @endforeach
@endsection
