<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\PetaniStock;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Akumulasi Total Stok
        $totalStokSaya = PetaniStock::where('user_id', $userId)->sum('stok_kg');

        // 2. Harga Terbaru
        $hargaTerbaru = HargaBroadcast::latest('tanggal')->first();

        // 3. Rincian Stok per Jenis Produk & Data Grafik
        $stokPerProduk = PetaniStock::with('product')
            ->where('user_id', $userId)
            ->get();

        $chartLabels = $stokPerProduk->map(fn ($item) => $item->product->name ?? 'Produk Konten')->toArray();
        $chartData = $stokPerProduk->map(fn ($item) => $item->stok_kg)->toArray();

        // 4. Riwayat Pembaruan Stok Terakhir
        $riwayatStok = PetaniStock::with('product')
            ->where('user_id', $userId)
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('petani.dashboard', compact(
            'totalStokSaya',
            'hargaTerbaru',
            'stokPerProduk',
            'chartLabels',
            'chartData',
            'riwayatStok'
        ));
    }
}
