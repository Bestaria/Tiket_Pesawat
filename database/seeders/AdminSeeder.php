<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // KODE INI: Kalau email admin sudah ada, jangan bikin baru, tapi update atau lewati saja
        User::updateOrCreate(
            ['email' => 'admin@nusantara.com'], // Cek berdasarkan email
            [
                'name' => 'Admin Nusantara Air',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}