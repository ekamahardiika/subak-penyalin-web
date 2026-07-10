@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-2">Panel Konsumen</h1>
    <div class="flex gap-2 mb-4 text-sm">
        <a href="{{ route('konsumen.dashboard') }}" class="bg-emerald-600 text-white px-3 py-1 rounded">Menu Utama</a>
        <a href="{{ route('konsumen.products.index') }}" class="bg-gray-200 px-3 py-1 rounded">Katalog Belanja</a>
        <a href="{{ route('konsumen.orders.index') }}" class="bg-gray-200 px-3 py-1 rounded">Riwayat Belanjaan Saya</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 border rounded shadow-sm">
            <h3 class="text-sm text-gray-500">Total Transaksi Belanja Anda:</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $totalTransaksi }} Kali Pembelian</p>
        </div>
        <div class="bg-emerald-50 p-4 border border-emerald-200 rounded shadow-sm">
            <h3 class="text-sm text-emerald-800 font-bold">Harga Informasi Gabah Hari Ini:</h3>
            @if ($hargaHariIni)
                <p class="text-xl font-bold text-emerald-900">Rp {{ number_format($hargaHariIni->harga_gabah) }} / KG</p>
            @else
                <p class="text-sm text-gray-500">Belum ada rilis harga acuan dari admin.</p>
            @endif
        </div>
    </div>
@endsection
