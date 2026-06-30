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
.form-group textarea {
    width: 100%;
    padding: 8px 12px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 13px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #10b981;
    outline: none;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    background: white;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: #9ca3af;
    font-size: 12px;
}

.form-group textarea {
    resize: vertical;
    min-height: 60px;
}

.form-group .help-text {
    color: #6b7280;
    font-size: 11px;
    margin-top: 3px;
    display: block;
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
    .btn-group { flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
}
</style>

<div class="container">
    <div class="card-form">
        <h3>✈️ Edit Maskapai</h3>
        <p class="subtitle">Perbarui data maskapai penerbangan</p>

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

        <form action="{{ route('airlines.update', $airline->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama"><i class="fas fa-building form-icon"></i> Nama Maskapai <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" placeholder="Contoh: Garuda Indonesia" value="{{ old('nama', $airline->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="kode"><i class="fas fa-tag form-icon"></i> Kode Maskapai <span class="required">*</span></label>
                <input type="text" name="kode" id="kode" placeholder="Contoh: GA" value="{{ old('kode', $airline->kode) }}" required maxlength="5">
                <span class="help-text">Maksimal 5 karakter</span>
            </div>

            <div class="form-group">
                <label for="deskripsi"><i class="fas fa-align-left form-icon"></i> Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="2" placeholder="Masukkan deskripsi maskapai">{{ old('deskripsi', $airline->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="logo"><i class="fas fa-image form-icon"></i> Logo URL (Opsional)</label>
                <input type="text" name="logo" id="logo" placeholder="https://example.com/logo.png" value="{{ old('logo', $airline->logo) }}">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Update Maskapai</button>
                <a href="{{ route('airlines.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection