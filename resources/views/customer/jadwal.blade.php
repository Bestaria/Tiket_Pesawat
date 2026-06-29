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

.badge-scheduled {
    background: #dbeafe;
    color: #1e40af;
}

.badge-delayed {
    background: #fef3c7;
    color: #92400e;
}

.badge-cancelled {
    background: #fee2e2;
    color: #991b1b;
}

.btn-book {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 4px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-book:hover {
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.alert-info {
    background: #dbeafe;
    color: #1e40af;
    padding: 10px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    border-left: 3px solid #3b82f6;
    font-size: 13px;
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

.total-data {
    color: #6b7280;
    font-size: 13px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
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
                <h3>🛫 Jadwal Penerbangan</h3>
                <p class="subtitle">Lihat jadwal penerbangan yang tersedia</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert-info">✅ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; border-left: 3px solid #ef4444; font-size: 13px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        @php
            try {
                $flights = \App\Models\Flight::with('airline')
                    ->where('tanggal_berangkat', '>=', now())
                    ->orderBy('tanggal_berangkat', 'asc')
                    ->get();
            } catch (\Exception $e) {
                $flights = collect();
            }
        @endphp

        <div style="overflow-x: auto;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Maskapai</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th>Berangkat</th>
                        <th>Tiba</th>
                        <th>Harga</th>
                        <th>Kursi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($flights as $flight)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><strong>{{ $flight->kode_penerbangan }}</strong></td>
                        <td>{{ $flight->airline->kode ?? '-' }}</td>
                        <td>{{ $flight->kota_asal }}</td>
                        <td>{{ $flight->kota_tujuan }}</td>
                        <td>{{ $flight->tanggal_berangkat ? \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $flight->jam_berangkat ? \Carbon\Carbon::parse($flight->jam_berangkat)->format('H:i') : '-' }}</td>
                        <td>{{ $flight->jam_tiba ? \Carbon\Carbon::parse($flight->jam_tiba)->format('H:i') : '-' }}</td>
                        <td>Rp {{ number_format($flight->harga,0,',','.') }}</td>
                        <td>{{ $flight->sisa_kuota ?? $flight->kuota }}/{{ $flight->kuota }}</td>
                        <td>
                            @php
                                $statusClass = [
                                    'scheduled' => 'badge-scheduled',
                                    'delayed' => 'badge-delayed',
                                    'cancelled' => 'badge-cancelled',
                                ][$flight->status] ?? 'badge-scheduled';
                            @endphp
                            <span class="badge-status {{ $statusClass }}">
                                {{ ucfirst($flight->status) }}
                            </span>
                        </td>
                        <td>
                            @if($flight->status == 'scheduled' && ($flight->sisa_kuota ?? $flight->kuota) > 0)
                                <a href="{{ route('booking.create', $flight->id) }}" class="btn-book">
                                    <i class="fas fa-ticket-alt"></i> Pesan
                                </a>
                            @else
                                <span style="color: #9ca3af; font-size: 11px;">Tidak Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 30px; color: #9ca3af;">
                            <h4 style="font-size: 16px;">Belum ada jadwal penerbangan</h4>
                            <p style="font-size: 13px;">Saat ini belum ada penerbangan yang tersedia</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-data">
            Total: {{ $flights->count() }} penerbangan
        </div>
    </div>
</div>

@endsection