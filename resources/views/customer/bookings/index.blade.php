@extends('layouts.app')

@section('content')

<div class="container">

<h2>🎫 Riwayat Transaksi</h2>

<a href="{{ route('bookings.create') }}"
   class="btn btn-primary mb-3">
   + Pesan Tiket
</a>

<table class="table table-bordered">

<thead class="table-dark">
<tr>
    <th>Kode</th>
    <th>Maskapai</th>
    <th>Tujuan</th>
    <th>Tiket</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($bookings as $booking)

<tr>

<td>
BK-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
</td>

<td>
{{ $booking->flight->airline->nama_maskapai }}
</td>

<td>
{{ $booking->flight->asal }}
➜
{{ $booking->flight->tujuan }}
</td>

<td>
{{ $booking->jumlah_tiket }}
</td>

<td>
Rp {{ number_format($booking->total_harga) }}
</td>

<td>
<span class="badge bg-success">
{{ $booking->status }}
</span>
</td>

<td>

<a href="{{ route('bookings.show',$booking->id) }}"
   class="btn btn-info btn-sm">
   🎫 Tiket
</a>

<form action="{{ route('bookings.destroy',$booking->id) }}"
      method="POST"
      style="display:inline-block">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
🗑 Hapus
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection