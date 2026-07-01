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

.container {
    position: relative;
    z-index: 1;
    max-width: 1100px;
    margin-top: 25px;
}

/* ===== HERO CARD ===== */
.hero-card {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 20px;
    overflow: hidden;
    min-height: 150px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.12);
}

.hero-overlay {
    padding: 25px 35px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 15px;
}

.hero-content h1 {
    font-size: 24px;
    font-weight: 800;
    color: white;
    margin-bottom: 2px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-content h1 span {
    color: #34d399;
}

.hero-content .subtitle {
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    margin: 0;
}

.hero-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-hero-primary {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 10px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-hero-primary:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
}

.btn-hero-secondary {
    background: rgba(255,255,255,0.12);
    color: white;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    border: 1.5px solid rgba(255,255,255,0.2);
}

.btn-hero-secondary:hover {
    color: white;
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.4);
    transform: translateY(-2px);
}

.btn-hero-danger {
    background: rgba(239, 68, 68, 0.2);
    color: #fca5a5;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    border: 1.5px solid rgba(239, 68, 68, 0.25);
}

.btn-hero-danger:hover {
    color: white;
    background: rgba(239, 68, 68, 0.35);
    border-color: rgba(239, 68, 68, 0.5);
    transform: translateY(-2px);
}

/* ===== QUICK STATS ===== */
.quick-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.stat-item {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 14px;
    padding: 16px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(16, 185, 129, 0.2);
    border-color: #10b981;
    background: rgba(255, 255, 255, 0.98);
}

.stat-item .icon {
    font-size: 22px;
    margin-bottom: 3px;
}

.stat-item .number {
    font-size: 22px;
    font-weight: 700;
    color: #111827;
}

.stat-item .label {
    font-size: 12px;
    color: #6b7280;
    font-weight: 500;
}

/* ===== NOTIFICATION ===== */
.card-notification {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px 24px 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    margin-bottom: 25px;
}

.card-notification h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 18px;
}

.card-notification .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 16px;
}

.notification-item {
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 8px;
    border-left: 4px solid #10b981;
    background: #f8fafc;
    transition: all 0.3s ease;
}

.notification-item:hover {
    background: #f1f5f9;
}

.notification-item.unread {
    background: #eff6ff;
    border-left-color: #3b82f6;
}

.notification-item .notif-title {
    font-weight: 600;
    color: #111827;
    font-size: 14px;
}

.notification-item .notif-message {
    color: #6b7280;
    font-size: 13px;
    margin: 2px 0;
}

.notification-item .notif-time {
    color: #9ca3af;
    font-size: 11px;
}

.notif-badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
}

.notif-badge-success {
    background: #d1fae5;
    color: #065f46;
}

.notif-badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.notif-badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.notif-badge-info {
    background: #dbeafe;
    color: #1e40af;
}

.btn-mark-read {
    background: none;
    border: none;
    color: #6366f1;
    font-size: 12px;
    cursor: pointer;
    text-decoration: underline;
}

.btn-mark-read:hover {
    color: #4f46e5;
}

.btn-mark-all {
    background: #6366f1;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-mark-all:hover {
    background: #4f46e5;
}

/* ===== RECENT BOOKINGS ===== */
.card-table {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 20px 24px 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    border: 1px solid rgba(255,255,255,0.2);
}

.card-table h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 18px;
}

.card-table .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 16px;
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
    background: rgba(243, 244, 246, 0.8);
    color: #6b7280;
    padding: 5px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-view-all:hover {
    background: #e5e7eb;
    color: #111827;
}

.total-data {
    color: #6b7280;
    font-size: 13px;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid rgba(229, 231, 235, 0.6);
}

