<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    // ✅ Get Available Seats (API untuk Customer)
    public function getAvailableSeats($flight_id)
    {
        $flight = Flight::findOrFail($flight_id);
        
        $seats = Seat::where('flight_id', $flight_id)
            ->where('is_available', true)
            ->orderBy('seat_number')
            ->get();
        
        return response()->json([
            'success' => true,
            'total_available' => $seats->count(),
            'total_seats' => Seat::where('flight_id', $flight_id)->count(),
            'seats' => $seats->groupBy('class')
        ]);
    }

    // ✅ Check Availability (API untuk Customer)
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'exists:seats,id'
        ]);

        $seats = Seat::whereIn('id', $request->seat_ids)->get();
        
        $unavailable = $seats->filter(function($seat) {
            return !$seat->is_available;
        });

        if ($unavailable->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Beberapa kursi sudah tidak tersedia',
                'unavailable_seats' => $unavailable->pluck('seat_number')
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Semua kursi tersedia'
        ]);
    }

    // ✅ Admin: Lihat semua kursi
    public function index($flight_id)
    {
        $flight = Flight::with('airline')->findOrFail($flight_id);
        $seats = Seat::where('flight_id', $flight_id)
            ->orderBy('seat_number')
            ->get();
        
        return view('admin.seats.index', compact('flight', 'seats'));
    }

    // ✅ Admin: Update status kursi
    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);
        $seat->update([
            'is_available' => $request->is_available
        ]);

        return back()->with('success', 'Status kursi ' . $seat->seat_number . ' berhasil diupdate!');
    }
}