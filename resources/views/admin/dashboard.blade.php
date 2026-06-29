@extends('layouts.app')

@section('content')

<style>
/* ===== FULL PAGE BACKGROUND ===== */
body {
    background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2000&q=100') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 0;
}

/* Semua konten di atas overlay */
.container {
    position: relative;
    z-index: 1;
    max-width: 1200px;
}

/* HERO */
.hero-card {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 20px;
    overflow: hidden;
    min-height: 180px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    margin-bottom: 25px;
    border: 1px solid rgba(255,255,255,0.12);
}

.hero-overlay {
    padding: 30px 40px;
}

.hero-overlay h4 {
    font-size: 22px;
    color: white;
    margin-bottom: 5px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-overlay h1 {
    font-size: 40px;
    font-weight: 800;
    color: white;
    margin-bottom: 8px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-overlay p {
    font-size: 16px;
    color: rgba(255,255,255,0.85);
    margin-bottom: 15px;
}

.btn-report {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    text-decoration: none;
    padding: 10px 22px;
    border-radius: 10px;
    display: inline-block;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-report:hover {
    color: white;
    background: #047857;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
}

/* CARD STATISTIK */
.stat-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    transition: .3s;
    height: 100%;
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-card:hover {
    transform: translateY(-5px);
}

.icon-box {
    width: 55px;
    height: 55px;
    border-radius: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 22px;
}

.bg-purple {
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
}

.bg-blue {
    background: linear-gradient(135deg, #38bdf8, #2563eb);
}

.bg-green {
    background: linear-gradient(135deg, #34d399, #10b981);
}

.bg-orange {
    background: linear-gradient(135deg, #fbbf24, #f97316);
}

.stat-card h2 {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
    color: #111827;
}

.stat-card h4 {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    color: #111827;
}

.stat-card p {
    margin: 0;
    color: #6b7280;
    font-size: 13px;
}

/* CHART CARD */
.chart-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    height: 100%;
    border: 1px solid rgba(255,255,255,0.2);
}

.chart-card h5 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 15px;
    font-size: 16px;
}

.chart-container {
    position: relative;
    height: 230px;
}

.chart-container-pie {
    position: relative;
    height: 230px;
    max-width: 230px;
    margin: 0 auto;
}

/* TABLE CARD */
.table-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 1px solid rgba(255,255,255,0.2);
}

.table-card h5 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 15px;
    font-size: 16px;
}

.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table-custom th {
    background: rgba(243, 244, 246, 0.8);
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 12px;
}

.table-custom td {
    padding: 10px 12px;
    border-bottom: 1px solid rgba(229, 231, 235, 0.6);
    font-size: 13px;
}

.table-custom tr:hover {
    background: rgba(249, 250, 251, 0.5);
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

.btn-view-all {
    background: rgba(16, 185, 129, 0.8);
    color: white;
    padding: 5px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-view-all:hover {
    background: #059669;
    color: white;
}

@media (max-width: 768px) {
    .hero-overlay {
        padding: 20px;
    }
    .hero-overlay h1 {
        font-size: 28px;
    }
    .hero-overlay h4 {
        font-size: 18px;
    }
    .hero-overlay p {
        font-size: 14px;
    }
    .stat-card h2 {
        font-size: 24px;
    }
    .stat-card h4 {
        font-size: 18px;
    }
    .chart-container {
        height: 180px;
    }
    .chart-container-pie {
        height: 180px;
        max-width: 180px;
    }
}
</style>

@if(auth()->check() && auth()->user()->role == 'admin')

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero-card">
        <div class="hero-overlay">
            <h4>👋 Selamat Datang, {{ auth()->user()->name }}</h4>
            <h1>Dashboard Administrator</h1>
            <p>Kelola maskapai, penerbangan, pemesanan dan transaksi dengan mudah.</p>
            <a href="{{ route('laporan') }}" class="btn-report">📊 Lihat Laporan</a>
        </div>
    </div>

    <!-- STATISTIK -->
    @php
        try {
            $totalAirlines = \App\Models\Airline::count();
            $totalFlights = \App\Models\Flight::count();
            $totalBookings = \App\Models\Booking::count();
            $totalRevenue = \App\Models\Booking::sum('total_harga');
        } catch (\Exception $e) {
            $totalAirlines = 0;
            $totalFlights = 0;
            $totalBookings = 0;
            $totalRevenue = 0;
        }
    @endphp

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-box bg-purple">✈</div>
                    <div class="text-end">
                        <h2>{{ $totalAirlines }}</h2>
                        <p>Total Maskapai</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-box bg-blue">🛫</div>
                    <div class="text-end">
                        <h2>{{ $totalFlights }}</h2>
                        <p>Penerbangan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-box bg-green">🎫</div>
                    <div class="text-end">
                        <h2>{{ $totalBookings }}</h2>
                        <p>Pemesanan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="icon-box bg-orange">💰</div>
                    <div class="text-end">
                        <h4>Rp {{ number_format($totalRevenue,0,',','.') }}</h4>
                        <p>Total Transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK -->
    @php
        $months = [];
        $counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $months[] = $month->format('M Y');
            try {
                $count = \App\Models\Booking::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            } catch (\Exception $e) {
                $count = 0;
            }
            $counts[] = $count;
        }
        try {
            $pending = \App\Models\Booking::where('status', 'pending')->count();
            $confirmed = \App\Models\Booking::where('status', 'confirmed')->count();
            $completed = \App\Models\Booking::where('status', 'completed')->count();
            $cancelled = \App\Models\Booking::where('status', 'cancelled')->count();
        } catch (\Exception $e) {
            $pending = 0;
            $confirmed = 0;
            $completed = 0;
            $cancelled = 0;
        }
    @endphp

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="chart-card">
                <h5>📈 Pemesanan per Bulan</h5>
                <div class="chart-container">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="chart-card">
                <h5>📊 Status Pemesanan</h5>
                <div class="chart-container-pie">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL PEMESANAN TERBARU -->
    <div class="row">
        <div class="col-12">
            <div class="table-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>📋 Pemesanan Terbaru</h5>
                    <a href="#" class="btn-view-all">Lihat Semua</a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pemesan</th>
                                <th>Rute</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                try {
                                    $recentBookings = \App\Models\Booking::with(['flight', 'user'])
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get();
                                } catch (\Exception $e) {
                                    $recentBookings = collect();
                                }
                            @endphp
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td><strong>{{ $booking->kode_booking ?? 'N/A' }}</strong></td>
                                <td>{{ $booking->user->name ?? $booking->nama_pemesan ?? 'N/A' }}</td>
                                <td>
                                    {{ $booking->flight->kota_asal ?? 'N/A' }} 
                                    → {{ $booking->flight->kota_tujuan ?? 'N/A' }}
                                </td>
                                <td>{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:30px; color:#9ca3af;">
                                    Belum ada pemesanan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endif

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    var months = @json($months);
    var counts = @json($counts);
    
    if (months.length > 0 && counts.length > 0) {
        try {
            var ctx = document.getElementById('bookingChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: counts,
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.7)',
                            'rgba(139, 92, 246, 0.7)',
                            'rgba(56, 189, 248, 0.7)',
                            'rgba(52, 211, 153, 0.7)',
                            'rgba(251, 191, 36, 0.7)',
                            'rgba(251, 146, 60, 0.7)'
                        ],
                        borderColor: [
                            '#6366f1',
                            '#8b5cf6',
                            '#38bdf8',
                            '#34d399',
                            '#fbbf24',
                            '#fb923c'
                        ],
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        } catch(e) {
            console.log('Booking chart error:', e);
        }
    }
    
    var pending = {{ $pending }};
    var confirmed = {{ $confirmed }};
    var completed = {{ $completed }};
    var cancelled = {{ $cancelled }};
    var totalStatus = pending + confirmed + completed + cancelled;
    
    if (totalStatus > 0) {
        try {
            var statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Confirmed', 'Completed', 'Cancelled'],
                    datasets: [{
                        data: [pending, confirmed, completed, cancelled],
                        backgroundColor: [
                            '#fbbf24',
                            '#34d399',
                            '#60a5fa',
                            '#f87171'
                        ],
                        borderColor: 'white',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 10,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        } catch(e) {
            console.log('Status chart error:', e);
        }
    }
    
});
</script>

@endsection