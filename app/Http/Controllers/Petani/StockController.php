<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\PetaniStock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $stocks = PetaniStock::with('product')->where('user_id', Auth::id())->get();
        $products = Product::where('status', 'aktif')->get();

        return view('petani.stocks.index', compact('stocks', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',

            'stok_kg' => 'required|integer|min:1',
        ]);

        $stock = PetaniStock::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
        ]);

        $stock->stok_kg = ($stock->stok_kg ?? 0) + $validated['stok_kg'];
        $stock->save();

        return back()->with('success', 'Stok berhasil ditambahkan');
    }

    public function edit(PetaniStock $stock)
    {
        if ($stock->user_id !== Auth::id()) {
            abort(403);
        }

        $stock->load('product');

        return view('petani.stocks.edit', compact('stock'));
    }

    public function update(Request $request, PetaniStock $stock)
    {
        if ($stock->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([

            'stok_kg' => 'required|integer|min:0',
        ]);

        $stock->update($validated);

        return redirect()->route('petani.stok.index')->with('success', 'Stok berhasil diupdate');
    }
}
