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
        $order->load('user', 'items.product');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Tandai pesanan selesai. Di sinilah stok petani benar-benar
     * dialokasikan dan dikurangi — bukan saat konsumen checkout.
     *
     * Alokasi dibagi PROPORSIONAL (bulat, tanpa koma) ke semua petani yang
     * punya stok produk ini, sesuai porsi kepemilikan masing-masing,
     * supaya beban pengambilan stok merata antar petani anggota subak.
     */
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
                            'Stok mungkin sudah terpakai oleh pesanan lain yang lebih dulu diselesaikan.'
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

    /**
     * Bagi qty pesanan (bulat, kg utuh, tanpa koma) ke setiap petani
     * secara proporsional memakai largest remainder method:
     * 1. Tiap petani dapat porsi floor(qty * porsi_stok) dulu.
     * 2. Sisa kg yang belum terbagi (karena pembulatan ke bawah)
     *    dikasihkan satu-satu ke petani dengan sisa desimal terbesar,
     *    supaya totalnya tetap tepat sama dengan qty pesanan dan
     *    pembagiannya tetap adil (bukan sekadar dibulatkan sepihak).
     */
    private function allocateProportionally($item, $petaniStocks): void
    {
        $qty = (int) round($item->qty);
        $totalStok = (float) $petaniStocks->sum('stok_kg');

        $floors = [];
        $remainders = [];
        $totalTerbagi = 0;

        foreach ($petaniStocks as $stock) {
            $porsi = $stock->stok_kg / $totalStok;
            $exact = $qty * $porsi;
            $floor = (int) floor($exact);

            $floors[$stock->id] = $floor;
            $remainders[$stock->id] = $exact - $floor;
            $totalTerbagi += $floor;
        }

        // Sisa kg yang belum terbagi akibat pembulatan ke bawah
        $sisaKg = $qty - $totalTerbagi;

        // Urutkan petani berdasarkan sisa desimal terbesar,
        // supaya sisaKg dibagikan ke yang "paling berhak" duluan
        $urutanSisa = $petaniStocks->sortByDesc(fn ($stock) => $remainders[$stock->id]);

        foreach ($urutanSisa as $stock) {
            if ($sisaKg <= 0) {
                break;
            }

            $floors[$stock->id]++;
            $sisaKg--;
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

    /**
     * Batalkan pesanan. Tidak perlu mengembalikan stok apa pun,
     * karena stok baru dikurangi saat pesanan diselesaikan, bukan saat dibuat.
     */
    public function cancel(Order $order)
    {
        if (! in_array('dibatalkan', $order->allowed_next_statuses, true)) {
            return back()->with('error', "Status tidak bisa diubah dari '{$order->status}' ke 'dibatalkan'");
        }

        $order->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan');
    }
}
