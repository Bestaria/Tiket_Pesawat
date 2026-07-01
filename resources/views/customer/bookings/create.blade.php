@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #f0f2f5 0%, #e8ecf1 100%);
    min-height: 100vh;
}

.container {
    max-width: 1100px;
    margin-top: 25px;
}

/* ===== CARD ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    background: white;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 18px 24px;
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

/* ===== SEAT GRID ===== */
.seat-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
    max-width: 420px;
    margin: 0 auto;
}

.seat-label {
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    padding: 10px 4px !important;
    font-size: 12px;
    font-weight: 700;
    border-radius: 8px !important;
    border: 2px solid #e5e7eb !important;
    background: white !important;
    color: #374151 !important;
    display: block;
    user-select: none;
}

.seat-label:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.seat-checkbox:checked + .seat-label {
    background: #10b981 !important;
    color: white !important;
    border-color: #10b981 !important;
    transform: scale(1.05);
}

.seat-label.business {
    border-color: #f59e0b !important;
    background: #fffbeb !important;
}

.seat-checkbox:checked + .seat-label.business {
    background: #f59e0b !important;
    color: white !important;
    border-color: #f59e0b !important;
}

.seat-label.economy {
    border-color: #3b82f6 !important;
    background: #eff6ff !important;
}

.seat-checkbox:checked + .seat-label.economy {
    background: #3b82f6 !important;
    color: white !important;
    border-color: #3b82f6 !important;
}

.seat-label.unavailable {
    background: #f3f4f6 !important;
    color: #9ca3af !important;
    border-color: #e5e7eb !important;
    cursor: not-allowed;
    opacity: 0.5;
}

/* ===== CLASS LEGEND ===== */
.class-legend {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 12px;
}

.class-legend .legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
}

.class-legend .legend-item .color-box {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    border: 2px solid #e5e7eb;
}

.class-legend .legend-item .color-box.business {
    background: #f59e0b;
    border-color: #f59e0b;
}

.class-legend .legend-item .color-box.economy {
    background: #3b82f6;
    border-color: #3b82f6;
}

.class-legend .legend-item .color-box.selected {
    background: #10b981;
    border-color: #10b981;
}

.class-legend .legend-item .color-box.unavailable {
    background: #f3f4f6;
    border-color: #e5e7eb;
}

/* ===== SEAT INFO STATS ===== */
.seat-stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}

.seat-stats .stat-item {
    font-size: 13px;
    font-weight: 600;
}

.seat-stats .stat-item .badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
}

/* ===== SUMMARY ===== */
.summary-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 20px;
}

.summary-card .summary-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
}

.summary-card .summary-row .label {
    color: #6b7280;
}

.summary-card .summary-row .value {
    font-weight: 600;
    color: #111827;
}

.summary-card .summary-row.total {
    border-top: 2px solid #e5e7eb;
    margin-top: 8px;
    padding-top: 12px;
    font-size: 18px;
}

.summary-card .summary-row.total .value {
    color: #667eea;
}

/* ===== FORM ===== */
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
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
}

/* ===== BUTTON ===== */
.btn-submit {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    justify-content: center;
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

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .container { padding: 0 14px; }
}

@media (max-width: 768px) {
    .container { padding: 0 14px; margin-top: 16px; }
    .card-body { padding: 16px; }
    .flight-info .route { font-size: 14px; }
    .flight-info .route i { margin: 0 5px; }
    .seat-grid { grid-template-columns: repeat(4, 1fr); max-width: 100%; }
}

@media (max-width: 480px) {
    .seat-grid { grid-template-columns: repeat(3, 1fr); }
    .class-legend { gap: 10px; }
    .class-legend .legend-item { font-size: 10px; }
}
</style>

