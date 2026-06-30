<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard',[
            'airlines' => Airline::count(),
            'flights' => Flight::count(),
            'bookings' => Booking::count(),
            'refunds' => Booking::where('status','Refund')->count()
        ]);
    }

    public function customer()
    {
        $bookings = Booking::with('flight')
            ->where('user_id', Auth::id())
            ->get();

        return view('customer.dashboard', compact('bookings'));
    }
}