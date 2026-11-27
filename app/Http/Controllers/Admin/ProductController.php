<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_jual' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'gambar.image' => 'Berkas harus berupa file gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar terlalu besar. Maksimal 2 MB (2048 KB).',
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('products', 'public');
                if (! $path) {
                    return back()
                        ->withInput()
                        ->with('error', 'Gagal menyimpan gambar produk. Periksa ukuran file atau konfigurasi penyimpanan.');
                }
                $validated['gambar'] = $path;
            }

            Product::create($validated);

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan produk: '.$e->getMessage());
        }
    }

    public function show(Product $product)
    {
        $stocks = $product->stocks()->with('petani')->get();

        return view('admin.products.show', compact('product', 'stocks'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_jual' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'gambar.image' => 'Berkas harus berupa file gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar terlalu besar. Maksimal 2 MB (2048 KB).',
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('products', 'public');
                if (! $path) {
                    return back()
                        ->withInput()
                        ->with('error', 'Gagal mengunggah gambar baru. Ukuran file mungkin terlalu besar atau penyimpanan bermasalah.');
                }

                if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                    Storage::disk('public')->delete($product->gambar);
                }

                $validated['gambar'] = $path;
            }

            $product->update($validated);

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui produk: '.$e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        $hasOrders = $product->orderItems()->exists();

        if ($hasOrders) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Produk tidak dapat dihapus karena masih tercatat pada pesanan.');
        }

        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