<div class="container">
    <div class="row">
        <!-- FORM PEMESANAN -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-ticket-alt"></i> Pemesanan Tiket</h4>
                </div>
                <div class="card-body">

                    <!-- INFO PENERBANGAN -->
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

                    <!-- STATS KURSI -->
                    <div class="seat-stats">
                        <span class="stat-item">
                            <span class="badge bg-success">🟩 Tersedia: {{ $totalAvailable ?? $flight->sisa_kuota ?? $flight->kuota }}</span>
                        </span>
                        <span class="stat-item">
                            <span class="badge bg-danger">🟥 Terisi: {{ ($totalSeats ?? $flight->kuota) - ($totalAvailable ?? $flight->sisa_kuota ?? $flight->kuota) }}</span>
                        </span>
                    </div>

                    <!-- LEGEND -->
                    <div class="class-legend">
                        <span class="legend-item">
                            <span class="color-box business"></span> Business
                        </span>
                        <span class="legend-item">
                            <span class="color-box economy"></span> Economy
                        </span>
                        <span class="legend-item">
                            <span class="color-box selected"></span> Dipilih
                        </span>
                        <span class="legend-item">
                            <span class="color-box unavailable"></span> Tidak Tersedia
                        </span>
                    </div>

                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">

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

                        <!-- PILIH KURSI -->
                        <div class="form-group">
                            <label>Pilih Kursi <span class="required">*</span></label>
                            <p style="color: #6b7280; font-size: 12px; margin-bottom: 10px;">💡 Klik kursi untuk memilih. Maksimal 6 kursi.</p>
                            <div class="seat-grid">
                                @php
                                    // Ambil kursi yang tersedia
                                    $availableSeats = $flight->seats()->where('is_available', true)->orderBy('seat_number')->get();
                                    $seatsByClass = $availableSeats->groupBy('class');
                                @endphp
                                @foreach($seatsByClass as $class => $seats)
                                    @foreach($seats as $seat)
                                        <div>
                                            <input type="checkbox" 
                                                   name="seat_ids[]" 
                                                   value="{{ $seat->id }}" 
                                                   id="seat_{{ $seat->id }}"
                                                   class="seat-checkbox d-none"
                                                   data-seat="{{ $seat->seat_number }}"
                                                   data-class="{{ $class }}">
                                            <label for="seat_{{ $seat->id }}" 
                                                   class="seat-label {{ $class }} w-100">
                                                {{ $seat->seat_number }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            @if($availableSeats->count() == 0)
                                <p style="color: #ef4444; text-align: center; margin-top: 10px;">
                                    <i class="fas fa-exclamation-circle"></i> Maaf, semua kursi sudah terisi!
                                </p>
                            @endif
                        </div>

                        <!-- JUMLAH PENUMPANG -->
                        <div class="form-group">
                            <label for="jumlah_penumpang">Jumlah Penumpang <span class="required">*</span></label>
                            <input type="number" 
                                   name="jumlah_penumpang" 
                                   id="jumlah_penumpang" 
                                   class="form-control" 
                                   min="1" 
                                   max="6" 
                                   value="1" 
                                   required>
                            <span style="color: #6b7280; font-size: 11px; margin-top: 3px; display: block;">
                                Maksimal 6 penumpang (sesuai dengan jumlah kursi dipilih)
                            </span>
                        </div>

                        <!-- NAMA PENUMPANG -->
                        <div id="passengerNames">
                            <div class="form-group">
                                <label>Nama Penumpang 1 <span class="required">*</span></label>
                                <input type="text" 
                                       name="nama_penumpang[]" 
                                       class="form-control" 
                                       placeholder="Masukkan nama lengkap" 
                                       required>
                            </div>
                        </div>

                        <div class="btn-group" style="display: flex; gap: 10px; margin-top: 10px; flex-wrap: wrap; width: 100%;">
                            <button type="submit" class="btn-submit" {{ $availableSeats->count() == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-check-circle"></i> Konfirmasi Pemesanan
                            </button>
                            <a href="{{ route('jadwal') }}" class="btn-cancel" style="width: 100%; justify-content: center; padding: 12px;">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SIDEBAR RINGKASAN -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-receipt"></i> Ringkasan</h4>
                </div>
                <div class="card-body">
                    <div class="summary-card">
                        <div class="summary-row">
                            <span class="label">Harga per tiket</span>
                            <span class="value">Rp {{ number_format($flight->harga, 0, ',', '.') }}</span>
                        </div>
                        <hr style="margin: 8px 0;">
                        <div class="summary-row">
                            <span class="label">Jumlah penumpang</span>
                            <span class="value" id="summaryPenumpang">1</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Kursi dipilih</span>
                            <span class="value" id="summarySeats">-</span>
                        </div>
                        <hr style="margin: 8px 0;">
                        <div class="summary-row total">
                            <span class="label"><strong>Total</strong></span>
                            <span class="value" id="summaryTotal">Rp {{ number_format($flight->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.seat-checkbox');
    const jumlahPenumpang = document.getElementById('jumlah_penumpang');
    const summaryPenumpang = document.getElementById('summaryPenumpang');
    const summarySeats = document.getElementById('summarySeats');
    const summaryTotal = document.getElementById('summaryTotal');
    const passengerContainer = document.getElementById('passengerNames');
    const harga = {{ $flight->harga }};

    function updateSummary() {
        const selected = document.querySelectorAll('.seat-checkbox:checked');
        const count = selected.length;
        
        // Update summary seats
        summarySeats.textContent = count > 0 ? 
            Array.from(selected).map(cb => cb.dataset.seat).join(', ') : 
            '-';
        
        // Update jumlah penumpang
        const passengerCount = Math.max(1, count);
        jumlahPenumpang.value = passengerCount;
        summaryPenumpang.textContent = passengerCount;
        
        // Update total harga
        const total = harga * passengerCount;
        summaryTotal.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        
        // Update input nama penumpang
        const currentInputs = passengerContainer.querySelectorAll('.form-group');
        const currentCount = currentInputs.length;
        
        if (passengerCount > currentCount) {
            for (let i = currentCount; i < passengerCount; i++) {
                const div = document.createElement('div');
                div.className = 'form-group';
                div.innerHTML = `
                    <label>Nama Penumpang ${i+1} <span class="required">*</span></label>
                    <input type="text" name="nama_penumpang[]" class="form-control" placeholder="Masukkan nama lengkap" required>
                `;
                passengerContainer.appendChild(div);
            }
        } else if (passengerCount < currentCount) {
            for (let i = currentCount - 1; i >= passengerCount; i--) {
                passengerContainer.removeChild(currentInputs[i]);
            }
        }
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            const selected = document.querySelectorAll('.seat-checkbox:checked');
            
            if (selected.length > 6) {
                this.checked = false;
                alert('⚠️ Maksimal pilih 6 kursi!');
                return;
            }
            
            updateSummary();
        });
    });

    jumlahPenumpang.addEventListener('change', function() {
        let val = parseInt(this.value);
        if (val > 6) { this.value = 6; val = 6; alert('⚠️ Maksimal 6 penumpang!'); }
        if (val < 1) { this.value = 1; val = 1; }
        
        const selected = document.querySelectorAll('.seat-checkbox:checked');
        if (selected.length > val) {
            const toUncheck = Array.from(selected).slice(val);
            toUncheck.forEach(cb => cb.checked = false);
        }
        updateSummary();
    });

    // Inisialisasi
    updateSummary();
});
</script>

@endsection