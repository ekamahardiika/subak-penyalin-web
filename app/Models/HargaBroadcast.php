<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaBroadcast extends Model
{
    protected $table = 'harga_broadcasts';

    protected $fillable = [
        'created_by', 'harga_gabah', 'sumber', 'keterangan', 'tanggal',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getSumberLabelAttribute(): string
    {
        return match ($this->sumber) {
            'hpp_pemerintah' => 'HPP Pemerintah',
            'harga_pasar' => 'Harga Pasar/Tengkulak',
            default => 'Lainnya',
        };
    }
}
