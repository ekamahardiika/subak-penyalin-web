@extends('layouts.app')

@section('title', 'Penjualan Petani')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Penjualan</h1>
        <p class="text-sm text-gray-500 mt-1">Rincian kg terjual dan pendapatan dari pesanan berstatus selesai.</p>
    </div>

    <form method="GET" action="{{ route('petani.penjualan.index') }}"
        class="bg-white p-4 rounded-xl border border-gray-100 shadow-xs mb-6 flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $startDate }}"
                class="rounded-lg border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $endDate }}"
                class="rounded-lg border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500">
        </div>
        <button type="submit"
            class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors cursor-pointer">
            Terapkan Filter
        </button>
        <a href="{{ route('petani.penjualan.index') }}"
            class="text-sm font-semibold text-gray-500 hover:text-gray-700 px-2 py-2">
            Reset ke Bulan Ini
        </a>

        <a href="{{ route('petani.penjualan.export-pdf', request()->query()) }}"
            class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 text-sm font-bold px-4 py-2 rounded-lg transition-colors cursor-pointer border border-red-200/50">
            <i class="fa-solid fa-file-pdf"></i> Download PDF
        </a>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kg Terjual (Periode Ini)</h3>
                <p class="text-2xl font-extrabold text-sky-600 tracking-tight">
                    {{ number_format($totalKg, 2, ',', '.') }} <span class="text-sm font-semibold text-gray-500">KG</span>
                </p>
            </div>
            <div class="bg-sky-50 text-sky-600 p-3.5 rounded-xl border border-sky-100">
                <i class="fa-solid fa-truck-ramp-box text-xl"></i>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-violet-50 to-violet-100/40 p-6 rounded-xl border border-violet-200/70 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-violet-800 uppercase tracking-wider">Total Pendapatan (Periode Ini)</h3>
                <p class="text-2xl font-extrabold text-violet-950 tracking-tight">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </p>
            </div>
            <div class="bg-white text-violet-600 p-3.5 rounded-xl border border-violet-200/50 shadow-xs">
                <i class="fa-solid fa-sack-dollar text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs">
        <h3 class="text-sm font-bold text-gray-700 tracking-tight mb-4">Detail Transaksi</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">No Order</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Komoditas</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Kg Terjual</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Harga/Kg</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Pendapatan</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($penjualan as $alloc)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="p-3 font-semibold text-gray-800">{{ $alloc->orderItem->order->no_order ?? '-' }}</td>
                            <td class="p-3 text-gray-700">{{ $alloc->petaniStock->product->nama_produk ?? '-' }}</td>
                            <td class="p-3 text-gray-600">{{ number_format($alloc->jumlah_kg, 2, ',', '.') }} KG</td>
                            <td class="p-3 text-gray-600">Rp
                                {{ number_format($alloc->orderItem->harga_satuan, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold text-violet-600">
                                Rp {{ number_format($alloc->jumlah_kg * $alloc->orderItem->harga_satuan, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-gray-500">
                                {{ $alloc->orderItem->order->tanggal_pesan->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-400 text-sm">Belum ada penjualan pada
                                periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $penjualan->links() }}
        </div>
    </div>
@endsection
