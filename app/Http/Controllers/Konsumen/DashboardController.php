<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\Order;
use App\Models\Product; // Pastikan model Product di-import
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Data bawaan awal Anda
        $hargaHariIni = HargaBroadcast::latest('tanggal')->first();
        $totalTransaksi = Order::where('user_id', $userId)->count();

        // 2. Tambahan: Akumulasi nominal belanja yang sudah sukses/selesai
        $totalPengeluaran = Order::where('user_id', $userId)
            ->where('status', 'selesai')
            ->sum('total_harga');

        // 3. Tambahan: Pesanan teranyar konsumen (Limit 5)
        $recentOrders = Order::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // 4. Tambahan: Intipan Produk/Komoditas Tersedia di Gudang saat ini
        // Mengasumsikan ada model Product yang berelasi dengan stok atau langsung di-display
        $availableProducts = Product::latest()->take(3)->get();

        // 5. BARU: Perbandingan harga acuan vs rata-rata harga jual riil di platform
        $rataHargaJual = Product::where('status', 'aktif')->avg('harga_jual');

        $selisihHarga = null;
        $selisihPersen = null;
        if ($hargaHariIni && $rataHargaJual) {
            $selisihHarga = $rataHargaJual - $hargaHariIni->harga_gabah;
            $selisihPersen = $hargaHariIni->harga_gabah > 0
                ? ($selisihHarga / $hargaHariIni->harga_gabah) * 100
                : null;
        }

        return view('konsumen.dashboard', compact(
            'hargaHariIni',
            'totalTransaksi',
            'totalPengeluaran',
            'recentOrders',
            'availableProducts',
            'rataHargaJual',
            'selisihHarga',
            'selisihPersen'
        ));
    }
}