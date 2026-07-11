<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\PetaniStock;
use App\Models\StockAllocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // 5. Penjualan Bulan Ini (status selesai, terhitung lewat stock_allocations)
        $penjualanBulanIniQuery = StockAllocation::query()
            ->join('order_items', 'order_items.id', '=', 'stock_allocations.order_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('petani_stocks', 'petani_stocks.id', '=', 'stock_allocations.petani_stock_id')
            ->where('petani_stocks.user_id', $userId)
            ->where('orders.status', 'selesai')
            ->whereBetween('orders.tanggal_pesan', [now()->startOfMonth(), now()->endOfMonth()]);

        $totalTerjualKgBulanIni = (clone $penjualanBulanIniQuery)->sum('stock_allocations.jumlah_kg');
        $totalPendapatanBulanIni = (clone $penjualanBulanIniQuery)->sum(DB::raw('stock_allocations.jumlah_kg * order_items.harga_satuan'));

        return view('petani.dashboard', compact(
            'totalStokSaya',
            'hargaTerbaru',
            'stokPerProduk',
            'chartLabels',
            'chartData',
            'riwayatStok',
            'totalTerjualKgBulanIni',
            'totalPendapatanBulanIni'
        ));
    }
}