@media (max-width: 768px) {
    .hero-overlay {
        padding: 20px;
        flex-direction: column;
        text-align: center;
    }
    .hero-content h1 {
        font-size: 20px;
    }
    .hero-actions {
        justify-content: center;
        width: 100%;
    }
    .quick-stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .stat-item {
        padding: 12px 14px;
    }
    .stat-item .number {
        font-size: 18px;
    }
    .card-table {
        padding: 16px;
    }
    .card-table h3 {
        font-size: 16px;
    }
    .table-custom th,
    .table-custom td {
        padding: 6px 8px;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .quick-stats {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
}
</style>

<div class="container">

    <!-- HERO -->
    <div class="hero-card">
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>✈️ Selamat Datang, <span>{{ auth()->user()->name }}</span>!</h1>
                <p class="subtitle">🛫 Sistem Pemesanan Tiket Pesawat Online</p>
            </div>
            <div class="hero-actions">
                <a href="{{ route('jadwal') }}" class="btn-hero-primary">
                    <i class="fas fa-plane"></i> Lihat Jadwal
                </a>
                <a href="{{ route('booking.history') }}" class="btn-hero-secondary">
                    <i class="fas fa-history"></i> Riwayat
                </a>
                <a href="#" class="btn-hero-danger" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- QUICK STATS -->
    @php
        try {
            $totalBookings = \App\Models\Booking::where('user_id', auth()->id())->count();
            $totalConfirmed = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'confirmed')->count();
            $totalPending = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'pending')->count();
            $totalCompleted = \App\Models\Booking::where('user_id', auth()->id())->where('status', 'completed')->count();
        } catch (\Exception $e) {
            $totalBookings = 0;
            $totalConfirmed = 0;
            $totalPending = 0;
            $totalCompleted = 0;
        }
    @endphp

    <div class="quick-stats">
        <div class="stat-item">
            <div class="icon">📋</div>
            <div class="number">{{ $totalBookings }}</div>
            <div class="label">Total Booking</div>
        </div>
        <div class="stat-item">
            <div class="icon">✅</div>
            <div class="number">{{ $totalConfirmed }}</div>
            <div class="label">Dikonfirmasi</div>
        </div>
        <div class="stat-item">
            <div class="icon">⏳</div>
            <div class="number">{{ $totalPending }}</div>
            <div class="label">Menunggu</div>
        </div>
        <div class="stat-item">
            <div class="icon">🎫</div>
            <div class="number">{{ $totalCompleted }}</div>
            <div class="label">Selesai</div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- NOTIFICATION - MENGGUNAKAN MODEL CUSTOM -->
    <!-- ============================================================ -->
    @php
        use App\Models\Notification;
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $unreadCount = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
    @endphp

    <div class="card-notification">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>🔔 Notifikasi</h3>
                <p class="subtitle">
                    @if($unreadCount > 0)
                        Anda memiliki <strong>{{ $unreadCount }}</strong> notifikasi belum dibaca
                    @else
                        Semua notifikasi sudah dibaca ✅
                    @endif
                </p>
            </div>
            @if($unreadCount > 0)
                <form action="{{ route('notification.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-mark-all">
                        <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        <div>
            @forelse($notifications as $notif)
                <div class="notification-item {{ $notif->is_read ? '' : 'unread' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div style="flex:1;">
                            <div class="notif-title">
                                {{ $notif->title }}
                                @if(!$notif->is_read)
                                    <span style="background: #3b82f6; color: white; font-size: 9px; padding: 2px 8px; border-radius: 20px; margin-left: 6px;">BARU</span>
                                @endif
                            </div>
                            <div class="notif-message">{{ $notif->message }}</div>
                            <div class="notif-time">
                                <span class="notif-badge notif-badge-{{ $notif->type }}">
                                    {{ ucfirst($notif->type) }}
                                </span>
                                {{ $notif->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @if(!$notif->is_read)
                            <div style="margin-left:10px;">
                                <form action="{{ route('notification.markRead', $notif->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-mark-read">Tandai Dibaca</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 20px; color: #9ca3af;">
                    <p style="font-size: 16px;">📭 Belum ada notifikasi</p>
                    <p style="font-size: 13px;">Notifikasi akan muncul ketika ada perubahan status penerbangan</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- RECENT BOOKINGS -->
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>📋 Booking Terbaru</h3>
                <p class="subtitle">5 pemesanan terakhir Anda</p>
            </div>
            <a href="{{ route('booking.history') }}" class="btn-view-all">
                Lihat Semua →
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Rute</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        try {
                            $recentBookings = \App\Models\Booking::with(['flight'])
                                ->where('user_id', auth()->id())
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 25px; color: #9ca3af;">
                            <h4 style="font-size: 15px;">Belum ada pemesanan</h4>
                            <p style="font-size: 12px;">Mulai pesan tiket sekarang!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-data">
            Total: {{ $recentBookings->count() }} pemesanan terbaru
        </div>
    </div>

</div>

@endsection