@extends('layouts.landing')

@section('content')
    <div class="bg-emerald-950 pt-32 pb-16 text-center text-white">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold">Tentang Kami</h1>
            <p class="text-emerald-300 text-sm mt-2">Mengenal platform digital agrikultur Sistem Gabah</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-6 py-16 text-center">
        <div
            class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm">
            <i class="fa-solid fa-circle-info text-2xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Misi Menyejahterakan Petani Lokal</h2>
        <p class="text-gray-600 leading-relaxed text-base mb-6">
            Ini adalah halaman statis mengenai platform Sistem Gabah. Sistem Gabah dibangun berawal dari keresahan atas
            ketidakstabilan pasokan harga pangan serta rantai tengkulak yang merugikan. Kami hadir memberikan solusi
            digitalisasi penawaran komoditas terstruktur, transparan, dan terverifikasi untuk seluruh elemen agrobisnis di
            Indonesia.
        </p>
        <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto pt-4">
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-xs">
                <p class="text-2xl font-extrabold text-emerald-600">100%</p>
                <p class="text-xs font-semibold text-gray-500">Transparansi</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-xs">
                <p class="text-2xl font-extrabold text-emerald-600">Lokal</p>
                <p class="text-xs font-semibold text-gray-500">Petani Pilihan</p>
            </div>
        </div>
    </div>
@endsection
