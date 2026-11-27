<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'nama_produk' => 'Gabah Inpari 32 Biasa',
            'deskripsi' => 'Gabah hasil panen segar dari petani subak',
            'harga_jual' => 6500,
            'satuan' => 'kg',
            'status' => 'aktif',
        ]);

        Product::create([
            'nama_produk' => 'Gabah Inpari 32 SS',
            'deskripsi' => 'Gabah kering giling siap jual',
            'harga_jual' => 7200,
            'satuan' => 'kg',
            'status' => 'aktif',
        ]);

        Product::create([
            'nama_produk' => 'Gabah Inpari 32 Kingkong',
            'deskripsi' => 'Beras merah hasil olahan gabah organik',
            'harga_jual' => 15000,
            'satuan' => 'kg',
            'status' => 'aktif',
        ]);
    }
}