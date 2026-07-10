@extends('layouts.app')

@section('content')
    <!-- Header Page -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Semua Pesanan Masuk</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola, konfirmasi pembayaran, dan pantau status logistik pengiriman gabah
            seluruh konsumen.</p>
    </div>

    <!-- Container Tabel dengan Overflow Control -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">No Order</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Nama Konsumen</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Total Nilai</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Status</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($orders as $o)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-emerald-950">
                                {{ $o->no_order }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $o->user->name ?? 'Konsumen Tidak Dikenal' }}
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                Rp {{ number_format($o->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <!-- Badge Status Dinamis Dinormalisasi -->
                                @if (in_array(strtolower($o->status), ['selesai', 'success']))
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide">
                                        {{ $o->status }}
                                    </span>
                                @elseif(in_array(strtolower($o->status), ['pending', 'menunggu']))
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wide">
                                        {{ $o->status }}
                                    </span>
                                @elseif(in_array(strtolower($o->status), ['dikonfirmasi', 'diproses']))
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 uppercase tracking-wide">
                                        {{ $o->status }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200 uppercase tracking-wide">
                                        {{ $o->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.orders.show', $o->id) }}"
                                    class="inline-flex items-center gap-1 bg-gray-50 hover:bg-emerald-50 hover:text-emerald-700 text-gray-600 font-bold px-3 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-emerald-200 transition-all cursor-pointer">
                                    <i class="fa-solid fa-gear text-xs"></i> Kelola
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-inbox text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada pesanan masuk saat ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
@endsection
