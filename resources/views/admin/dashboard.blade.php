@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow-sm border">
            <p class="text-gray-500 text-sm">Total Mitra Petani</p>
            <p class="text-xl font-bold">{{ $totalPetani }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow-sm border">
            <p class="text-gray-500 text-sm">Total Stok Gabah (KG)</p>
            <p class="text-xl font-bold">{{ number_format($totalStokGabah, 2) }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow-sm border">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <p class="text-xl font-bold">{{ $totalTransaksi }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow-sm border">
            <p class="text-gray-500 text-sm">Total Pendapatan Selesai</p>
            <p class="text-xl font-bold">Rp {{ number_format($totalPenjualan, 2) }}</p>
        </div>
    </div>
@endsection
