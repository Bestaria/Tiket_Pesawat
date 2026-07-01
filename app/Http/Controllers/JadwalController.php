<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $flights = Flight::with('airline')
            ->where('tanggal_berangkat', '>=', now())
            ->orderBy('tanggal_berangkat', 'asc')
            ->get();
        
        return view('customer.jadwal', compact('flights'));
    }
}