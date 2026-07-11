@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Panel Konsumen</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Pantau riwayat belanjaan dan informasi harga gabah
            terkini.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div
            class="bg-gradient-to-br from-emerald-900 to-emerald-950 p-6 rounded-xl shadow-xs flex items-center justify-between text-white">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Total Belanja Selesai</h3>
                <p class="text-2xl font-black tracking-tight">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
            </div>
            <div class="bg-white/10 text-emerald-400 p-3.5 rounded-xl border border-white/10">
                <i class="fa-solid fa-wallet text-xl"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Frekuensi Transaksi</h3>
                <p class="text-2xl font-extrabold text-gray-900 tracking-tight">
                    {{ $totalTransaksi }} <span class="text-sm font-semibold text-gray-500">Kali</span>
                </p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3.5 rounded-xl border border-emerald-100">
                <i class="fa-solid fa-bag-shopping text-xl"></i>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between sm:col-span-2 lg:col-span-1">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Harga Acuan Gabah Hari Ini</h3>
                @if ($hargaHariIni)
                    <p class="text-2xl font-extrabold text-amber-600 tracking-tight">
                        Rp {{ number_format($hargaHariIni->harga_gabah, 0, ',', '.') }}<span
                            class="text-sm font-semibold text-gray-500"> / KG</span>
                    </p>
                @else
                    <p class="text-sm font-medium text-gray-400 pt-1">Belum ada rilis harga.</p>
                @endif
            </div>
            <div class="bg-amber-50 text-amber-600 p-3.5 rounded-xl border border-amber-100">
                <i class="fa-solid fa-wheat-awn text-xl"></i>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-100 shadow-xs">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-sm font-bold text-gray-700 tracking-tight">Riwayat Transaksi Terakhir</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Status pelacakan aktivitas pembelian Anda.</p>
                </div>
                <a href="{{ route('konsumen.orders.index') }}"
                    class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg transition-colors">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">No. Order</th>
                            <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                            <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Total</th>
                            <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50/40 transition-colors">
                                <td class="p-3 font-semibold text-gray-800">{{ $order->no_order }}</td>
                                <td class="p-3 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="p-3 font-bold text-gray-900">Rp
                                    {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    @if ($order->status == 'pending')
                                        <span
                                            class="px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 rounded-md border border-amber-100">Pending</span>
                                    @elseif($order->status == 'selesai')
                                        <span
                                            class="px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">Selesai</span>
                                    @else
                                        <span
                                            class="px-2.5 py-1 text-xs font-semibold bg-gray-50 text-gray-600 rounded-md border border-gray-100">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400 text-sm">Anda belum pernah melakukan
                                    pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">Komoditas Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Produk gabah/beras segar siap dipesan hari ini.</p>

                <div class="mt-4 space-y-3">
                    @forelse($availableProducts as $product)
                        <div
                            class="flex items-center gap-3 p-2 rounded-lg border border-gray-50 hover:border-emerald-100 hover:bg-emerald-50/20 transition-all">
                            <div class="bg-emerald-50 text-emerald-600 p-2.5 rounded-lg text-sm">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</p>
                                <p class="text-xs text-emerald-600 font-bold">Rp
                                    {{ number_format($product->price ?? 0, 0, ',', '.') }} / KG</p>
                            </div>
                            <a href="{{ route('konsumen.products.show', $product->id) }}"
                                class="text-gray-400 hover:text-emerald-600 px-2 py-1">
                                <i class="fa-solid fa-angle-right text-xs"></i>
                            </a>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada komoditas terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-gray-50">
                <a href="{{ route('konsumen.products.index') }}"
                    class="block w-full text-center text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 py-2.5 rounded-xl transition-colors shadow-xs">
                    Mulai Belanja Gabah <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>
@endsection
