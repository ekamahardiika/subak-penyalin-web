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
            'name' => 'Eka Mahardika',
            'email' => 'eka@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'petani',
            'phone' => '081234567891',
        ]);

        User::create([
            'name' => 'Wayan Petani',
            'email' => 'petani2@subak.test',
            'password' => Hash::make('password'),
            'role' => 'petani',
            'phone' => '081234567892',
        ]);

        User::create([
            'name' => 'Budi Satu',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'konsumen',
            'phone' => '081234567893',
        ]);

        User::create([
            'name' => 'Konsumen Dua',
            'email' => 'konsumen2@subak.test',
            'password' => Hash::make('password'),
            'role' => 'konsumen',
            'phone' => '081234567894',
        ]);
    }
}