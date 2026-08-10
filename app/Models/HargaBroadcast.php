<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/HargaBroadcast.php

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

    // Label yang enak dibaca di view
    public function getSumberLabelAttribute(): string
    {
        return match ($this->sumber) {
            'hpp_pemerintah' => 'HPP Pemerintah',
            'harga_pasar' => 'Harga Pasar/Tengkulak',
            default => 'Lainnya',
        };
    }
}
