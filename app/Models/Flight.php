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
        'tanggal_berangkat' => 'datetime',
        'jam_berangkat' => 'datetime:H:i',
        'jam_tiba' => 'datetime:H:i',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function getAvailableSeatsCount()
    {
        return $this->seats()->where('is_available', true)->count();
    }

    public function getTotalSeatsCount()
    {
        return $this->seats()->count();
    }
}