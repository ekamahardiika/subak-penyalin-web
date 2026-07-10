@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('konsumen.orders.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Riwayat Belanja
        </a>
    </div>

    <div class="max-w-3xl mx-auto space-y-6">

        <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-900 to-emerald-950 p-6 text-white flex justify-between items-center">
                <div class="space-y-1">
                    <p class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Nota Tagihan Pembelian</p>
                    <h2 class="text-xl font-mono font-bold tracking-tight">{{ $order->no_order }}</h2>
                </div>
                <div class="text-right">
                    <div
                        class="bg-white/10 text-white backdrop-blur-xs px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide border border-white/10">
                        {{ $order->status }}
                    </div>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 border-b border-gray-50 text-sm">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Waktu Pemesanan</p>
                    <p class="font-medium text-gray-700">
                        {{ \Carbon\Carbon::parse($order->tanggal_pesan)->format('d F Y, H:i') }} WITA
                    </p>
                </div>
                <div class="sm:text-right">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Metode Pembayaran</p>
                    <p class="font-medium text-gray-700">Transfer Bank (Verifikasi Manual)</p>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Rincian Item Gabah</h3>

                <div class="space-y-2">
                    @foreach ($order->items as $item)
                        <div
                            class="p-4 bg-gray-50/70 border border-gray-100 rounded-xl text-sm flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="bg-emerald-100 text-emerald-800 p-2 rounded-lg text-xs">
                                    <i class="fa-solid fa-wheat-awn"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">
                                        {{ $item->product->nama_produk ?? 'Produk Gabah' }}</p>
                                    <p class="text-xs text-gray-400">Kuantitas: <span
                                            class="font-semibold text-gray-600">{{ $item->qty }} KG</span></p>
                                </div>
                            </div>
                            <strong class="font-bold text-gray-900">Rp
                                {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 flex justify-between items-center mt-6">
                    <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Pembayaran</span>
                    <span class="text-xl font-black text-emerald-600 tracking-tight">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-amber-50/60 border border-amber-200/60 p-4 rounded-xl text-xs text-amber-800 flex gap-3">
            <i class="fa-solid fa-circle-info text-sm text-amber-600 mt-0.5"></i>
            <div>
                <span class="font-bold">Informasi Pembayaran:</span> Jika status pesanan Anda masih <span
                    class="uppercase font-bold">pending</span>, harap lakukan transfer tepat senilai total pembayaran ke
                nomor rekening penyedia dan kirimkan bukti transfer kepada admin atau petani terkait.
            </div>
        </div>

    </div>
@endsection
