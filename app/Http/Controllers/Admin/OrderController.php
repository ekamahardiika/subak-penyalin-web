<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PetaniStock;
use App\Models\StockAllocation;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product', 'items.stockAllocations.petaniStock.petani');

        return view('admin.orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        if (! in_array('selesai', $order->allowed_next_statuses, true)) {
            return back()->with('error', "Status tidak bisa diubah dari '{$order->status}' ke 'selesai'");
        }

        try {
            DB::transaction(function () use ($order) {
                $order->load('items');

                foreach ($order->items as $item) {
                    $petaniStocks = PetaniStock::where('product_id', $item->product_id)
                        ->where('stok_kg', '>', 0)
                        ->orderBy('stok_kg', 'desc')
                        ->lockForUpdate()
                        ->get();

                    $stokTersedia = $petaniStocks->sum('stok_kg');

                    if ($item->qty > $stokTersedia) {
                        throw new \RuntimeException(
                            "Stok tidak mencukupi untuk menyelesaikan pesanan ini (produk ID {$item->product_id}). ".
                            'Stok mungkin sudah terpakai oleh pesanan lain.'
                        );
                    }

                    $this->allocateProportionally($item, $petaniStocks);
                }

                $order->update(['status' => 'selesai']);
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Pesanan ditandai selesai, stok petani telah diperbarui secara merata');
    }

    private function allocateProportionally($item, $petaniStocks): void
    {
        $qty = (int) $item->qty;
        $totalStok = (int) $petaniStocks->sum('stok_kg');

        $floors = [];
        $remainders = [];
        $totalTerbagi = 0;

        foreach ($petaniStocks as $stock) {
            $porsi = $stock->stok_kg / $totalStok;
            $exact = $qty * $porsi;
            $floor = (int) floor($exact);

            $floor = min($floor, $stock->stok_kg);

            $floors[$stock->id] = $floor;
            $remainders[$stock->id] = $exact - $floor;
            $totalTerbagi += $floor;
        }

        $sisaKg = $qty - $totalTerbagi;

        $urutanSisa = $petaniStocks->sortByDesc(fn ($stock) => $remainders[$stock->id]);

        foreach ($urutanSisa as $stock) {
            if ($sisaKg <= 0) {
                break;
            }

            if ($floors[$stock->id] < $stock->stok_kg) {
                $floors[$stock->id]++;
                $sisaKg--;
            }
        }

        foreach ($petaniStocks as $stock) {
            $ambil = $floors[$stock->id];

            if ($ambil <= 0) {
                continue;
            }

            StockAllocation::create([
                'order_item_id' => $item->id,
                'petani_stock_id' => $stock->id,
                'jumlah_kg' => $ambil,
            ]);

            $stock->decrement('stok_kg', $ambil);
        }
    }

    public function cancel(Order $order)
    {
        if (! in_array('dibatalkan', $order->allowed_next_statuses, true)) {
            return back()->with('error', "Status tidak bisa diubah dari '{$order->status}' ke 'dibatalkan'");
        }

        $order->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan');
    }
}
