<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'no_order', 'user_id', 'total_harga', 'status', 'tanggal_pesan', 'catatan',
    ];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
    ];

    // FIX: hanya 3 status. 'diproses' adalah satu-satunya status yang masih bisa berubah,
    // 'selesai' dan 'dibatalkan' final (tidak ada tujuan transisi lagi).
    public const ALLOWED_TRANSITIONS = [
        'diproses' => ['selesai', 'dibatalkan'],
        'selesai' => [],
        'dibatalkan' => [],
    ];

    public function getAllowedNextStatusesAttribute(): array
    {
        return self::ALLOWED_TRANSITIONS[$this->status] ?? [];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
