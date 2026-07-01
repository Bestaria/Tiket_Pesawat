<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Airline;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Seat; // <-- Tambahkan ini
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin dengan email dan password baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@nusantara.com',
            'password' => Hash::make('admin123'),
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

        // ============================================================
        // PENERBANGAN - Menggunakan Carbon agar tanggal pasti di masa depan
        // ============================================================
        $flights = [
            // 1. Garuda Indonesia - Jakarta ke Bali
            [
                'airline_id' => 1,
                'kode_penerbangan' => 'GA-101',
                'kota_asal' => 'Jakarta (CGK)',
                'kota_tujuan' => 'Bali (DPS)',
                'tanggal_berangkat' => Carbon::now()->addDays(3),
                'jam_berangkat' => '08:00:00',
                'jam_tiba' => '10:00:00',
                'harga' => 1500000,
                'kuota' => 100,
                'sisa_kuota' => 100,
                'status' => 'scheduled'
            ],
            // 2. Citilink - Jakarta ke Surabaya
            [
                'airline_id' => 2,
                'kode_penerbangan' => 'QG-201',
                'kota_asal' => 'Jakarta (CGK)',
                'kota_tujuan' => 'Surabaya (SUB)',
                'tanggal_berangkat' => Carbon::now()->addDays(4),
                'jam_berangkat' => '07:00:00',
                'jam_tiba' => '08:30:00',
                'harga' => 800000,
                'kuota' => 80,
                'sisa_kuota' => 80,
                'status' => 'scheduled'
            ],
            // 3. Lion Air - Jakarta ke Medan
            [
                'airline_id' => 3,
                'kode_penerbangan' => 'JT-301',
                'kota_asal' => 'Jakarta (CGK)',
                'kota_tujuan' => 'Medan (KNO)',
                'tanggal_berangkat' => Carbon::now()->addDays(5),
                'jam_berangkat' => '06:00:00',
                'jam_tiba' => '08:00:00',
                'harga' => 1200000,
                'kuota' => 90,
                'sisa_kuota' => 90,
                'status' => 'scheduled'
            ],
            // 4. Batik Air - Surabaya ke Bali
            [
                'airline_id' => 4,
                'kode_penerbangan' => 'ID-401',
                'kota_asal' => 'Surabaya (SUB)',
                'kota_tujuan' => 'Bali (DPS)',
                'tanggal_berangkat' => Carbon::now()->addDays(6),
                'jam_berangkat' => '09:00:00',
                'jam_tiba' => '10:30:00',
                'harga' => 600000,
                'kuota' => 70,
                'sisa_kuota' => 70,
                'status' => 'scheduled'
            ],
            // 5. Garuda Indonesia - Bali ke Jakarta
            [
                'airline_id' => 1,
                'kode_penerbangan' => 'GA-102',
                'kota_asal' => 'Bali (DPS)',
                'kota_tujuan' => 'Jakarta (CGK)',
                'tanggal_berangkat' => Carbon::now()->addDays(7),
                'jam_berangkat' => '11:00:00',
                'jam_tiba' => '13:00:00',
                'harga' => 1500000,
                'kuota' => 100,
                'sisa_kuota' => 100,
                'status' => 'scheduled'
            ],
            // 6. Citilink - Surabaya ke Jakarta
            [
                'airline_id' => 2,
                'kode_penerbangan' => 'QG-202',
                'kota_asal' => 'Surabaya (SUB)',
                'kota_tujuan' => 'Jakarta (CGK)',
                'tanggal_berangkat' => Carbon::now()->addDays(8),
                'jam_berangkat' => '14:00:00',
                'jam_tiba' => '15:30:00',
                'harga' => 850000,
                'kuota' => 80,
                'sisa_kuota' => 80,
                'status' => 'scheduled'
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }

        // ============================================================
        // GENERATE KURSI UNTUK SETIAP PENERBANGAN
        // ============================================================
        $allFlights = Flight::all();
        
        foreach ($allFlights as $flight) {
            // Tentukan jumlah kursi berdasarkan kuota
            $totalSeats = $flight->kuota;
            
            // Buat kursi dengan format: A1, A2, B1, B2, dst
            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
            $seatsPerRow = 6;
            $seatNumber = 1;
            $seatsCreated = 0;
            
            foreach ($rows as $row) {
                for ($i = 1; $i <= $seatsPerRow; $i++) {
                    if ($seatsCreated >= $totalSeats) {
                        break 2;
                    }
                    
                    $seatNumberLabel = $row . $i;
                    
                    // Tentukan kelas: 2 baris pertama = business, sisanya economy
                    $class = in_array($row, ['A', 'B']) ? 'business' : 'economy';
                    
                    Seat::create([
                        'flight_id' => $flight->id,
                        'seat_number' => $seatNumberLabel,
                        'class' => $class,
                        'is_available' => true,
                    ]);
                    
                    $seatsCreated++;
                }
            }
        }
    }
}