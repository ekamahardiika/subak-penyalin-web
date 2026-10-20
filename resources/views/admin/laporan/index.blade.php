@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Laporan Penjualan Selesai</h1>
        <p class="text-sm text-gray-500 mt-0.5">Pantau ringkasan pendapatan dari seluruh pesanan yang telah berhasil
            diselesaikan.</p>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6 items-start">

        <div class="lg:col-span-2 bg-white p-4 border border-gray-100 rounded-xl shadow-xs">
            <span class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-3 flex items-center gap-1">
                <i class="fa-regular fa-calendar-days text-emerald-600"></i> Rentang Periode Laporan
            </span>

            <form action="{{ route('admin.laporan.index') }}" method="GET"
                class="flex flex-col sm:flex-row gap-3 items-end text-sm">
                <div class="w-full">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide mb-1.5">Tanggal
                        Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-2xs" />
                </div>
                <div class="w-full">
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wide mb-1.5">Tanggal
                        Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="block w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-2xs" />
                </div>
                <div class="flex gap-2 w-full sm:w-auto pt-2 sm:pt-0">
                    <button type="submit"
                        class="flex-1 sm:flex-none bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition-all shadow-xs cursor-pointer whitespace-nowrap">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex-1 sm:flex-none text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap">
                        Reset
                    </a>

                    <a href="{{ route('admin.laporan.export-pdf', request()->query()) }}"
                        class="flex-1 sm:flex-none text-center bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 font-semibold px-4 py-2 rounded-xl text-xs transition-all cursor-pointer whitespace-nowrap border border-red-200/50 flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-file-pdf"></i> PDF
                    </a>
                </div>
            </form>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-800 to-emerald-950 p-5 rounded-xl border border-emerald-900 text-white shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span
                    class="text-[10px] font-bold uppercase tracking-widest bg-emerald-700 text-emerald-200 px-2 py-0.5 rounded border border-emerald-600/50">
                    Total Omset Terfilter
                </span>
                <h3 class="text-xl font-black font-mono tracking-tight mt-1.5">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </h3>
            </div>
            <div class="text-emerald-400/30 text-3xl pr-2">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">No. Order / Transaksi</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Nama Konsumen</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Tanggal Selesai</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-right">Total Pendapatan (Nett)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($orders as $o)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-gray-900">
                                #{{ $o->no_order }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-700">
                                {{ $o->user->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                {{ $o->updated_at->format('d M Y, H:i') }} WIB
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-700 font-mono">
                                Rp {{ number_format($o->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-receipt text-3xl text-gray-300"></i>
                                    <p class="text-sm">Tidak ditemukan riwayat data transaksi penjualan selesai pada periode
                                        ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection
