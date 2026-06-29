@extends('layouts.app')

@section('content')

<style>
body {
    background: #f8fafc;
}

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
    font-size: 12px;
}

.table-custom th {
    background: #f3f4f6;
    padding: 8px 10px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 11px;
    white-space: nowrap;
}

.table-custom td {
    padding: 8px 10px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 12px;
}

.table-custom tr:hover {
    background: #f9fafb;
}

.btn-add {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.btn-add:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
}

.btn-edit {
    background: #f59e0b;
    color: white;
    padding: 3px 8px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 10px;
    display: inline-block;
    transition: 0.3s;
}

.btn-edit:hover {
    background: #d97706;
    color: white;
}

.btn-delete {
    background: #ef4444;
    color: white;
    padding: 3px 8px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 10px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn-delete:hover {
    background: #dc2626;
    color: white;
}

.badge-status {
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 9px;
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

.badge-completed {
    background: #d1fae5;
    color: #065f46;
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

.table-responsive {
    overflow-x: auto;
}

@media (max-width: 768px) {
    .container { max-width: 100%; padding: 0 14px; margin-top: 16px; }
    .card-table { padding: 16px; }
    .table-custom th, .table-custom td { padding: 5px 6px; font-size: 10px; }
    .btn-add { padding: 5px 12px; font-size: 12px; }
}
</style>

<div class="container">
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>🛫 Daftar Penerbangan</h3>
                <p class="subtitle">Kelola data penerbangan</p>
            </div>
            <a href="{{ route('flights.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Penerbangan
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="table-responsive">
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
                                    'completed' => 'badge-completed'
                                ][$flight->status] ?? 'badge-scheduled';
                            @endphp
                            <span class="badge-status {{ $statusClass }}">
                                {{ ucfirst($flight->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('flights.edit', $flight->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 30px; color: #9ca3af;">
                            <h4 style="font-size: 16px;">Belum ada penerbangan</h4>
                            <p style="font-size: 13px;">Klik "Tambah Penerbangan" untuk menambahkan data pertama</p>
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