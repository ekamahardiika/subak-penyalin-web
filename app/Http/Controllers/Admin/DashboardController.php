<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PetaniStock;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPetani = User::where('role', 'petani')->count();
        $totalStokGabah = PetaniStock::sum('stok_kg');
        $totalTransaksi = Order::count();
        $totalPenjualan = Order::where('status', 'selesai')->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalPetani', 'totalStokGabah', 'totalTransaksi', 'totalPenjualan'
        ));
    }
}