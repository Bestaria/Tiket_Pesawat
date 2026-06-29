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
    padding: 4px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 11px;
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
    padding: 4px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 11px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn-delete:hover {
    background: #dc2626;
    color: white;
}

.badge-kode {
    background: #e0e7ff;
    color: #4338ca;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 11px;
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
    gap: 5px;
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

@media (max-width: 768px) {
    .container { max-width: 100%; padding: 0 14px; margin-top: 16px; }
    .card-table { padding: 16px; }
    .table-custom th, .table-custom td { padding: 6px 8px; font-size: 11px; }
    .btn-add { padding: 5px 12px; font-size: 12px; }
}
</style>

<div class="container">
    <div class="card-table">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3>✈️ Daftar Maskapai</h3>
                <p class="subtitle">Kelola data maskapai penerbangan</p>
            </div>
            <a href="{{ route('airlines.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Maskapai
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div style="overflow-x: auto;">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Maskapai</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($airlines as $airline)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><span class="badge-kode">{{ $airline->kode }}</span></td>
                        <td><strong>{{ $airline->nama }}</strong></td>
                        <td>{{ $airline->deskripsi ?? '-' }}</td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('airlines.edit', $airline->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('airlines.destroy', $airline->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px; color: #9ca3af;">
                            <h4 style="font-size: 16px;">Belum ada maskapai</h4>
                            <p style="font-size: 13px;">Klik "Tambah Maskapai" untuk menambahkan data pertama</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="total-data">
            Total: {{ $airlines->count() }} maskapai
        </div>
    </div>
</div>

@endsection