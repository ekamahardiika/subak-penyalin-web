@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan data operasional sistem, kontrol pasokan stok, dan akumulasi omset
            platform.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mitra Petani</h3>
                <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $totalPetani }} <span
                        class="text-xs font-medium text-gray-400">Orang</span></p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-users text-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Stok Gudang</h3>
                <p class="text-2xl font-extrabold text-emerald-600 tracking-tight">
                    {{ number_format($totalStokGabah, 0, ',', '.') }} <span
                        class="text-xs font-medium text-gray-400">KG</span></p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-boxes-stacked text-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi</h3>
                <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $totalTransaksi }} <span
                        class="text-xs font-medium text-gray-400">Kali</span></p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-receipt text-lg"></i>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-900 to-emerald-950 p-5 rounded-xl shadow-xs flex items-center justify-between text-white">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Omset Selesai</h3>
                <p class="text-xl font-black tracking-tight">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/10 text-emerald-400 p-3 rounded-xl border border-white/10">
                <i class="fa-solid fa-wallet text-lg"></i>
            </div>
        </div>

    </div>
@endsection
