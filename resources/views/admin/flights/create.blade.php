@extends('layouts.app')

@section('content')

<style>
body {
    background: #f8fafc;
}

.container {
    max-width: 500px;
    margin-top: 30px;
}

.card-form {
    background: white;
    border-radius: 16px;
    padding: 20px 24px 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.07);
}

.card-form h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 3px;
    font-size: 20px;
}

.card-form .subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 18px;
}

.form-group {
    margin-bottom: 14px;
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

.form-group input::placeholder {
    color: #9ca3af;
    font-size: 12px;
}

.form-group select {
    appearance: auto;
    cursor: pointer;
}

.form-group .help-text {
    color: #6b7280;
    font-size: 11px;
    margin-top: 3px;
    display: block;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 8px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
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
    padding: 8px 18px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #fee2e2;
    color: #dc2626;
}

.btn-group {
    display: flex;
    gap: 8px;
    margin-top: 6px;
    flex-wrap: wrap;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    padding: 8px 14px;
    border-radius: 8px;
    margin-bottom: 14px;
    border-left: 3px solid #10b981;
    font-size: 13px;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 8px 14px;
    border-radius: 8px;
    margin-bottom: 14px;
    border-left: 3px solid #ef4444;
    font-size: 13px;
}

.alert-error ul {
    margin: 4px 0 0;
    padding-left: 16px;
}

.form-icon {
    color: #10b981;
    margin-right: 4px;
}

@media (max-width: 576px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .card-form { padding: 16px; }
    .card-form h3 { font-size: 18px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .btn-group { flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
}
</style>

<div class="container">
    <div class="card-form">
        <h3>🛫 Tambah Penerbangan</h3>
        <p class="subtitle">Masukkan data penerbangan baru</p>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <strong>❌ Terjadi kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('flights.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="airline_id"><i class="fas fa-building form-icon"></i> Maskapai <span class="required">*</span></label>
                <select name="airline_id" id="airline_id" required>
                    <option value="">-- Pilih Maskapai --</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id }}" {{ old('airline_id') == $airline->id ? 'selected' : '' }}>
                            {{ $airline->kode }} - {{ $airline->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kode_penerbangan"><i class="fas fa-tag form-icon"></i> Kode Penerbangan <span class="required">*</span></label>
                <input type="text" name="kode_penerbangan" id="kode_penerbangan" placeholder="Contoh: GA-101" value="{{ old('kode_penerbangan') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kota_asal"><i class="fas fa-map-marker-alt form-icon"></i> Kota Asal <span class="required">*</span></label>
                    <input type="text" name="kota_asal" id="kota_asal" placeholder="Jakarta (CGK)" value="{{ old('kota_asal') }}" required>
                </div>
                <div class="form-group">
                    <label for="kota_tujuan"><i class="fas fa-flag-checkered form-icon"></i> Kota Tujuan <span class="required">*</span></label>
                    <input type="text" name="kota_tujuan" id="kota_tujuan" placeholder="Bali (DPS)" value="{{ old('kota_tujuan') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal_berangkat"><i class="fas fa-calendar form-icon"></i> Tanggal Berangkat <span class="required">*</span></label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                </div>
                <div class="form-group">
                    <label for="kuota"><i class="fas fa-chair form-icon"></i> Kuota Kursi <span class="required">*</span></label>
                    <input type="number" name="kuota" id="kuota" placeholder="100" value="{{ old('kuota', 100) }}" required min="1">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jam_berangkat"><i class="fas fa-clock form-icon"></i> Jam Berangkat <span class="required">*</span></label>
                    <input type="time" name="jam_berangkat" id="jam_berangkat" value="{{ old('jam_berangkat') }}" required>
                </div>
                <div class="form-group">
                    <label for="jam_tiba"><i class="fas fa-clock form-icon"></i> Jam Tiba <span class="required">*</span></label>
                    <input type="time" name="jam_tiba" id="jam_tiba" value="{{ old('jam_tiba') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="harga"><i class="fas fa-money-bill-wave form-icon"></i> Harga Tiket <span class="required">*</span></label>
                <input type="number" name="harga" id="harga" placeholder="1500000" value="{{ old('harga') }}" required min="0">
                <span class="help-text">Masukkan dalam Rupiah (tanpa titik)</span>
            </div>

            <div class="form-group">
                <label for="status"><i class="fas fa-circle form-icon"></i> Status Penerbangan</label>
                <select name="status" id="status">
                    <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="delayed" {{ old('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Penerbangan</button>
                <a href="{{ route('flights.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection