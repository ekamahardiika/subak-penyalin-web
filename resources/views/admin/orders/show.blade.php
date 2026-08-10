@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.orders.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Semua Pesanan
        </a>
    </div>

    <div class="w-full space-y-6">

        <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-900 to-emerald-950 p-6 text-white flex justify-between items-center">
                <div class="space-y-1">
                    <p class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Detail Kontrol Transaksi</p>
                    <h2 class="text-xl font-mono font-bold tracking-tight">#{{ $order->no_order }}</h2>
                </div>
                <div>
                    <span
                        class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide border backdrop-blur-xs
                        {{ $order->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : '' }}
                        {{ $order->status === 'diproses' ? 'bg-amber-500/10 text-amber-400 border-amber-500/20' : '' }}
                        {{ $order->status === 'dibatalkan' ? 'bg-red-500/10 text-red-400 border-red-500/20' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <div class="p-6 border-b border-gray-50 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nama Konsumen</p>
                    <p class="font-semibold text-gray-800 flex items-center gap-1.5">
                        <i class="fa-regular fa-user text-gray-400"></i> {{ $order->user->name ?? '-' }}
                    </p>
                </div>
                <div class="sm:text-right space-y-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Total Kewajiban Bayar</p>
                    <p class="text-lg font-black text-emerald-600 tracking-tight">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div x-data="{}"
                class="p-6 bg-gray-50/50 border-b border-gray-50 flex flex-wrap items-center justify-between gap-4">
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi Cepat Admin :</div>

                @if ($order->status === 'diproses')
                    <div class="flex flex-wrap items-center gap-3">
                        <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST"
                            @submit.prevent="$dispatch('open-confirm-modal', {
                                form: $el,
                                type: 'primary',
                                title: 'Selesaikan Pesanan?',
                                message: 'Stok petani akan dikurangi sesuai item pesanan ini. Tindakan ini tidak dapat dibatalkan.',
                                confirmLabel: 'Ya, Selesaikan'
                            })">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-circle-check"></i> Tandai Selesai
                            </button>
                        </form>

                        <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST"
                            @submit.prevent="$dispatch('open-confirm-modal', {
                                form: $el,
                                type: 'danger',
                                title: 'Batalkan Pesanan?',
                                message: 'Pesanan ini akan dibatalkan dan tidak dapat diproses lagi.',
                                confirmLabel: 'Ya, Batalkan'
                            })">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-semibold px-4 py-2 rounded-xl text-xs transition-all border border-red-200/50 flex items-center gap-1.5 cursor-pointer">
                                <i class="fa-solid fa-ban"></i> Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                @else
                    <span class="text-xs text-gray-400 italic">Status final — tidak dapat diubah lagi.</span>
                @endif
            </div>

            <div class="p-6 space-y-4">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Item Produk Terbeli</h3>

                <div class="space-y-2">
                    @foreach ($order->items as $item)
                        <div
                            class="p-4 bg-white border border-gray-100 rounded-xl text-sm flex justify-between items-center shadow-2xs">
                            <div class="flex items-center gap-3">
                                <div
                                    class="bg-emerald-50 text-emerald-700 p-2 rounded-xl border border-emerald-100 text-xs">
                                    <i class="fa-solid fa-wheat-awn"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">
                                        {{ $item->product->nama_produk ?? 'Komoditas Gabah' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        Kuantitas: <span class="font-bold text-gray-600">{{ $item->qty }}
                                            {{ $item->product->satuan ?? 'KG' }}</span>
                                        <span class="mx-1 text-gray-300">•</span>
                                        Harga Satuan: <span class="font-medium text-gray-500">Rp
                                            {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                            <span class="font-bold text-gray-900">
                                Rp {{ number_format($item->qty * $item->harga_satuan, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
