@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-2">Nota Tagihan Pembelian</h1>
    <div class="bg-white p-4 border rounded text-sm space-y-2 mb-4 shadow-sm">
        <p><strong>Kode Order:</strong> {{ $order->no_order }}</p>
        <p><strong>Waktu Pesan:</strong> {{ $order->tanggal_pesan }}</p>
        <p><strong>Status Pembayaran/Proses:</strong> <span
                class="uppercase font-bold text-blue-600">{{ $order->status }}</span></p>
        <p class="text-lg font-bold border-t pt-2">Total Transfer: Rp {{ number_format($order->total_harga) }}</p>
    </div>

    <h3 class="font-bold mb-2 text-sm">Rincian Item Gabah:</h3>
    @foreach ($order->items as $item)
        <div class="p-3 bg-gray-50 border rounded text-xs flex justify-between">
            <span>{{ $item->product->nama_produk }} ({{ $item->qty }} KG)</span>
            <strong>Rp {{ number_format($item->subtotal) }}</strong>
        </div>
    @endforeach
@endsection
