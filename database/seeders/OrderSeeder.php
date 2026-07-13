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

        $qty = 20;
        $subtotal = $qty * $product->harga_jual;

        $order = Order::create([
            'no_order' => 'ORD-'.strtoupper(Str::random(8)),
            'user_id' => $konsumen->id,
            'nama_pemesan' => $konsumen->name,
            'whatsapp_pemesan' => $konsumen->phone ?? '081200000000',
            'total_harga' => $subtotal,
            'status' => 'diproses',
            'tanggal_pesan' => now(),
            'catatan' => 'Contoh pesanan awal',
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
