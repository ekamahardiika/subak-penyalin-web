<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk', 'deskripsi', 'gambar', 'harga_jual', 'satuan', 'status',
    ];

    public function stocks()
    {
        return $this->hasMany(PetaniStock::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalStokAttribute()
    {
        return $this->stocks()->sum('stok_kg');
    }
}