<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PetaniStock;

class LandingController extends Controller
{
    public function home()
    {
        $products = Product::where('status', 'aktif')->take(6)->get();
        return view('landing.home', compact('products'));
    }

    public function tentang()
    {
        return view('landing.tentang');
    }

    public function produk()
    {
        $products = Product::where('status', 'aktif')->paginate(9);
        return view('landing.produk', compact('products'));
    }

    public function kontak()
    {
        return view('landing.kontak');
    }
}