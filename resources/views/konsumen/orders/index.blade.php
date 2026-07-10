@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Belanja Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar seluruh transaksi pembelian gabah dan status pemrosesan pesanan Anda.
        </p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">No Order</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Tanggal</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Total Belanja</th>
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
                            <td class="px-6 py-4 text-gray-500">
                                {{ $o->tanggal_pesan ? $o->tanggal_pesan->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                Rp {{ number_format($o->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if (in_array(strtolower($o->status), ['selesai', 'success', 'lunas']))
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wide">
                                        {{ $o->status }}
                                    </span>
                                @elseif(in_array(strtolower($o->status), ['pending', 'menunggu', 'proses']))
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-wide">
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
                                <a href="{{ route('konsumen.orders.show', $o->id) }}"
                                    class="inline-flex items-center gap-1.5 bg-gray-50 hover:bg-emerald-50 hover:text-emerald-700 text-gray-600 font-semibold px-3 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-emerald-200 transition-all cursor-pointer">
                                    <i class="fa-regular fa-file-lines text-xs"></i> Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-basket-shopping text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada riwayat transaksi belanja.</p>
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
