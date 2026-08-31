<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $hargaHariIni = HargaBroadcast::latest('tanggal')->first();
        $totalTransaksi = Order::where('user_id', $userId)->count();

        $totalPengeluaran = Order::where('user_id', $userId)
            ->where('status', 'selesai')
            ->sum('total_harga');

        $recentOrders = Order::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $availableProducts = Product::latest()->take(3)->get();

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