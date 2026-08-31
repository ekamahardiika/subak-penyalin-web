<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PetaniStock;
use App\Models\Product;
use App\Models\StockAllocation;
use App\Models\User;
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

        $orderData = [
            ['qty' => 10, 'status' => 'diproses', 'catatan' => 'Pesanan mendesak, mohon segera diproses.'],
            ['qty' => 25, 'status' => 'diproses', 'catatan' => 'Packing kayu ya min.'],
            ['qty' => 5, 'status' => 'diproses', 'catatan' => 'Kirim sebelum jam 5 sore.'],
            ['qty' => 50, 'status' => 'diproses', 'catatan' => 'Pembelian grosir bulanan.'],
            ['qty' => 15, 'status' => 'diproses', 'catatan' => 'Salah input alamat, nanti re-order.'],
        ];

        foreach ($orderData as $index => $data) {
            $qty = $data['qty'];
            $subtotal = $qty * $product->harga_jual;

            $order = Order::create([
                'no_order' => 'ORD-'.strtoupper(Str::random(8)),
                'user_id' => $konsumen->id,
                'nama_pemesan' => $konsumen->name,
                'whatsapp_pemesan' => $konsumen->phone ?? '08120000'.str_pad($index, 4, '0', STR_PAD_LEFT),
                'total_harga' => $subtotal,
                'status' => $data['status'],
                'tanggal_pesan' => now()->subDays(5 - $index), 
                'catatan' => $data['catatan'],
            ]);

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $qty,
                'harga_satuan' => $product->harga_jual,
                'subtotal' => $subtotal,
            ]);

            $petaniStock = PetaniStock::where('product_id', $product->id)->first();

            if ($petaniStock) {
                StockAllocation::create([
                    'order_item_id' => $orderItem->id,
                    'petani_stock_id' => $petaniStock->id,
                    'jumlah_kg' => $qty,
                ]);
            }
        }
    }
}
