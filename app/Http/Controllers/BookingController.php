<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Notification;
use App\Notifications\FlightStatusNotification;
use Illuminate\Support\Facades\Notification as MailNotification;
use Dompdf\Dompdf;

class BookingController extends Controller
{
    // ✅ CREATE - Untuk User (Form Booking)
    public function create($jadwal_id)
    {
        $flight = Flight::with('airline')->findOrFail($jadwal_id);
        return view('customer.bookings.create', compact('flight'));
    }

    // ✅ STORE - Untuk User (Simpan Booking)
    public function store(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'jumlah_penumpang' => 'required|integer|min:1',
        ]);

        $flight = Flight::findOrFail($request->flight_id);
        
        $sisaKuota = $flight->sisa_kuota ?? $flight->kuota;
        if ($request->jumlah_penumpang > $sisaKuota) {
            return back()->with('error', 'Maaf, kursi tersisa hanya ' . $sisaKuota);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'flight_id' => $flight->id,
            'kode_booking' => Booking::generateKodeBooking(),
            'nama_pemesan' => auth()->user()->name,
            'email_pemesan' => auth()->user()->email,
            'no_telepon' => $request->no_telepon ?? '-',
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'total_harga' => $flight->harga * $request->jumlah_penumpang,
            'status' => 'confirmed',
            'tanggal_pemesanan' => now(),
        ]);

        $flight->updateSisaKuota();

        return redirect()->route('booking.history')->with('success', 'Booking berhasil! Kode: ' . $booking->kode_booking);
    }

    // ✅ HISTORY - Untuk User (Riwayat Booking)
    public function history()
    {
        return view('customer.bookings.history');
    }

    // ✅ TICKET PDF - Untuk User (Lihat Tiket)
    public function ticketPdf($id)
    {
        $booking = Booking::with(['flight', 'flight.airline'])->findOrFail($id);
        
        if ($booking->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke tiket ini');
        }
        
        return view('customer.bookings.ticket_pdf', compact('booking'));
    }

    // ✅ DOWNLOAD PDF - Untuk User (Download Tiket)
    public function downloadPdf($id)
    {
        try {
            $booking = Booking::with(['flight', 'flight.airline'])->findOrFail($id);
            
            if ($booking->user_id != auth()->id()) {
                abort(403, 'Anda tidak memiliki akses ke tiket ini');
            }
            
            $html = view('customer.bookings.ticket_pdf', compact('booking'))->render();
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $output = $dompdf->output();
            
            return response($output, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="tiket_' . $booking->kode_booking . '.pdf"',
            ]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal download PDF: ' . $e->getMessage());
        }
    }

    // ✅ INDEX - Untuk Admin (Manajemen Booking)
    public function index()
    {
        $bookings = Booking::with(['user', 'flight.airline'])->orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // ✅ SHOW - Untuk Admin (Detail Booking)
    public function show($id)
    {
        $booking = Booking::with(['user', 'flight.airline'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    // ✅ UPDATE - Untuk Admin (Update Status Booking + Kirim Notifikasi)
    public function update(Request $request, $id)
    {
        $booking = Booking::with(['user', 'flight.airline'])->findOrFail($id);
        $oldStatus = $booking->status;
        $newStatus = $request->status;

        // Update status
        $booking->update([
            'status' => $newStatus
        ]);

        // Kirim notifikasi ke database jika status berubah
        if ($oldStatus != $newStatus && $booking->user) {
            $this->sendNotification($booking, $oldStatus, $newStatus);
        }

        // Kirim email notifikasi (opsional)
        if ($oldStatus != $newStatus && $booking->user && $booking->user->email) {
            try {
                MailNotification::route('mail', $booking->user->email)
                    ->notify(new FlightStatusNotification($booking, $oldStatus, $newStatus));
            } catch (\Exception $e) {
                \Log::error('Gagal kirim notifikasi email: ' . $e->getMessage());
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Status booking berhasil diupdate! Notifikasi telah dikirim ke customer.');
    }

    // ✅ CANCEL - Untuk Admin (Batalkan Booking)
    public function cancel($id)
    {
        $booking = Booking::with(['user', 'flight.airline'])->findOrFail($id);
        $oldStatus = $booking->status;
        $newStatus = 'cancelled';

        // Cek apakah booking sudah dibatalkan
        if ($oldStatus == 'cancelled') {
            return redirect()->route('bookings.index')->with('error', 'Booking ini sudah dibatalkan sebelumnya.');
        }

        // Cek apakah booking sudah selesai
        if ($oldStatus == 'completed') {
            return redirect()->route('bookings.index')->with('error', 'Booking ini sudah selesai, tidak bisa dibatalkan.');
        }

        // Update status menjadi cancelled
        $booking->update([
            'status' => $newStatus
        ]);

        // Kembalikan kuota
        $flight = $booking->flight;
        if ($flight) {
            $flight->sisa_kuota = ($flight->sisa_kuota ?? $flight->kuota) + $booking->jumlah_penumpang;
            $flight->save();
        }

        // Kirim notifikasi ke database
        if ($booking->user) {
            $this->sendNotification($booking, $oldStatus, $newStatus);
        }

        // Kirim email notifikasi
        if ($booking->user && $booking->user->email) {
            try {
                MailNotification::route('mail', $booking->user->email)
                    ->notify(new FlightStatusNotification($booking, $oldStatus, $newStatus));
            } catch (\Exception $e) {
                \Log::error('Gagal kirim notifikasi email: ' . $e->getMessage());
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan! Notifikasi telah dikirim ke customer.');
    }

    // ✅ DESTROY - Untuk Admin (Hapus Booking)
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }

    // ✅ Fungsi Kirim Notifikasi
    private function sendNotification($booking, $oldStatus, $newStatus)
    {
        $statusMessages = [
            'pending' => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'scheduled' => 'Dijadwalkan',
            'delayed' => 'Ditunda',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai'
        ];

        $oldStatusText = $statusMessages[$oldStatus] ?? $oldStatus;
        $newStatusText = $statusMessages[$newStatus] ?? $newStatus;

        $flight = $booking->flight;

        // Tentukan type notifikasi
        if ($newStatus == 'cancelled') {
            $type = 'danger';
        } elseif ($newStatus == 'delayed') {
            $type = 'warning';
        } else {
            $type = 'success';
        }

        // Pesan tambahan untuk pembatalan
        $additionalMessage = '';
        if ($newStatus == 'cancelled') {
            $additionalMessage = ' Penerbangan Anda telah dibatalkan oleh admin. Silakan hubungi customer service untuk informasi lebih lanjut.';
        } elseif ($newStatus == 'delayed') {
            $additionalMessage = ' Mohon perhatikan jadwal baru penerbangan Anda.';
        }

        Notification::create([
            'user_id' => $booking->user_id,
            'title' => $newStatus == 'cancelled' ? '❌ Penerbangan Dibatalkan' : '✈️ Perubahan Status Penerbangan',
            'message' => 'Penerbangan ' . $flight->kode_penerbangan . ' (' . $flight->kota_asal . ' → ' . $flight->kota_tujuan . ') status berubah dari **' . $oldStatusText . '** menjadi **' . $newStatusText . '**.' . $additionalMessage,
            'type' => $type,
            'is_read' => false,
            'link' => route('booking.history'),
        ]);
    }
}