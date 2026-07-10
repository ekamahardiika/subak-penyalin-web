<?php

namespace Database\Seeders;

use App\Models\PetaniStock;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class PetaniStockSeeder extends Seeder
{
    public function run(): void
    {
        $petaniList = User::where('role', 'petani')->get();
        $products = Product::all();

        foreach ($petaniList as $petani) {
            foreach ($products as $product) {
                PetaniStock::create([
                    'user_id' => $petani->id,
                    'product_id' => $product->id,
                    'stok_kg' => rand(50, 500),
                ]);
            }
        }
    }
}