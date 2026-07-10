<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'aktif')->paginate(9);
        return view('konsumen.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $stokTersedia = $product->stocks()->sum('stok_kg');
        return view('konsumen.products.show', compact('product', 'stokTersedia'));
    }
}