<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaBroadcast extends Model
{
    protected $table = 'harga_broadcasts';

    protected $fillable = [
        'created_by', 'harga_gabah', 'keterangan', 'tanggal',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}