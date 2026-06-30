@extends('layouts.app')

@section('form-content')

<form action="{{ route('bookings.update',$booking->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Penerbangan</label>

<select name="flight_id" class="form-control">

@foreach($flights as $flight)

<option
value="{{ $flight->id }}"
{{ $booking->flight_id == $flight->id ? 'selected' : '' }}>

{{ $flight->asal }} - {{ $flight->tujuan }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Nama Penumpang</label>

<input
type="text"
name="nama_penumpang"
value="{{ $booking->nama_penumpang }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Jumlah Tiket</label>

<input
type="number"
name="jumlah_tiket"
value="{{ $booking->jumlah_tiket }}"
class="form-control"
required>

</div>

<button class="btn btn-save w-100">
Update Booking
</button>

</form>

@endsection

@php
$title = '🎫 Edit Booking';
@endphp