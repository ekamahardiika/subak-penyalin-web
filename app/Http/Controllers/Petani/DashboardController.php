<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\PetaniStock;
use App\Models\HargaBroadcast;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStokSaya = PetaniStock::where('user_id', Auth::id())->sum('stok_kg');
        $hargaTerbaru = HargaBroadcast::latest('tanggal')->first();

        return view('petani.dashboard', compact('totalStokSaya', 'hargaTerbaru'));
    }
}