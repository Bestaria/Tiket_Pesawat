@extends('layouts.app')

@section('content')

<style>
body { background: #f8fafc; }

.container {
    max-width: 600px;
    margin-top: 25px;
}

.card-form {
    background: white;
    border-radius: 16px;
    padding: 22px 26px 26px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
}

.card-form h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 22px;
}

.card-form .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 18px;
}

.flight-info {
    background: #f3f4f6;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 18px;
    font-size: 14px;
}

.flight-info strong {
    color: #111827;
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    display: block;
    margin-bottom: 4px;
    font-size: 13px;
}

.form-group label .required {
    color: #ef4444;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 13px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #10b981;
    outline: none;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    background: white;
}

.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3);
}

.btn-cancel {
    background: #f3f4f6;
    color: #6b7280;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #fee2e2;
    color: #dc2626;
}

.btn-group {
    display: flex;
    gap: 10px;
    margin-top: 6px;
    flex-wrap: wrap;
}

@media (max-width: 576px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .card-form { padding: 16px; }
    .card-form h3 { font-size: 18px; }
    .btn-group { flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
}
</style>

<div class="container">
    <div class="card-form">
        <h3>🎫 Booking Tiket</h3>
        <p class="subtitle">Konfirmasi pemesanan tiket penerbangan</p>

        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 10px 16px; border-radius: 8px; margin-bottom: 16px; border-left: 3px solid #ef4444; font-size: 13px;">
                <strong>❌ Terjadi kesalahan:</strong>
                <ul style="margin: 4px 0 0; padding-left: 16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flight-info">
            <div><strong>Kode Penerbangan:</strong> {{ $flight->kode_penerbangan }}</div>
            <div><strong>Maskapai:</strong> {{ $flight->airline->nama ?? '-' }}</div>
            <div><strong>Rute:</strong> {{ $flight->kota_asal }} → {{ $flight->kota_tujuan }}</div>
            <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d/m/Y') }}</div>
            <div><strong>Jam:</strong> {{ \Carbon\Carbon::parse($flight->jam_berangkat)->format('H:i') }} - {{ \Carbon\Carbon::parse($flight->jam_tiba)->format('H:i') }}</div>
            <div><strong>Harga:</strong> Rp {{ number_format($flight->harga,0,',','.') }}</div>
            <div><strong>Sisa Kursi:</strong> {{ $flight->sisa_kuota ?? $flight->kuota }}</div>
        </div>

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            <div class="form-group">
                <label for="jumlah_penumpang">Jumlah Penumpang <span class="required">*</span></label>
                <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" 
                       placeholder="Masukkan jumlah penumpang" 
                       value="{{ old('jumlah_penumpang', 1) }}" required min="1" 
                       max="{{ $flight->sisa_kuota ?? $flight->kuota }}">
                <span style="color: #6b7280; font-size: 11px; margin-top: 3px; display: block;">
                    Maksimal {{ $flight->sisa_kuota ?? $flight->kuota }} kursi tersedia
                </span>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i> Konfirmasi Booking
                </button>
                <a href="{{ route('jadwal') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection