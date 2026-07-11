<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PetaniStock;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 4 Statistik Utama (Data Lama Anda)
        $totalPetani = User::where('role', 'petani')->count();
        $totalStokGabah = PetaniStock::sum('stok_kg');
        $totalTransaksi = Order::count();
        $totalPenjualan = Order::where('status', 'selesai')->sum('total_harga') ?? 0;

        // --- TAMBAHAN DATA BARU ---

        // 1. Ambil 5 transaksi terbaru beserta data user/konsumennya
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 2. Ambil data tren omset bulanan (untuk Line/Bar Chart) di tahun berjalan
        $salesMonthly = Order::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(total_harga) as total')
            )
            ->where('status', 'selesai')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('bulan', 'asc')
            ->get();

        // Format data untuk grafik Chart.js (inisialisasi 12 bulan dengan nilai 0)
        $chartSalesData = array_fill(1, 12, 0);
        foreach ($salesMonthly as $data) {
            $chartSalesData[$data->bulan] = (int) $data->total;
        }
        // Ubah ke array index 0-11 agar dibaca urut oleh JavaScript (Januari - Desember)
        $chartSalesData = array_values($chartSalesData);

        // 3. Ambil data stok gabah per varietas/produk (untuk Pie/Donut Chart)
        $stokPerProduk = PetaniStock::join('products', 'petani_stocks.product_id', '=', 'products.id')
            ->select('products.nama_produk', DB::raw('SUM(petani_stocks.stok_kg) as total_stok'))
            ->groupBy('products.nama_produk')
            ->get();

        $chartProductLabels = $stokPerProduk->pluck('nama_produk')->toArray();
        $chartProductData = $stokPerProduk->pluck('total_stok')->toArray();

        return view('admin.dashboard', compact(
            'totalPetani', 
            'totalStokGabah', 
            'totalTransaksi', 
            'totalPenjualan',
            'recentOrders',
            'chartSalesData',
            'chartProductLabels',
            'chartProductData'
        ));
    }
}