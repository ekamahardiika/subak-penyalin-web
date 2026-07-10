@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Panel Konsumen</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Pantau riwayat belanjaan dan informasi harga gabah
            terkini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi Belanja</h3>
                <p class="text-2xl font-extrabold text-emerald-600 tracking-tight">
                    {{ $totalTransaksi }} <span class="text-sm font-semibold text-gray-500">Kali Pembelian</span>
                </p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3.5 rounded-xl border border-emerald-100">
                <i class="fa-solid fa-bag-shopping text-xl"></i>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 p-6 rounded-xl border border-emerald-200/60 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Harga Acuan Gabah Hari Ini</h3>
                @if ($hargaHariIni)
                    <p class="text-2xl font-extrabold text-emerald-950 tracking-tight">
                        Rp {{ number_format($hargaHariIni->harga_gabah, 0, ',', '.') }}<span
                            class="text-sm font-semibold text-emerald-700"> / KG</span>
                    </p>
                @else
                    <p class="text-sm font-medium text-emerald-700/80 pt-1">Belum ada rilis harga acuan dari admin.</p>
                @endif
            </div>
            <div class="bg-white text-emerald-700 p-3.5 rounded-xl border border-emerald-200/50 shadow-xs">
                <i class="fa-solid fa-wheat-awn text-xl"></i>
            </div>
        </div>

    </div>
@endsection
