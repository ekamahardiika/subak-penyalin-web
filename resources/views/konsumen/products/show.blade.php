@extends('layouts.app')
@section('content')
    <h1 class="text-xl font-bold mb-2">Form Order Checkout</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-4 border rounded shadow-sm">
        <div>
            <h2 class="text-lg font-bold text-gray-800">{{ $product->nama_produk }}</h2>
            <p class="text-xl font-extrabold text-emerald-600 my-2">Harga: Rp {{ number_format($product->harga_jual) }}</p>
            <p class="text-sm text-gray-600 mb-4">{{ $product->deskripsi }}</p>

            <div class="p-2 bg-blue-50 border border-blue-200 text-blue-800 rounded text-xs inline-block">
                Sisa Total Ketersediaan Stok Nasional: <strong>{{ number_format($stokTersedia, 2) }} KG</strong>
            </div>
        </div>

        <!-- Form Beli Langsung (Triggering Real-time FIFO Allocation) -->
        <div class="bg-gray-50 p-4 border rounded">
            <h3 class="font-bold text-sm mb-3">Masukkan Jumlah Pesanan</h3>
            <form action="{{ route('konsumen.orders.store') }}" method="POST" class="space-y-3 text-sm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div>
                    <label class="block text-xs font-medium">Kuantitas Pembelian (KG)</label>
                    <input type="number" name="qty" required class="w-full border p-1 rounded bg-white" min="1"
                        max="{{ $stokTersedia }}">
                </div>
                <button type="submit"
                    class="w-full bg-emerald-600 text-white py-2 rounded font-bold hover:bg-emerald-700">Buat Pesanan &
                    Bayar Sekarang</button>
            </form>
        </div>
    </div>
@endsection
