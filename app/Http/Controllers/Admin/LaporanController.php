<?php

// app/Http/Controllers/Admin/LaporanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'items.product')->where('status', 'selesai');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pesan', [$request->start_date, $request->end_date]);
        }

        $totalPenjualan = (clone $query)->sum('total_harga');

        // FIX: withQueryString() supaya filter start_date/end_date tidak hilang saat pindah halaman
        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.laporan.index', compact('orders', 'totalPenjualan'));
    }
}
