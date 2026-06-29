<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'kode_penerbangan',
        'kota_asal',
        'kota_tujuan',
        'tanggal_berangkat',
        'jam_berangkat',
        'jam_tiba',
        'harga',
        'kuota',
        'sisa_kuota',
        'status'
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'jam_berangkat' => 'datetime',
        'jam_tiba' => 'datetime',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // ✅ Update sisa kuota
    public function updateSisaKuota()
    {
        $totalDipesan = $this->bookings()->whereIn('status', ['pending', 'confirmed'])->sum('jumlah_penumpang');
        $this->sisa_kuota = $this->kuota - $totalDipesan;
        $this->save();
    }
}