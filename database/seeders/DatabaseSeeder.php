<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Akun Admin Wajib
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin1234'), // Password di-hash
            'role' => 'admin',
        ]);

        // 2. Buat Data Dummy Jersey (Biar tabel tidak kosong)
        DB::table('products')->insert([
            [
                'team_name' => 'Manchester United',
                'season' => '2024/2025',
                'price' => 150000,
                'stock' => 10,
                'image' => null,
            ],
            [
                'team_name' => 'Real Madrid',
                'season' => '2024/2025',
                'price' => 160000,
                'stock' => 5,
                'image' => null,
            ]
        ]);
    }
}