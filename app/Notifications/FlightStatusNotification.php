<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FlightStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $booking;
    protected $oldStatus;
    protected $newStatus;

    public function __construct($booking, $oldStatus, $newStatus)
    {
        $this->booking = $booking;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $statusMessages = [
            'pending' => 'Menunggu',
            'confirmed' => 'Dikonfirmasi',
            'scheduled' => 'Jadwal',
            'delayed' => 'Ditunda',
            'cancelled' => 'Dibatalkan',
            'completed' => 'Selesai'
        ];

        $oldStatusText = $statusMessages[$this->oldStatus] ?? $this->oldStatus;
        $newStatusText = $statusMessages[$this->newStatus] ?? $this->newStatus;

        $flight = $this->booking->flight;
        $airline = $flight->airline ?? null;

        return (new MailMessage)
            ->subject('✈️ Perubahan Status Penerbangan - ' . $flight->kode_penerbangan)
            ->greeting('Halo ' . $this->booking->nama_pemesan . '!')
            ->line('Kami informasikan bahwa status penerbangan Anda telah berubah.')
            ->line('')
            ->line('**Detail Penerbangan:**')
            ->line('📌 **Kode Booking:** ' . $this->booking->kode_booking)
            ->line('✈️ **Maskapai:** ' . ($airline ? $airline->nama : 'N/A'))
            ->line('🛫 **Kode Penerbangan:** ' . $flight->kode_penerbangan)
            ->line('📍 **Rute:** ' . $flight->kota_asal . ' → ' . $flight->kota_tujuan)
            ->line('📅 **Tanggal:** ' . \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d F Y'))
            ->line('🕐 **Jam:** ' . \Carbon\Carbon::parse($flight->jam_berangkat)->format('H:i') . ' - ' . \Carbon\Carbon::parse($flight->jam_tiba)->format('H:i'))
            ->line('')
            ->line('**Status Penerbangan:**')
            ->line('🔄 **Sebelumnya:** ' . $oldStatusText)
            ->line('✅ **Sekarang:** ' . $newStatusText)
            ->line('')
            ->when($this->newStatus == 'delayed', function ($mail) {
                return $mail->line('⏰ Mohon perhatikan jadwal baru penerbangan Anda.');
            })
            ->when($this->newStatus == 'cancelled', function ($mail) {
                return $mail->line('❌ Penerbangan Anda dibatalkan. Silakan hubungi customer service untuk informasi lebih lanjut.');
            })
            ->line('')
            ->line('Terima kasih telah menggunakan layanan kami.')
            ->salutation('Salam, **Air Ticket**');
    }
}