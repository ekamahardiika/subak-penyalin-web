<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\PetaniStock;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Grid daftar produk + panel keranjang (mirip contoh gambar Form Order).
     */
    public function index()
    {
        $products = Product::where('status', 'aktif')
            ->orderBy('nama_produk')
            ->get()
            ->map(function ($p) {
                $p->stok_tersedia = PetaniStock::where('product_id', $p->id)->sum('stok_kg');
                $p->gambar_url = $p->gambar ? asset('storage/'.$p->gambar) : null;

                return $p;
            });

        return view('konsumen.products.index', compact('products'));
    }

    /**
     * Halaman detail produk yang muncul saat produk di-klik dari index.
     */
    public function show(Product $product)
    {
        abort_if($product->status !== 'aktif', 404);

        $product->stok_tersedia = PetaniStock::where('product_id', $product->id)->sum('stok_kg');
        $product->gambar_url = $product->gambar ? asset('storage/'.$product->gambar) : null;

        return view('konsumen.products.show', compact('product'));
    }
}
