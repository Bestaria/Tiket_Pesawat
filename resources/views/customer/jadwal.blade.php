@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #f0f2f5 0%, #e8ecf1 100%);
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin-top: 25px;
}

/* ===== HERO ===== */
.hero-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 30px 35px;
    margin-bottom: 25px;
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.hero-card h1 {
    color: white;
    font-weight: 800;
    font-size: 28px;
    margin-bottom: 5px;
}

.hero-card h1 i {
    margin-right: 10px;
}

.hero-card p {
    color: rgba(255,255,255,0.85);
    font-size: 15px;
    margin: 0;
}

.hero-card .btn-back {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
}

.hero-card .btn-back:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: translateY(-2px);
}

/* ===== CARD TABLE ===== */
.card-table {
    background: white;
    border-radius: 16px;
    padding: 22px 26px 26px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.card-table .header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 18px;
}

.card-table .header-section h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 22px;
}

.card-table .header-section h3 i {
    color: #667eea;
    margin-right: 8px;
}

.card-table .header-section .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin: 0;
}

.card-table .header-section .filter-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.card-table .header-section .filter-badges .badge-filter {
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.badge-filter.bg-success {
    background: #d1fae5 !important;
    color: #065f46 !important;
}

.badge-filter.bg-danger {
    background: #fee2e2 !important;
    color: #991b1b !important;
}

/* ===== ALERT ===== */
.alert-custom {
    padding: 12px 18px;
    border-radius: 10px;
    margin-bottom: 16px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-custom.success {
    background: #d1fae5;
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-custom.error {
    background: #fee2e2;
    color: #991b1b;
    border-left: 4px solid #ef4444;
}

.alert-custom.info {
    background: #dbeafe;
    color: #1e40af;
    border-left: 4px solid #3b82f6;
}

/* ===== TABLE ===== */
.table-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table-custom thead {
    background: #f8fafc;
}

.table-custom th {
    padding: 12px 14px;
    text-align: left;
    font-weight: 700;
    color: #374151;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e5e7eb;
    white-space: nowrap;
}

.table-custom td {
    padding: 12px 14px;
    border-bottom: 1px solid #f1f3f5;
    vertical-align: middle;
}

.table-custom tbody tr {
    transition: all 0.2s ease;
}

.table-custom tbody tr:hover {
    background: #f8fafc;
}

/* ===== BADGE KODE ===== */
.badge-kode {
    background: #e0e7ff;
    color: #4338ca;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}

/* ===== BADGE STATUS ===== */
.badge-status {
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
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

.badge-departed {
    background: #c7d2fe;
    color: #3730a3;
}

.badge-arrived {
    background: #d1fae5;
    color: #065f46;
}

/* ===== SEAT INFO ===== */
.seat-info {
    display: flex;
    align-items: center;
    gap: 4px;
}

.seat-info .available {
    color: #10b981;
    font-weight: 700;
}

.seat-info .total {
    color: #6b7280;
}

/* ===== BUTTON BOOK ===== */
.btn-book {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-book:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.btn-book:disabled,
.btn-book.disabled {
    background: #9ca3af;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 50px 20px;
    color: #9ca3af;
}

.empty-state .empty-icon {
    font-size: 56px;
    margin-bottom: 12px;
    display: block;
}

.empty-state h4 {
    color: #4a5568;
    font-size: 18px;
    margin-bottom: 5px;
}

.empty-state p {
    font-size: 14px;
    margin: 0;
}

/* ===== TOTAL DATA ===== */
.total-data {
    color: #6b7280;
    font-size: 13px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.total-data .count-badge {
    background: #667eea;
    color: white;
    padding: 2px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .hero-card {
        padding: 25px;
        flex-direction: column;
        text-align: center;
    }
    .hero-card .btn-back {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .hero-card { padding: 20px; }
    .hero-card h1 { font-size: 20px; }
    .card-table { padding: 16px; }
    .card-table .header-section h3 { font-size: 18px; }
    .table-custom th, .table-custom td { 
        padding: 8px 10px; 
        font-size: 11px;
        white-space: nowrap;
    }
    .btn-book { padding: 4px 12px; font-size: 10px; }
    .badge-kode { font-size: 10px; padding: 2px 10px; }
    .badge-status { font-size: 9px; padding: 3px 10px; }
}

@media (max-width: 480px) {
    .hero-card h1 { font-size: 17px; }
    .table-custom th, .table-custom td { font-size: 10px; padding: 6px 6px; }
    .btn-book { font-size: 9px; padding: 3px 8px; }
    .card-table .header-section { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="container">

    <!-- ===== HERO ===== -->
    <div class="hero-card">
        <div>
            <h1><i class="fas fa-plane-departure"></i> Jadwal Penerbangan</h1>
            <p>Lihat jadwal penerbangan yang tersedia dan pesan tiket sekarang!</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- ===== CARD TABLE ===== -->
    <div class="card-table">
        <div class="header-section">
            <div>
                <h3><i class="fas fa-table"></i> Daftar Penerbangan</h3>
                <p class="subtitle">Semua jadwal penerbangan yang tersedia saat ini</p>
            </div>
            <div class="filter-badges">
                <span class="badge-filter bg-success">🟢 Tersedia</span>
                <span class="badge-filter bg-danger">🔴 Habis</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-custom success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-custom error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
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

        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>#</th>
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
                        <td><span class="badge-kode">{{ $flight->kode_penerbangan }}</span></td>
                        <td><strong>{{ $flight->airline->nama ?? $flight->airline->kode ?? '-' }}</strong></td>
                        <td>{{ $flight->kota_asal }}</td>
                        <td>{{ $flight->kota_tujuan }}</td>
                        <td>{{ $flight->tanggal_berangkat ? \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $flight->jam_berangkat ? \Carbon\Carbon::parse($flight->jam_berangkat)->format('H:i') : '-' }}</td>
                        <td>{{ $flight->jam_tiba ? \Carbon\Carbon::parse($flight->jam_tiba)->format('H:i') : '-' }}</td>
                        <td><strong>Rp {{ number_format($flight->harga, 0, ',', '.') }}</strong></td>
                        <td>
                            <span class="seat-info">
                                <span class="available">{{ $flight->sisa_kuota ?? $flight->kuota }}</span>
                                <span class="total">/ {{ $flight->kuota }}</span>
                            </span>
                        </td>
                        <td>
                            @php
                                $statusMap = [
                                    'scheduled' => 'badge-scheduled',
                                    'delayed' => 'badge-delayed',
                                    'cancelled' => 'badge-cancelled',
                                    'departed' => 'badge-departed',
                                    'arrived' => 'badge-arrived',
                                ];
                                $statusClass = $statusMap[$flight->status] ?? 'badge-scheduled';
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
                            @elseif($flight->status == 'scheduled' && ($flight->sisa_kuota ?? $flight->kuota) <= 0)
                                <span class="btn-book disabled" style="background: #9ca3af; cursor: not-allowed;">
                                    <i class="fas fa-times"></i> Habis
                                </span>
                            @else
                                <span style="color: #9ca3af; font-size: 11px; font-weight: 500;">
                                    <i class="fas fa-minus-circle"></i> Tidak Tersedia
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">
                            <div class="empty-state">
                                <span class="empty-icon">🛫</span>
                                <h4>Belum ada jadwal penerbangan</h4>
                                <p>Saat ini belum ada penerbangan yang tersedia. Silakan cek kembali nanti.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-data">
            <span>
                <i class="fas fa-plane" style="color: #667eea;"></i>
                Menampilkan <strong>{{ $flights->count() }}</strong> penerbangan
            </span>
            <span class="count-badge">
                {{ $flights->where('status', 'scheduled')->count() }} Tersedia
            </span>
        </div>
    </div>

</div>

@endsection