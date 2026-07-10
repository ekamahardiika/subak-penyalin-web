<?php

namespace App\Http\Controllers\Konsumen;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PetaniStock;
use App\Models\Product;
use App\Models\StockAllocation;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $stokTersedia = PetaniStock::where('product_id', $product->id)->sum('stok_kg');

        if ($validated['qty'] > $stokTersedia) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($validated, $product) {
            $subtotal = $validated['qty'] * $product->harga_jual;

            $order = Order::create([
                'no_order' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'total_harga' => $subtotal,
                'status' => 'pending',
                'tanggal_pesan' => now(),
            ]);

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $validated['qty'],
                'harga_satuan' => $product->harga_jual,
                'subtotal' => $subtotal,
            ]);

            $sisaQty = $validated['qty'];
            $petaniStocks = PetaniStock::where('product_id', $product->id)
                ->where('stok_kg', '>', 0)
                ->orderBy('stok_kg', 'desc')
                ->get();

            foreach ($petaniStocks as $stock) {
                if ($sisaQty <= 0) break;

                $ambil = min($stock->stok_kg, $sisaQty);

                StockAllocation::create([
                    'order_item_id' => $orderItem->id,
                    'petani_stock_id' => $stock->id,
                    'jumlah_kg' => $ambil,
                ]);

                $stock->decrement('stok_kg', $ambil);
                $sisaQty -= $ambil;
            }
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