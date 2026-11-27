<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PetaniStock;
use App\Models\Product;
use App\Models\StockAllocation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $konsumenList = User::where('role', 'konsumen')->get();
        $product = Product::first();

        if ($konsumenList->isEmpty() || ! $product) {
            $this->command->warn('Data konsumen atau produk tidak ditemukan. Pastikan UserSeeder dan ProductSeeder sudah dijalankan.');

            return;
        }

        $petaniStocks = PetaniStock::where('product_id', $product->id)
            ->orderBy('stok_kg', 'desc')
            ->get();

        $orderData = [
            ['qty' => 10, 'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 20, 'catatan' => 'Pembelian perdana.'],
            ['qty' => 15, 'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 10, 'catatan' => 'Restock warung.'],
            ['qty' => 5,  'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 2,  'catatan' => 'Sample produk.'],

            ['qty' => 30, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 25, 'catatan' => 'Pesanan rutin.'],
            ['qty' => 20, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 12, 'catatan' => 'Packing rapi ya.'],
            ['qty' => 40, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 3,  'catatan' => 'Kirim via kargo.'],

            ['qty' => 12, 'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 28, 'catatan' => 'Mendadak butuh tambahan.'],
            ['qty' => 50, 'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 15, 'catatan' => 'Grosir bulanan.'],
            ['qty' => 8,  'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 1,  'catatan' => 'Pesanan kecil.'],

            ['qty' => 25, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 22, 'catatan' => 'Mohon diproses cepat.'],
            ['qty' => 18, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 14, 'catatan' => 'Kirim sebelum sore.'],
            ['qty' => 60, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 5,  'catatan' => 'Pesanan acara kantor.'],

            ['qty' => 35, 'status' => 'selesai', 'sub_months' => 1, 'sub_days' => 20, 'catatan' => 'Pengiriman reguler.'],
            ['qty' => 22, 'status' => 'selesai', 'sub_months' => 1, 'sub_days' => 10, 'catatan' => 'Tolong dipercepat.'],
            ['qty' => 15, 'status' => 'selesai', 'sub_months' => 1, 'sub_days' => 2,  'catatan' => 'Pengiriman terkonfirmasi.'],

            ['qty' => 10, 'status' => 'selesai', 'sub_months' => 0, 'sub_days' => 12, 'catatan' => 'Pesanan tuntas dikirim.'],
            ['qty' => 25, 'status' => 'selesai', 'sub_months' => 0, 'sub_days' => 8,  'catatan' => 'Packing kayu selesai.'],

            // 3 pesanan dengan status 'diproses'
            ['qty' => 5,  'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 5, 'catatan' => 'Kirim sebelum jam 5 sore.'],
            ['qty' => 50, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 3, 'catatan' => 'Pembelian grosir bulanan.'],
            ['qty' => 15, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 1, 'catatan' => 'Pembayaran via transfer.'],
        ];

        foreach ($orderData as $index => $data) {
            $konsumen = $konsumenList[$index % $konsumenList->count()];
            $qty = $data['qty'];
            $subtotal = $qty * $product->harga_jual;

            $orderDate = Carbon::now()
                ->subMonths($data['sub_months'])
                ->subDays($data['sub_days']);

            $order = Order::create([
                'no_order' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => $konsumen->id,
                'nama_pemesan' => $konsumen->name,
                'whatsapp_pemesan' => $konsumen->phone ?? '08120000' . str_pad($index, 4, '0', STR_PAD_LEFT),
                'total_harga' => $subtotal,
                'status' => $data['status'],
                'tanggal_pesan' => $orderDate,
                'catatan' => $data['catatan'],
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'harga_satuan' => $product->harga_jual,
                'subtotal' => $subtotal,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            if ($data['status'] === 'selesai' && $petaniStocks->isNotEmpty()) {
                $this->seedAllocations($orderItem, $petaniStocks, $orderDate);
            }
        }
    }

    private function seedAllocations(OrderItem $orderItem, $petaniStocks, Carbon $orderDate): void
    {
        $qty = (int) $orderItem->qty;
        $totalBobot = $petaniStocks->sum(fn ($s) => max($s->stok_kg, 1));

        $floors = [];
        $remainders = [];
        $terbagi = 0;

        foreach ($petaniStocks as $stock) {
            $bobot = max($stock->stok_kg, 1);
            $exact = $qty * ($bobot / $totalBobot);
            $floor = min((int) floor($exact), $stock->stok_kg);

            $floors[$stock->id] = $floor;
            $remainders[$stock->id] = $exact - $floor;
            $terbagi += $floor;
        }

        $sisaKg = $qty - $terbagi;
        $urutan = $petaniStocks->sortByDesc(fn ($stock) => $remainders[$stock->id]);

        foreach ($urutan as $stock) {
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
                'order_item_id' => $orderItem->id,
                'petani_stock_id' => $stock->id,
                'jumlah_kg' => $ambil,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            $stock->decrement('stok_kg', $ambil);
            $stock->stok_kg -= $ambil;
        }
    }
}