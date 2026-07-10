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

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function items()
        {
            return $this->hasMany(OrderItem::class);
        }
    }