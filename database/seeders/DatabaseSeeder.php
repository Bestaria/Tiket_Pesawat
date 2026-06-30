<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin dengan email dan password baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@nusantara.com', // <-- Email diubah menjadi .com
            'password' => Hash::make('admin123'), // <-- Password admin123
            'role' => 'admin',
        ]);

        // Buat User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Buat Maskapai
        $airlines = [
            ['nama' => 'Garuda Indonesia', 'kode' => 'GA'],
            ['nama' => 'Citilink', 'kode' => 'QG'],
            ['nama' => 'Lion Air', 'kode' => 'JT'],
            ['nama' => 'Batik Air', 'kode' => 'ID'],
        ];

        foreach ($airlines as $airline) {
            Airline::create($airline);
        }

        // Buat Penerbangan
        $flights = [
            [
                'airline_id' => 1,
                'kode_penerbangan' => 'GA-101',
                'kota_asal' => 'Jakarta (CGK)',
                'kota_tujuan' => 'Bali (DPS)',
                'tanggal_berangkat' => now()->addDays(1),
                'jam_berangkat' => '08:00:00',
                'jam_tiba' => '10:00:00',
                'harga' => 1500000,
                'kuota' => 100,
                'sisa_kuota' => 100,
                'status' => 'scheduled'
            ],
            [
                'airline_id' => 2,
                'kode_penerbangan' => 'QG-201',
                'kota_asal' => 'Jakarta (CGK)',
                'kota_tujuan' => 'Surabaya (SUB)',
                'tanggal_berangkat' => now()->addDays(2),
                'jam_berangkat' => '07:00:00',
                'jam_tiba' => '08:30:00',
                'harga' => 800000,
                'kuota' => 80,
                'sisa_kuota' => 80,
                'status' => 'scheduled'
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}