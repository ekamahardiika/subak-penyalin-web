<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hargaHariIni = HargaBroadcast::latest('tanggal')->first();
        $totalTransaksi = Order::where('user_id', Auth::id())->count();

        return view('konsumen.dashboard', compact('hargaHariIni', 'totalTransaksi'));
    }
}