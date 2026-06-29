@extends('layouts.app')

@section('form-content')

<form action="{{ route('airlines.update',$airline->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nama Maskapai</label>
<input
type="text"
name="nama_maskapai"
value="{{ $airline->nama_maskapai }}"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Kode Maskapai</label>
<input
type="text"
name="kode_maskapai"
value="{{ $airline->kode_maskapai }}"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Negara</label>
<input
type="text"
name="negara"
value="{{ $airline->negara }}"
class="form-control"
required>
</div>

<button class="btn btn-save w-100">
Update Maskapai
</button>

</form>

@endsection

@php
$title = '✈ Edit Maskapai';
@endphp