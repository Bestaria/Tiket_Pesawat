@extends('layouts.app')

@section('content')

<style>
body {
    background: #f0f2f5;
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

/* ===== CARD ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 16px 24px;
    border: none;
}

.card-header h4 {
    margin: 0;
    font-weight: 700;
}

.card-header h4 i {
    margin-right: 8px;
}

.card-body {
    padding: 24px;
}

/* ===== FLIGHT INFO ===== */
.flight-info {
    background: #f8fafc;
    border-radius: 12px;
    padding: 16px 20px;
    border-left: 4px solid #667eea;
    margin-bottom: 20px;
}

.flight-info .airline-name {
    font-weight: 700;
    font-size: 16px;
    color: #111827;
}

.flight-info .flight-code {
    background: #e0e7ff;
    color: #4338ca;
    padding: 2px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.flight-info .route {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
}

.flight-info .route i {
    color: #667eea;
    margin: 0 10px;
}

.flight-info .detail {
    color: #6b7280;
    font-size: 13px;
}

.flight-info .detail i {
    width: 18px;
    color: #667eea;
}

/* ===== STATS ===== */
.seat-stats {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}

.seat-stats .stat-item {
    font-size: 13px;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    background: #f8fafc;
}

.seat-stats .stat-item .badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
}

/* ===== SEAT GRID ===== */
.seat-grid {
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    gap: 8px;
    max-width: 600px;
    margin: 0 auto;
}

.seat-item {
    text-align: center;
    padding: 10px 4px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    border: 2px solid #e5e7eb;
    background: white;
    color: #374151;
    transition: all 0.3s ease;
}

.seat-item.available {
    border-color: #10b981;
    background: #d1fae5;
    color: #065f46;
}

.seat-item.available:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.seat-item.unavailable {
    border-color: #ef4444;
    background: #fee2e2;
    color: #991b1b;
}

.seat-item.unavailable:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.seat-item.business {
    border-color: #f59e0b;
    background: #fffbeb;
}

.seat-item.business.available {
    border-color: #f59e0b;
    background: #fef3c7;
    color: #92400e;
}

.seat-item .seat-number {
    font-size: 14px;
}

.seat-item .seat-class {
    font-size: 9px;
    display: block;
    opacity: 0.7;
}

/* ===== FORM TOGGLE ===== */
.toggle-form {
    display: inline-block;
}

.toggle-form .toggle-btn {
    padding: 4px 12px;
    border: none;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-form .toggle-btn.btn-available {
    background: #10b981;
    color: white;
}

.toggle-form .toggle-btn.btn-available:hover {
    background: #059669;
}

.toggle-form .toggle-btn.btn-unavailable {
    background: #ef4444;
    color: white;
}

.toggle-form .toggle-btn.btn-unavailable:hover {
    background: #dc2626;
}

/* ===== LEGEND ===== */
.legend {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 16px;
}

.legend .legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
}

.legend .legend-item .color-box {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    border: 2px solid #e5e7eb;
}

.legend .legend-item .color-box.available {
    background: #10b981;
    border-color: #10b981;
}

.legend .legend-item .color-box.unavailable {
    background: #ef4444;
    border-color: #ef4444;
}

.legend .legend-item .color-box.business {
    background: #f59e0b;
    border-color: #f59e0b;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .container { padding: 0 14px; }
}

@media (max-width: 768px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .hero-card { padding: 20px; flex-direction: column; text-align: center; }
    .hero-card h1 { font-size: 20px; }
    .hero-card .btn-back { width: 100%; justify-content: center; }
    .card-body { padding: 16px; }
    .flight-info .route { font-size: 14px; }
    .flight-info .route i { margin: 0 5px; }
    .seat-grid { grid-template-columns: repeat(4, 1fr); max-width: 100%; }
}

@media (max-width: 480px) {
    .seat-grid { grid-template-columns: repeat(3, 1fr); }
    .seat-stats { gap: 10px; }
    .seat-stats .stat-item { font-size: 11px; padding: 4px 10px; }
}
</style>

<div class="container">

    <!-- HERO -->
    <div class="hero-card">
        <div>
            <h1><i class="fas fa-chair"></i> Manajemen Kursi</h1>
            <p>Kelola kursi penerbangan {{ $flight->kode_penerbangan }}</p>
        </div>
        <a href="{{ route('flights.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Penerbangan
        </a>
    </div>

    <!-- CARD -->
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-plane"></i> {{ $flight->airline->nama ?? 'N/A' }} - {{ $flight->kode_penerbangan }}</h4>
        </div>
        <div class="card-body">

            <!-- FLIGHT INFO -->
            <div class="flight-info">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="airline-name">{{ $flight->airline->nama ?? 'N/A' }}</div>
                        <span class="flight-code">{{ $flight->kode_penerbangan }}</span>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="route">
                            {{ $flight->kota_asal }}
                            <i class="fas fa-arrow-right"></i>
                            {{ $flight->kota_tujuan }}
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="detail"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d F Y') }}</div>
                        <div class="detail"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($flight->jam_berangkat)->format('H:i') }} - {{ \Carbon\Carbon::parse($flight->jam_tiba)->format('H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- STATS -->
            <div class="seat-stats">
                <span class="stat-item">
                    <span class="badge bg-success">🟩 Tersedia: {{ $seats->where('is_available', true)->count() }}</span>
                </span>
                <span class="stat-item">
                    <span class="badge bg-danger">🟥 Terisi: {{ $seats->where('is_available', false)->count() }}</span>
                </span>
                <span class="stat-item">
                    <span class="badge bg-warning text-dark">🟨 Business: {{ $seats->where('class', 'business')->count() }}</span>
                </span>
                <span class="stat-item">
                    <span class="badge bg-primary">🟦 Economy: {{ $seats->where('class', 'economy')->count() }}</span>
                </span>
            </div>

            <!-- SEAT GRID -->
            <div class="seat-grid">
                @foreach($seats as $seat)
                    <div class="seat-item 
                        {{ $seat->class }} 
                        {{ $seat->is_available ? 'available' : 'unavailable' }}">
                        <div class="seat-number">{{ $seat->seat_number }}</div>
                        <span class="seat-class">{{ ucfirst($seat->class) }}</span>
                        
                        <form action="{{ route('admin.seats.update', $seat->id) }}" method="POST" class="toggle-form mt-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_available" value="{{ $seat->is_available ? 0 : 1 }}">
                            <button type="submit" class="toggle-btn btn-{{ $seat->is_available ? 'available' : 'unavailable' }}">
                                {{ $seat->is_available ? 'Tersedia' : 'Terisi' }}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- LEGEND -->
            <div class="legend">
                <span class="legend-item">
                    <span class="color-box available"></span> Tersedia
                </span>
                <span class="legend-item">
                    <span class="color-box unavailable"></span> Terisi
                </span>
                <span class="legend-item">
                    <span class="color-box business"></span> Business Class
                </span>
            </div>

            <div class="mt-3 text-center text-muted" style="font-size: 12px;">
                <i class="fas fa-info-circle"></i> Klik tombol pada kursi untuk mengubah status (Tersedia/Terisi)
            </div>
        </div>
    </div>
</div>

@endsection