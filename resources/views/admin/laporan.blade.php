@extends('layouts.app')

@section('content')

<style>
body {
    background: #f8fafc;
}

.container {
    max-width: 1200px;
}

/* CARD LAPORAN */
.card-laporan {
    background: white;
    border-radius: 16px;
    padding: 22px 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,.10);
    margin-bottom: 25px;
}

.card-laporan h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 15px;
    font-size: 18px;
}

/* STAT BOX */
.stat-box {
    padding: 18px;
    border-radius: 14px;
    text-align: center;
    color: white;
}

.stat-box h2 {
    font-size: 28px;
    font-weight: 700;
    margin: 0;
}

.stat-box p {
    margin: 4px 0 0 0;
    opacity: 0.9;
    font-size: 13px;
}

.bg-purple-stat {
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
}

.bg-green-stat {
    background: linear-gradient(135deg, #10b981, #34d399);
}

.bg-yellow-stat {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
}

.bg-blue-stat {
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
}

/* BUTTON */
.btn-back {
    background: #6b7280;
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-block;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #4b5563;
    color: white;
}

/* TABEL */
.table-laporan {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.table-laporan th {
    background: #f3f4f6;
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 12px;
}

.table-laporan td {
    padding: 10px 12px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
}

.table-laporan tr:hover {
    background: #f9fafb;
}

.table-responsive {
    overflow-x: auto;
}

/* BADGE */
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

.badge-warning {
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

/* CHART */
.chart-container {
    position: relative;
    height: 250px;
}

.chart-container-pie {
    position: relative;
    height: 250px;
    max-width: 250px;
    margin: 0 auto;
}

/* TITLE */
.page-title {
    font-weight: 700;
    color: #111827;
    font-size: 24px;
}

.total-data {
    color: #6b7280;
    font-size: 13px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}

@media (max-width: 768px) {
    .card-laporan {
        padding: 18px;
    }
    .stat-box h2 {
        font-size: 20px;
    }
    .chart-container {
        height: 180px;
    }
    .chart-container-pie {
        height: 180px;
        max-width: 180px;
    }
    .table-laporan th,
    .table-laporan td {
        padding: 6px 8px;
        font-size: 11px;
    }
}
</style>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">📊 Laporan</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
    </div>

    <!-- STATISTIK -->
    @php
        try {
            $totalBookings = \App\Models\Booking::count();
            $totalRevenue = \App\Models\Booking::sum('total_harga');
            $totalAirlines = \App\Models\Airline::count();
            $totalFlights = \App\Models\Flight::count();
        } catch (\Exception $e) {
            $totalBookings = 0;
            $totalRevenue = 0;
            $totalAirlines = 0;
            $totalFlights = 0;
        }
    @endphp

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-box bg-purple-stat">
                <h2>{{ $totalBookings }}</h2>
                <p>Total Pemesanan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-green-stat">
                <h2>Rp {{ number_format($totalRevenue,0,',','.') }}</h2>
                <p>Total Pendapatan</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-yellow-stat">
                <h2>{{ $totalAirlines }}</h2>
                <p>Total Maskapai</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box bg-blue-stat">
                <h2>{{ $totalFlights }}</h2>
                <p>Total Penerbangan</p>
            </div>
        </div>
    </div>

    <!-- GRAFIK -->
    @php
        // Data untuk grafik pemesanan per bulan
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
            <div class="card-laporan">
                <h3>📈 Pemesanan per Bulan</h3>
                <div class="chart-container">
                    <canvas id="laporanChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-laporan">
                <h3>📊 Status Pemesanan</h3>
                <div class="chart-container-pie">
                    <canvas id="laporanStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL PEMESANAN -->
    <div class="card-laporan">
        <h3>📋 Daftar Pemesanan</h3>
        
        <div class="table-responsive">
            <table class="table-laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Nama Pemesan</th>
                        <th>Maskapai</th>
                        <th>Rute</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = 1; 
                        try {
                            $bookings = \App\Models\Booking::with(['flight.airline', 'user'])
                                ->orderBy('created_at', 'desc')
                                ->get();
                        } catch (\Exception $e) {
                            $bookings = collect();
                        }
                    @endphp
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><strong>{{ $booking->kode_booking ?? 'N/A' }}</strong></td>
                        <td>{{ $booking->user->name ?? $booking->nama_pemesan ?? 'N/A' }}</td>
                        <td>{{ $booking->flight->airline->nama ?? $booking->flight->airline->kode ?? 'N/A' }}</td>
                        <td>
                            {{ $booking->flight->kota_asal ?? 'N/A' }} 
                            → {{ $booking->flight->kota_tujuan ?? 'N/A' }}
                        </td>
                        <td><strong>Rp {{ number_format($booking->total_harga ?? 0,0,',','.') }}</strong></td>
                        <td>
                            @php
                                $status = $booking->status ?? 'pending';
                                $badgeClass = [
                                    'pending' => 'badge-warning',
                                    'confirmed' => 'badge-success',
                                    'cancelled' => 'badge-danger',
                                    'completed' => 'badge-info'
                                ][$status] ?? 'badge-warning';
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #9ca3af;">
                            <h4 style="font-size: 18px;">Belum ada pemesanan</h4>
                            <p style="font-size: 14px;">Data pemesanan akan muncul di sini</p>
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

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Grafik Pemesanan per Bulan
    var months = @json($months);
    var counts = @json($counts);
    
    if (months.length > 0 && counts.length > 0) {
        try {
            var ctx = document.getElementById('laporanChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: counts,
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        borderColor: '#6366f1',
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
            console.log('Laporan chart error:', e);
        }
    }
    
    // Grafik Status
    var pending = {{ $pending }};
    var confirmed = {{ $confirmed }};
    var completed = {{ $completed }};
    var cancelled = {{ $cancelled }};
    var totalStatus = pending + confirmed + completed + cancelled;
    
    if (totalStatus > 0) {
        try {
            var statusCtx = document.getElementById('laporanStatusChart').getContext('2d');
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
                                padding: 12,
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