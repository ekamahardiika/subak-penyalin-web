<?php

namespace App\Http\Controllers;

use App\Models\HargaBroadcast;
use App\Models\Product;
use Illuminate\Support\Carbon;

class LandingController extends Controller
{
    public function home()
    {
        $products = Product::where('status', 'aktif')->take(6)->get();

        return view('landing.home', compact('products'));
    }

    public function tentang()
    {
        return view('landing.tentang');
    }

    public function produk()
    {
        $products = Product::where('status', 'aktif')->paginate(9);

        return view('landing.produk', compact('products'));
    }

    public function kontak()
    {
        return view('landing.kontak');
    }

    /**
     * Halaman publik "Informasi Harga" — bisa diakses tanpa login,
     * sesuai tujuan transparansi harga gabah bagi seluruh anggota subak.
     */
    public function harga()
    {
        // Seluruh riwayat untuk tabel (search & pagination di sisi client)
        $riwayat = HargaBroadcast::orderByDesc('tanggal')->get();

        $hargaTerbaru = $riwayat->first();

        // Untuk grafik tren, cukup 30 rilis terakhir saja biar tetap terbaca,
        // diurutkan naik supaya kiri = lama, kanan = baru
        $riwayatUntukGrafik = $riwayat->take(30)->sortBy('tanggal')->values();

        $chartLabels = $riwayatUntukGrafik
            ->map(fn ($h) => Carbon::parse($h->tanggal)->translatedFormat('d M'))
            ->toArray();

        $chartData = $riwayatUntukGrafik->pluck('harga_gabah')->toArray();

        return view('landing.harga', compact('riwayat', 'hargaTerbaru', 'chartLabels', 'chartData'));
    }
}
