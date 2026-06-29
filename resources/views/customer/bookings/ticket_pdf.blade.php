<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Penerbangan - {{ $booking->kode_booking }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            padding: 20px;
        }
        .ticket-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        .ticket-header {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            padding: 25px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #10b981;
        }
        .ticket-header h1 { font-size: 28px; font-weight: 800; }
        .ticket-header h1 span { color: #10b981; }
        .ticket-header .badge {
            background: #10b981;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            color: white;
        }
        .ticket-body { padding: 30px; }
        .ticket-title { font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 5px; }
        .ticket-subtitle { color: #6b7280; font-size: 14px; margin-bottom: 25px; }
        .flight-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            background: #f8fafc;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #e5e7eb;
        }
        .flight-info .item { display: flex; flex-direction: column; }
        .flight-info .item .label { font-size: 11px; color: #6b7280; text-transform: uppercase; font-weight: 600; }
        .flight-info .item .value { font-size: 16px; font-weight: 700; color: #111827; margin-top: 2px; }
        .flight-info .item .value .route-arrow { color: #10b981; margin: 0 8px; }
        .detail-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .detail-table td { padding: 10px 12px; border-bottom: 1px solid #f3f4f6; font-size: 14px; }
        .detail-table td:first-child { font-weight: 600; color: #6b7280; width: 40%; }
        .detail-table td:last-child { font-weight: 600; color: #111827; }
        .detail-table tr:last-child td { border-bottom: none; }
        .status-badge { display: inline-block; padding: 5px 16px; border-radius: 30px; font-size: 13px; font-weight: 700; }
        .status-confirmed { background: #d1fae5; color: #065f46; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        .status-completed { background: #dbeafe; color: #1e40af; }
        .border-top { border-top: 2px dashed #e5e7eb; margin: 20px 0; padding-top: 20px; }
        .ticket-footer {
            background: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            color: #6b7280;
        }
        .ticket-footer strong { color: #10b981; }
        @media (max-width: 600px) {
            .flight-info { grid-template-columns: 1fr; gap: 10px; }
            .ticket-header { flex-direction: column; text-align: center; gap: 10px; }
            .ticket-header h1 { font-size: 22px; }
            .ticket-body { padding: 20px; }
            .detail-table td { font-size: 12px; padding: 8px 10px; }
        }
    </style>
</head>
<body>

<div class="ticket-container">
    <div class="ticket-header">
        <h1>✈ Air <span>Ticket</span></h1>
        <div>
            <span class="badge">✓ CONFIRMED</span>
        </div>
    </div>

    <div class="ticket-body">
        <div class="ticket-title">🎫 Tiket Penerbangan</div>
        <div class="ticket-subtitle">Kode Booking: <strong>{{ $booking->kode_booking }}</strong></div>

        <div class="flight-info">
            <div class="item">
                <span class="label">Maskapai</span>
                <span class="value">{{ $booking->flight->airline->nama ?? '-' }}</span>
            </div>
            <div class="item">
                <span class="label">Kode Penerbangan</span>
                <span class="value">{{ $booking->flight->kode_penerbangan }}</span>
            </div>
            <div class="item">
                <span class="label">Rute</span>
                <span class="value">
                    {{ $booking->flight->kota_asal }} 
                    <span class="route-arrow">→</span> 
                    {{ $booking->flight->kota_tujuan }}
                </span>
            </div>
            <div class="item">
                <span class="label">Tanggal Penerbangan</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->flight->tanggal_berangkat)->format('d F Y') }}</span>
            </div>
            <div class="item">
                <span class="label">Jam Berangkat</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->flight->jam_berangkat)->format('H:i') }}</span>
            </div>
            <div class="item">
                <span class="label">Jam Tiba</span>
                <span class="value">{{ \Carbon\Carbon::parse($booking->flight->jam_tiba)->format('H:i') }}</span>
            </div>
        </div>

        <table class="detail-table">
            <tr>
                <td>Kode Booking</td>
                <td>{{ $booking->kode_booking }}</td>
            </tr>
            <tr>
                <td>Nama Pemesan</td>
                <td>{{ $booking->nama_pemesan }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $booking->email_pemesan }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>{{ $booking->no_telepon ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jumlah Penumpang</td>
                <td>{{ $booking->jumlah_penumpang }} orang</td>
            </tr>
            <tr>
                <td>Total Harga</td>
                <td style="font-size: 18px; color: #059669;">Rp {{ number_format($booking->total_harga,0,',','.') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span class="status-badge status-{{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="border-top">
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <div>
                    <div style="font-size: 12px; color: #6b7280;">Tanggal Pemesanan</div>
                    <div style="font-weight: 600; color: #111827;">{{ \Carbon\Carbon::parse($booking->tanggal_pemesanan)->format('d F Y H:i') }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 12px; color: #6b7280;">QR Code</div>
                    <div style="font-size: 10px; color: #10b981; font-weight: 600; letter-spacing: 2px;">
                        {{ $booking->kode_booking }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-footer">
        <p>
            <strong>✈ Air Ticket</strong> — Terima kasih telah menggunakan layanan kami.
            <br>
            Harap bawa tiket ini saat check-in di bandara.
        </p>
    </div>
</div>

</body>
</html>