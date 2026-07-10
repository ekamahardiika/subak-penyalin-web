<?php

namespace Database\Seeders;

use App\Models\HargaBroadcast;
use App\Models\User;
use Illuminate\Database\Seeder;

class HargaBroadcastSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        HargaBroadcast::create([
            'created_by' => $admin->id,
            'harga_gabah' => 6500,
            'keterangan' => 'Harga gabah kering panen hari ini',
            'tanggal' => now(),
        ]);
    }
}