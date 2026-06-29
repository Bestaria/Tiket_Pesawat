@extends('layouts.app')

@section('content')

<style>
body { background: #f8fafc; }

.container {
    max-width: 1200px;
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

.btn-delete {
    background: #ef4444;
    color: white;
    padding: 4px 10px;
    border-radius: 6px;
    border: none;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #dc2626;
}

.btn-cancel {
    background: #f59e0b;
    color: white;
    padding: 4px 10px;
    border-radius: 6px;
    border: none;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #d97706;
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

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 10px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    border-left: 3px solid #ef4444;
    font-size: 13px;
}

.status-select {
    padding: 3px 6px;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    font-size: 11px;
    background: white;
    cursor: pointer;
}

.status-select:focus {
    border-color: #6366f1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

@media (max-width: 768px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .card-table { padding: 16px; }
    .card-table h3 { font-size: 18px; }
    .table-custom th, .table-custom td { padding: 6px 8px; font-size: 10px; }
}
</style>

<div class="container">
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>📋 Manajemen Booking</h3>
                <p class="subtitle">Kelola semua pemesanan tiket</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">❌ {{ session('error') }}</div>
        @endif

        <div style="overflow-x: auto;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Customer</th>
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
                        <td>{{ $booking->user->name ?? $booking->nama_pemesan ?? 'N/A' }}</td>
                        <td>{{ $booking->flight->airline->nama ?? '-' }}</td>
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
                                <!-- Form Update Status -->
                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>

                                <!-- Tombol Cancel khusus -->
                                @if($booking->status != 'cancelled' && $booking->status != 'completed')
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                        <i class="fas fa-times"></i> Batalkan
                                    </button>
                                </form>
                                @endif

                                <!-- Hapus -->
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus booking ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 30px; color: #9ca3af;">
                            <h4 style="font-size: 16px;">Belum ada pemesanan</h4>
                            <p style="font-size: 13px;">Belum ada data booking</p>
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