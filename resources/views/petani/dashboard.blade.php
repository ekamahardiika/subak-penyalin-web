@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold mb-2">Panel Kerja Petani</h1>
    <div class="flex gap-2 mb-4 text-sm">
        <a href="{{ route('petani.dashboard') }}" class="bg-emerald-600 text-white px-3 py-1 rounded">Ringkasan</a>
        <a href="{{ route('petani.stok.index') }}" class="bg-gray-200 px-3 py-1 rounded">Kelola Stok Gabah Saya</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white p-4 border rounded shadow-sm">
            <h3 class="text-sm text-gray-500">Akumulasi Total Stok Anda Saat Ini:</h3>
            <p class="text-2xl font-bold text-emerald-600">{{ number_format($totalStokSaya, 2) }} KG</p>
        </div>
        <div class="bg-yellow-50 p-4 border border-yellow-200 rounded shadow-sm">
            <h3 class="text-sm text-yellow-700 font-bold">Harga Acuan Pasar Gabah Hari Ini:</h3>
            @if ($hargaTerbaru)
                <p class="text-xl font-bold text-yellow-900">Rp {{ number_format($hargaTerbaru->harga_gabah) }} / KG</p>
                <p class="text-xs text-gray-500 mt-1">Catatan Admin: {{ $hargaTerbaru->keterangan }}</p>
            @else
                <p class="text-sm text-gray-500">Belum ada informasi harga terbaru yang dirilis admin.</p>
            @endif
        </div>
    </div>
@endsection
