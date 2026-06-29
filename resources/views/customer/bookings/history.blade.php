@extends('layouts.app')

@section('content')

<style>
body { background: #f8fafc; }

.container {
    max-width: 1100px;
    margin-top: 25px;
}

.card-table {
    background: white;
    border-radius: 16px;
    padding: 22px 26px 26px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
}

.card-table h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 22px;
}

.card-table .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 18px;
}

.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table-custom th {
    background: #f3f4f6;
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 12px;
}

.table-custom td {
    padding: 10px 12px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
}

.table-custom tr:hover {
    background: #f9fafb;
}

.badge-status {
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-pending {
    background: #fef3c7;
    color: #92400e;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.btn-back {
    background: #f3f4f6;
    color: #6b7280;
    padding: 6px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #e5e7eb;
    color: #111827;
}

.btn-ticket {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 4px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-ticket:hover {
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-download {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    padding: 4px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-download:hover {
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.action-group {
    display: flex;
    gap: 4px;
    align-items: center;
    flex-wrap: wrap;
}

.total-data {
    color: #6b7280;
    font-size: 13px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    padding: 10px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    border-left: 3px solid #10b981;
    font-size: 13px;
}

@media (max-width: 768px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .card-table { padding: 16px; }
    .card-table h3 { font-size: 18px; }
    .table-custom th, .table-custom td { padding: 6px 8px; font-size: 11px; }
}
</style>

<div class="container">
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>📋 Riwayat Booking</h3>
                <p class="subtitle">Daftar pemesanan tiket Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @php
            try {
                $bookings = \App\Models\Booking::with(['flight', 'flight.airline'])
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();
            } catch (\Exception $e) {
                $bookings = collect();
            }
        @endphp

        <div style="overflow-x: auto;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Maskapai</th>
                        <th>Rute</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><strong>{{ $booking->kode_booking ?? 'N/A' }}</strong></td>
                        <td>{{ $booking->flight->airline->kode ?? '-' }}</td>
                        <td>
                            {{ $booking->flight->kota_asal ?? 'N/A' }} 
                            → {{ $booking->flight->kota_tujuan ?? 'N/A' }}
                        </td>
                        <td>{{ $booking->created_at ? $booking->created_at->format('d/m/Y') : 'N/A' }}</td>
                        <td>Rp {{ number_format($booking->total_harga ?? 0,0,',','.') }}</td>
                        <td>
                            @php
                                $status = $booking->status ?? 'pending';
                                $badgeClass = [
                                    'pending' => 'badge-pending',
                                    'confirmed' => 'badge-success',
                                    'cancelled' => 'badge-danger',
                                    'completed' => 'badge-info'
                                ][$status] ?? 'badge-pending';
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                @if($booking->status == 'confirmed' || $booking->status == 'completed')
                                    <a href="{{ route('booking.ticket', $booking->id) }}" class="btn-ticket" target="_blank">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('booking.download', $booking->id) }}" class="btn-download">
                                        <i class="fas fa-download"></i> PDF
                                    </a>
                                @else
                                    <span style="color: #9ca3af; font-size: 11px;">-</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #9ca3af;">
                            <h4 style="font-size: 16px;">Belum ada pemesanan</h4>
                            <p style="font-size: 13px;">Anda belum melakukan pemesanan tiket</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-data">
            Total: {{ $bookings->count() }} pemesanan
        </div>
    </div>
</div>

@endsection