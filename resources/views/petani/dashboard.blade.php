@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Panel Kerja Petani</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau pasokan komoditas Anda serta pantau pergerakan harga acuan pasar hari
            ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Akumulasi Total Stok Anda</h3>
                <p class="text-2xl font-extrabold text-emerald-600 tracking-tight">
                    {{ number_format($totalStokSaya, 2, ',', '.') }} <span
                        class="text-sm font-semibold text-gray-500">KG</span>
                </p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3.5 rounded-xl border border-emerald-100">
                <i class="fa-solid fa-boxes-stacked text-xl"></i>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-amber-50 to-amber-100/40 p-6 rounded-xl border border-amber-200/70 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-amber-800 uppercase tracking-wider">Harga Acuan Pasar Hari Ini</h3>
                @if ($hargaTerbaru)
                    <p class="text-2xl font-extrabold text-amber-950 tracking-tight">
                        Rp {{ number_format($hargaTerbaru->harga_gabah, 0, ',', '.') }}<span
                            class="text-sm font-semibold text-amber-700"> / KG</span>
                    </p>
                    <p class="text-xs text-amber-800/80 mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-info text-[10px]"></i> {{ $hargaTerbaru->keterangan }}
                    </p>
                @else
                    <p class="text-sm font-medium text-amber-700/80 pt-1">Belum ada rilis harga acuan resmi dari admin.</p>
                @endif
            </div>
            <div class="bg-white text-amber-600 p-3.5 rounded-xl border border-amber-200/50 shadow-xs">
                <i class="fa-solid fa-wheat-awn text-xl"></i>
            </div>
        </div>

    </div>
@endsection
