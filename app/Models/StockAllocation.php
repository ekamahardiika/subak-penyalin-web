<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAllocation extends Model
{
    protected $fillable = [
        'order_item_id', 'petani_stock_id', 'jumlah_kg',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function petaniStock()
    {
        return $this->belongsTo(PetaniStock::class);
    }
}