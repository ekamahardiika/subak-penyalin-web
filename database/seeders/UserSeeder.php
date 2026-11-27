<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Subak',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        User::create([
            'name' => 'Maha Sudayasa',
            'email' => 'mahasudayasa@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'petani',
            'phone' => '081234567891',
        ]);

        User::create([
            'name' => 'Sudayasa Made',
            'email' => 'sudayasamade@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'petani',
            'phone' => '081234567892',
        ]);

        User::create([
            'name' => 'Putu Mandaru',
            'email' => 'putumandaru@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'petani',
            'phone' => '081234567892',
        ]);

        User::create([
            'name' => 'I Made Budiarta',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'konsumen',
            'phone' => '081234567893',
        ]);

        User::create([
            'name' => 'Komang Sukandi',
            'email' => 'sukandi@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'konsumen',
            'phone' => '081234567894',
        ]);
    }
}