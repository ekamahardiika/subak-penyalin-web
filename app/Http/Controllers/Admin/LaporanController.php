<?php

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

        $orders = $query->latest()->paginate(15);
        $totalPenjualan = (clone $query)->sum('total_harga');

        return view('admin.laporan.index', compact('orders', 'totalPenjualan'));
    }
}