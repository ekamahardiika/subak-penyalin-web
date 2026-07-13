<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PetaniStock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('konsumen.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('status', 'aktif')
            ->get()
            ->map(function ($p) {
                $p->gambar_url = $p->gambar ? asset('storage/'.$p->gambar) : null;

                return $p;
            });

        return view('konsumen.orders.create', [
            'products' => $products,
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'whatsapp_pemesan' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:1000',
            'items' => 'required|string',
        ]);

        $items = json_decode($validated['items'], true);

        if (! is_array($items) || count($items) === 0) {
            return back()->with('error', 'Keranjang belanja masih kosong');
        }

        // Cek stok saat ini hanya sebagai validasi awal (bukan reservasi).
        // Stok baru benar-benar dikurangi saat admin menandai pesanan "Selesai".
        foreach ($items as $productId => $qty) {
            $qty = (float) $qty;

            if ($qty <= 0) {
                continue;
            }

            $product = Product::find($productId);

            if (! $product) {
                return back()->with('error', 'Salah satu produk di keranjang tidak ditemukan');
            }

            $stokTersedia = PetaniStock::where('product_id', $product->id)->sum('stok_kg');

            if ($qty > $stokTersedia) {
                return back()->with('error', "Stok {$product->nama_produk} tidak mencukupi");
            }
        }

        DB::transaction(function () use ($items, $validated) {
            $order = Order::create([
                'no_order' => 'ORD-'.strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'nama_pemesan' => $validated['nama_pemesan'],
                'whatsapp_pemesan' => $validated['whatsapp_pemesan'],
                'catatan' => $validated['catatan'] ?? null,
                'total_harga' => 0,
                'status' => 'diproses',
                'tanggal_pesan' => now(),
            ]);

            $totalHarga = 0;

            foreach ($items as $productId => $qty) {
                $qty = (float) $qty;

                if ($qty <= 0) {
                    continue;
                }

                $product = Product::findOrFail($productId);
                $subtotal = $qty * $product->harga_jual;
                $totalHarga += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'harga_satuan' => $product->harga_jual,
                    'subtotal' => $subtotal,
                ]);
                // Tidak ada StockAllocation/decrement di sini lagi.
                // Itu baru terjadi di Admin\OrderController@complete().
            }

            $order->update(['total_harga' => $totalHarga]);
        });

        return redirect()->route('konsumen.orders.index')->with('success', 'Pesanan berhasil dibuat');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('konsumen.orders.show', compact('order'));
    }
}
