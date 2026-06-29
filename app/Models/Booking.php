<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'kode_booking',
        'nama_pemesan',
        'email_pemesan',
        'no_telepon',
        'jumlah_penumpang',
        'total_harga',
        'status',
        'tanggal_pemesanan'
    ];

    protected $casts = [
        'tanggal_pemesanan' => 'date',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public static function generateKodeBooking()
    {
        $prefix = 'BK';
        $random = strtoupper(substr(uniqid(), -6));
        return $prefix . $random;
    }
}