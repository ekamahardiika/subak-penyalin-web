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

        $riwayat = HargaBroadcast::orderByDesc('tanggal')->get();
        $hargaTerbaru = $riwayat->first();

        $riwayatUntukGrafik = $riwayat->take(30)->sortBy('tanggal')->values();

        $chartLabels = $riwayatUntukGrafik
            ->map(fn ($h) => Carbon::parse($h->tanggal)->translatedFormat('d M'))
            ->toArray();

        $chartData = $riwayatUntukGrafik->pluck('harga_gabah')->toArray();

        return view('landing.home', compact(
            'products', 'riwayat', 'hargaTerbaru', 'chartLabels', 'chartData'
        ));
    }
}
