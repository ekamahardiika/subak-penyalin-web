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
        $konsumen = User::where('role', 'konsumen')->first();
        $product = Product::first();

        if (! $konsumen || ! $product) {
            $this->command->warn('Data konsumen atau produk tidak ditemukan. Pastikan UserSeeder dan ProductSeeder sudah dijalankan.');

            return;
        }

        $petaniStock = PetaniStock::where('product_id', $product->id)->first();

        // 20 data dummy tersebar dari 5 bulan lalu hingga bulan ini
        $orderData = [
            // Month -5
            ['qty' => 10, 'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 20, 'catatan' => 'Pembelian perdana.'],
            ['qty' => 15, 'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 10, 'catatan' => 'Restock warung.'],
            ['qty' => 5,  'status' => 'selesai', 'sub_months' => 5, 'sub_days' => 2,  'catatan' => 'Sample produk.'],

            // Month -4
            ['qty' => 30, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 25, 'catatan' => 'Pesanan rutin.'],
            ['qty' => 20, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 12, 'catatan' => 'Packing rapi ya.'],
            ['qty' => 40, 'status' => 'selesai', 'sub_months' => 4, 'sub_days' => 3,  'catatan' => 'Kirim via kargo.'],

            // Month -3
            ['qty' => 12, 'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 28, 'catatan' => 'Mendadak butuh tambahan.'],
            ['qty' => 50, 'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 15, 'catatan' => 'Grosir bulanan.'],
            ['qty' => 8,  'status' => 'selesai', 'sub_months' => 3, 'sub_days' => 1,  'catatan' => 'Pesanan kecil.'],

            // Month -2
            ['qty' => 25, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 22, 'catatan' => 'Mohon diproses cepat.'],
            ['qty' => 18, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 14, 'catatan' => 'Kirim sebelum sore.'],
            ['qty' => 60, 'status' => 'selesai', 'sub_months' => 2, 'sub_days' => 5,  'catatan' => 'Pesanan acara kantor.'],

            // Month -1
            ['qty' => 35, 'status' => 'selesai', 'sub_months' => 1, 'sub_days' => 20, 'catatan' => 'Pengiriman reguler.'],
            ['qty' => 22, 'status' => 'selesai', 'sub_months' => 1, 'sub_days' => 10, 'catatan' => 'Tolong dipercepat.'],
            ['qty' => 15, 'status' => 'diproses', 'sub_months' => 1, 'sub_days' => 2,  'catatan' => 'Tertunda konfirmasi.'],

            // Bulan Ini (Current Month)
            ['qty' => 10, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 12, 'catatan' => 'Pesanan mendesak, mohon segera diproses.'],
            ['qty' => 25, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 8,  'catatan' => 'Packing kayu ya min.'],
            ['qty' => 5,  'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 5,  'catatan' => 'Kirim sebelum jam 5 sore.'],
            ['qty' => 50, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 3,  'catatan' => 'Pembelian grosir bulanan.'],
            ['qty' => 15, 'status' => 'diproses', 'sub_months' => 0, 'sub_days' => 1,  'catatan' => 'Pembayaran via transfer.'],
        ];

        foreach ($orderData as $index => $data) {
            $qty = $data['qty'];
            $subtotal = $qty * $product->harga_jual;

            // Generate tanggal pesanan sesuai mundur bulan dan hari
            $orderDate = Carbon::now()
                ->subMonths($data['sub_months'])
                ->subDays($data['sub_days']);

            $order = Order::create([
                'no_order' => 'ORD-'.strtoupper(Str::random(8)),
                'user_id' => $konsumen->id,
                'nama_pemesan' => $konsumen->name,
                'whatsapp_pemesan' => $konsumen->phone ?? '08120000'.str_pad($index, 4, '0', STR_PAD_LEFT),
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

            if ($petaniStock) {
                StockAllocation::create([
                    'order_item_id' => $orderItem->id,
                    'petani_stock_id' => $petaniStock->id,
                    'jumlah_kg' => $qty,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);
            }
        }
    }
}