<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\JadwalController; // <-- Tambahkan ini
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SeatController;
use App\Models\Notification;

// 1. HALAMAN UTAMA (Redirect ke Login)
Route::get('/', function () {
    return redirect('/login');
});

// 2. RUTE AUTHENTIKASI (Public)
Route::get('/login', function () { 
    return view('auth.login'); 
})->name('login'); 

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () { 
    return view('auth.register'); 
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

// 3. RUTE DENGAN PROTEKSI LOGIN (Auth)
Route::middleware('auth')->group(function () {
    
    // ==========================================
    // GRUP RUTE PELANGGAN / USER (customer)
    // ==========================================
    Route::middleware('role:user')->group(function () {
        
        // Dashboard User
        Route::get('/dashboard', function () { 
            return view('customer.dashboard'); 
        })->name('dashboard');
        
        // Jadwal (Lihat Jadwal) - PAKAI CONTROLLER
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
        
        // Booking - Create (form pemesanan)
        Route::get('/booking/create/{jadwal_id}', [BookingController::class, 'create'])->name('booking.create');
        
        // Booking - Store (simpan pemesanan)
        Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
        
        // History Booking
        Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
        
        // Ticket PDF - View
        Route::get('/booking/ticket/{id}', [BookingController::class, 'ticketPdf'])->name('booking.ticket');
        
        // Ticket PDF - Download
        Route::get('/booking/ticket/download/{id}', [BookingController::class, 'downloadPdf'])->name('booking.download');
        
        // ==========================================
        // RUTE KURSI (SEATS)
        // ==========================================
        Route::get('/seats/{flight_id}', [SeatController::class, 'getAvailableSeats'])->name('seats.available');
        Route::post('/seats/check', [SeatController::class, 'checkAvailability'])->name('seats.check');
        
        // NOTIFIKASI
        Route::post('/notification/mark-read/{id}', [NotificationController::class, 'markRead'])->name('notification.markRead');
        Route::post('/notification/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notification.markAllRead');
    });

    // ==========================================
    // GRUP RUTE ADMIN
    // ==========================================
    Route::middleware('role:admin')->group(function () {
        
        // Dashboard Admin
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // ROUTE AIRLINES
        Route::get('/admin/airlines', [AirlineController::class, 'index'])->name('airlines.index');
        Route::get('/admin/airlines/create', [AirlineController::class, 'create'])->name('airlines.create');
        Route::post('/admin/airlines', [AirlineController::class, 'store'])->name('airlines.store');
        Route::get('/admin/airlines/{id}/edit', [AirlineController::class, 'edit'])->name('airlines.edit');
        Route::put('/admin/airlines/{id}', [AirlineController::class, 'update'])->name('airlines.update');
        Route::delete('/admin/airlines/{id}', [AirlineController::class, 'destroy'])->name('airlines.destroy');
        
        // ROUTE FLIGHTS
        Route::get('/admin/flights', [FlightController::class, 'index'])->name('flights.index');
        Route::get('/admin/flights/create', [FlightController::class, 'create'])->name('flights.create');
        Route::post('/admin/flights', [FlightController::class, 'store'])->name('flights.store');
        Route::get('/admin/flights/{id}/edit', [FlightController::class, 'edit'])->name('flights.edit');
        Route::put('/admin/flights/{id}', [FlightController::class, 'update'])->name('flights.update');
        Route::delete('/admin/flights/{id}', [FlightController::class, 'destroy'])->name('flights.destroy');
        
        // ROUTE BOOKINGS (Admin)
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/admin/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
        Route::put('/admin/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
        Route::put('/admin/bookings/cancel/{id}', [BookingController::class, 'cancel'])->name('bookings.cancel');
        Route::delete('/admin/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
        
        // ROUTE SEATS (Admin) - Untuk melihat manajemen kursi
        Route::get('/admin/seats/{flight_id}', [SeatController::class, 'index'])->name('admin.seats.index');
        Route::put('/admin/seats/{id}', [SeatController::class, 'update'])->name('admin.seats.update');
        
        // LAPORAN
        Route::get('/laporan', function () { 
            return view('admin.laporan'); 
        })->name('laporan');
    });
    
});

// NOTIFIKASI - Route tambahan (diluar middleware)
Route::post('/notification/mark-read/{id}', function ($id) {
    $notif = Notification::where('user_id', auth()->id())->findOrFail($id);
    $notif->update(['is_read' => true]);
    return back();
})->name('notification.markRead');

Route::post('/notification/mark-all-read', function () {
    Notification::where('user_id', auth()->id())
        ->where('is_read', false)
        ->update(['is_read' => true]);
    return back();
})->name('notification.markAllRead');