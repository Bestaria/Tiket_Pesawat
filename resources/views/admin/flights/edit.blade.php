@extends('layouts.app')

@section('content')

<style>
body { background: #f8fafc; }

.container {
    max-width: 700px;
    margin-top: 30px;
}

.card-form {
    background: white;
    border-radius: 20px;
    padding: 25px 30px 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,.12);
}

.card-form h3 {
    font-weight: 700;
    color: #111827;
    margin-bottom: 4px;
    font-size: 24px;
}

.card-form .subtitle {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 22px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

.form-group label .required {
    color: #ef4444;
    margin-left: 2px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #10b981;
    outline: none;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.12);
    background: white;
}

.form-group input::placeholder {
    color: #9ca3af;
    font-size: 13px;
}

.form-group select {
    appearance: auto;
    cursor: pointer;
}

.form-group .help-text {
    color: #6b7280;
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.btn-submit {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.35);
}

.btn-cancel {
    background: #f3f4f6;
    color: #6b7280;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
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
    gap: 12px;
    margin-top: 10px;
    flex-wrap: wrap;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 12px 18px;
    border-radius: 10px;
    margin-bottom: 18px;
    border-left: 4px solid #ef4444;
    font-size: 14px;
}

.alert-error ul {
    margin: 5px 0 0 0;
    padding-left: 18px;
}

.form-icon {
    color: #10b981;
    margin-right: 6px;
}

@media (max-width: 576px) {
    .container { padding: 0 16px; margin-top: 16px; }
    .card-form { padding: 20px 18px 25px; }
    .card-form h3 { font-size: 20px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .btn-group { flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
}
</style>

<div class="container">
    <div class="card-form">
        <h3>✏️ Edit Penerbangan</h3>
        <p class="subtitle">Perbarui data penerbangan</p>

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

        <form action="{{ route('flights.update', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="airline_id"><i class="fas fa-building form-icon"></i> Maskapai <span class="required">*</span></label>
                <select name="airline_id" id="airline_id" required>
                    <option value="">-- Pilih Maskapai --</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id }}" {{ old('airline_id', $flight->airline_id) == $airline->id ? 'selected' : '' }}>
                            {{ $airline->kode }} - {{ $airline->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kode_penerbangan"><i class="fas fa-tag form-icon"></i> Kode Penerbangan <span class="required">*</span></label>
                <input type="text" name="kode_penerbangan" id="kode_penerbangan" 
                       placeholder="Contoh: GA-101" 
                       value="{{ old('kode_penerbangan', $flight->kode_penerbangan) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kota_asal"><i class="fas fa-map-marker-alt form-icon"></i> Kota Asal <span class="required">*</span></label>
                    <input type="text" name="kota_asal" id="kota_asal" 
                           placeholder="Jakarta (CGK)" 
                           value="{{ old('kota_asal', $flight->kota_asal) }}" required>
                </div>
                <div class="form-group">
                    <label for="kota_tujuan"><i class="fas fa-flag-checkered form-icon"></i> Kota Tujuan <span class="required">*</span></label>
                    <input type="text" name="kota_tujuan" id="kota_tujuan" 
                           placeholder="Bali (DPS)" 
                           value="{{ old('kota_tujuan', $flight->kota_tujuan) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal_berangkat"><i class="fas fa-calendar form-icon"></i> Tanggal Berangkat <span class="required">*</span></label>
                    <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" 
                           value="{{ old('tanggal_berangkat', $flight->tanggal_berangkat) }}" required>
                </div>
                <div class="form-group">
                    <label for="kuota"><i class="fas fa-chair form-icon"></i> Kuota Kursi <span class="required">*</span></label>
                    <input type="number" name="kuota" id="kuota" 
                           placeholder="100" 
                           value="{{ old('kuota', $flight->kuota) }}" required min="1">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jam_berangkat"><i class="fas fa-clock form-icon"></i> Jam Berangkat <span class="required">*</span></label>
                    <input type="time" name="jam_berangkat" id="jam_berangkat" 
                           value="{{ old('jam_berangkat', $flight->jam_berangkat) }}" required>
                </div>
                <div class="form-group">
                    <label for="jam_tiba"><i class="fas fa-clock form-icon"></i> Jam Tiba <span class="required">*</span></label>
                    <input type="time" name="jam_tiba" id="jam_tiba" 
                           value="{{ old('jam_tiba', $flight->jam_tiba) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="harga"><i class="fas fa-money-bill-wave form-icon"></i> Harga Tiket <span class="required">*</span></label>
                <input type="number" name="harga" id="harga" 
                       placeholder="1500000" 
                       value="{{ old('harga', $flight->harga) }}" required min="0">
                <span class="help-text">Masukkan dalam Rupiah (tanpa titik)</span>
            </div>

            <div class="form-group">
                <label for="status"><i class="fas fa-circle form-icon"></i> Status Penerbangan</label>
                <select name="status" id="status">
                    <option value="scheduled" {{ old('status', $flight->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="delayed" {{ old('status', $flight->status) == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    <option value="cancelled" {{ old('status', $flight->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ old('status', $flight->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Update Penerbangan</button>
                <a href="{{ route('flights.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection