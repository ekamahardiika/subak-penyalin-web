<?php

// app/Http/Controllers/Petani/DashboardController.php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\PetaniStock;
use App\Models\Product;
use App\Models\StockAllocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalStokSaya = PetaniStock::where('user_id', $userId)->sum('stok_kg');

        $hargaTerbaru = HargaBroadcast::latest('tanggal')->first();

        $stokPerProduk = PetaniStock::with('product')
            ->where('user_id', $userId)
            ->get();

        $chartLabels = $stokPerProduk->map(fn ($item) => $item->product->nama_produk ?? 'Produk Tidak Dikenal')->toArray();

        $chartData = $stokPerProduk->map(fn ($item) => $item->stok_kg)->toArray();

        $riwayatStok = PetaniStock::with('product')
            ->where('user_id', $userId)
            ->latest('updated_at')
            ->take(5)
            ->get();

        $penjualanBulanIniQuery = StockAllocation::query()
            ->join('order_items', 'order_items.id', '=', 'stock_allocations.order_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('petani_stocks', 'petani_stocks.id', '=', 'stock_allocations.petani_stock_id')
            ->where('petani_stocks.user_id', $userId)
            ->where('orders.status', 'selesai')
            ->whereBetween('orders.tanggal_pesan', [now()->startOfMonth(), now()->endOfMonth()]);

        $totalTerjualKgBulanIni = (clone $penjualanBulanIniQuery)->sum('stock_allocations.jumlah_kg');

        $totalPendapatanBulanIni = (clone $penjualanBulanIniQuery)->sum(DB::raw('stock_allocations.jumlah_kg * order_items.harga_satuan'));

        $rataHargaJual = Product::where('status', 'aktif')->avg('harga_jual');

        $selisihHarga = null;
        $selisihPersen = null;
        if ($hargaTerbaru && $rataHargaJual) {
            $selisihHarga = $rataHargaJual - $hargaTerbaru->harga_gabah;
            $selisihPersen = $hargaTerbaru->harga_gabah > 0
                ? ($selisihHarga / $hargaTerbaru->harga_gabah) * 100
                : null;
        }

        return view('petani.dashboard', compact(
            'totalStokSaya',
            'hargaTerbaru',
            'stokPerProduk',
            'chartLabels',
            'chartData',
            'riwayatStok',
            'totalTerjualKgBulanIni',
            'totalPendapatanBulanIni',
            'rataHargaJual',
            'selisihHarga',
            'selisihPersen'
        ));
    }
}
