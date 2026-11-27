<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetaniStock extends Model
{
    protected $table = 'petani_stocks';

    protected $fillable = [
        'user_id', 'product_id', 'stok_kg',
    ];

    protected $casts = [
        'stok_kg' => 'integer',
    ];

    public function petani()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stockAllocations()
    {
        return $this->hasMany(StockAllocation::class);
    }
}
