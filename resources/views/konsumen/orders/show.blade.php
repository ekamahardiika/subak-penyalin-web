@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <a href="{{ route('konsumen.orders.index') }}"
        class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-emerald-700 mb-4 transition-colors">
        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Riwayat Pesanan
    </a>

    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3 mb-6">
        <div>
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Invoice</p>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight font-mono">{{ $order->no_order }}</h1>
        </div>

        @php
            $statusLower = strtolower($order->status);
        @endphp
        @if (in_array($statusLower, ['selesai', 'success', 'lunas']))
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide w-fit">
                {{ $order->status }}
            </span>
        @elseif(in_array($statusLower, ['pending', 'menunggu', 'proses', 'dikonfirmasi', 'diproses']))
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wide w-fit">
                {{ $order->status }}
            </span>
        @else
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200 uppercase tracking-wide w-fit">
                {{ $order->status }}
            </span>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- DAFTAR PRODUK YANG DIPESAN -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-sm text-gray-800">Produk Dipesan</h3>
            </div>

            <div class="divide-y divide-gray-100">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4 p-5">
                        <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden shrink-0">
                            @if ($item->product && $item->product->gambar)
                                <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                    alt="{{ $item->product->nama_produk }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fa-solid fa-wheat-awn text-xl"></i>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">
                                {{ $item->product->nama_produk ?? 'Produk telah dihapus' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $item->qty }} {{ $item->product->satuan ?? '' }} &times;
                                Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            </p>
                        </div>

                        <p class="text-sm font-bold text-gray-900 shrink-0">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach

                @if ($order->items->isEmpty())
                    <div class="text-center text-gray-400 text-sm py-10">
                        <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
                        <p class="mt-2">Tidak ada produk pada pesanan ini.</p>
                    </div>
                @endif
            </div>

            <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
                <span class="text-sm font-medium text-gray-500">Total Belanja</span>
                <span class="text-lg font-bold text-emerald-700">
                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- INFORMASI PESANAN -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="bg-emerald-950 text-white px-5 py-4">
                <h3 class="font-bold text-sm tracking-wide uppercase">Informasi Pesanan</h3>
            </div>

            <div class="p-5 space-y-4 text-sm">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">No Order</p>
                    <p class="font-mono font-bold text-gray-800 mt-1">{{ $order->no_order }}</p>
                </div>

                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Tanggal Pesan</p>
                    <p class="text-gray-700 mt-1">
                        {{ $order->tanggal_pesan ? $order->tanggal_pesan->format('d M Y, H:i') : '-' }}
                    </p>
                </div>

                @if ($order->nama_pemesan)
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Nama Pemesan</p>
                        <p class="text-gray-700 mt-1">{{ $order->nama_pemesan }}</p>
                    </div>
                @endif

                @if ($order->whatsapp_pemesan)
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">WhatsApp</p>
                        <p class="text-gray-700 mt-1">{{ $order->whatsapp_pemesan }}</p>
                    </div>
                @endif

                @if ($order->catatan)
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Catatan</p>
                        <p class="text-gray-700 mt-1 leading-relaxed">{{ $order->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
