@extends('layouts.app')

@section('content')

<style>

body{
    background-image:url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
}

.hero-card{
    background:url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05');
    background-size:cover;
    background-position:center;
    border-radius:25px;
    overflow:hidden;
    min-height:280px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.hero-overlay{
    background:rgba(255,255,255,.60);
    padding:45px;
    min-height:280px;
}

.stat-card{
    border:none;
    border-radius:20px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
    background:white;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.icon-box{
    width:70px;
    height:70px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-size:30px;
}

.bg-purple{
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
}

.bg-blue{
    background:linear-gradient(135deg,#38bdf8,#2563eb);
}

.bg-green{
    background:linear-gradient(135deg,#34d399,#10b981);
}

.bg-orange{
    background:linear-gradient(135deg,#fbbf24,#f97316);
}

.info-card{
    border:none;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.customer-hero{
    background:linear-gradient(135deg,#0d6efd,#00c6ff);
    border-radius:25px;
    overflow:hidden;
    color:white;
}

.customer-hero img{
    width:100%;
    height:350px;
    object-fit:cover;
}

</style>

@if(auth()->check() && auth()->user()->role == 'admin')

<div class="container-fluid">

<div class="d-flex justify-content-end mb-3">
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        🚪 Logout
    </button>
</form>
</div>

<div class="hero-card mb-4">
<div class="hero-overlay">

<h4>👋 Selamat Datang, {{ auth()->user()->name }}</h4>

<h1 class="fw-bold display-5">
Dashboard Administrator
</h1>

<p class="fs-5">
Kelola maskapai, penerbangan, pemesanan dan transaksi dengan mudah.
</p>

<a href="{{ route('bookings.index') }}"
class="btn btn-primary btn-lg">
📊 Lihat Laporan </a>

</div>
</div>

<div class="row">

<div class="col-md-3 mb-3">
<div class="stat-card">
<div class="d-flex justify-content-between">
<div class="icon-box bg-purple">✈</div>
<div class="text-end">
<h2>{{ \App\Models\Airline::count() }}</h2>
<p>Total Maskapai</p>
</div>
</div>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card">
<div class="d-flex justify-content-between">
<div class="icon-box bg-blue">🛫</div>
<div class="text-end">
<h2>{{ \App\Models\Flight::count() }}</h2>
<p>Penerbangan</p>
</div>
</div>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card">
<div class="d-flex justify-content-between">
<div class="icon-box bg-green">🎫</div>
<div class="text-end">
<h2>{{ \App\Models\Booking::count() }}</h2>
<p>Pemesanan</p>
</div>
</div>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stat-card">
<div class="d-flex justify-content-between">
<div class="icon-box bg-orange">💰</div>
<div class="text-end">
<h4>Rp {{ number_format(\App\Models\Booking::sum('total_harga')) }}</h4>
<p>Total Transaksi</p>
</div>
</div>
</div>
</div>

</div>

</div>

@else

<div class="container-fluid">

<div class="d-flex justify-content-end mb-3">
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        🚪 Logout
    </button>
</form>
</div>

<div class="customer-hero mb-4">

<div class="row align-items-center">

<div class="col-md-6 p-5">

<h1>✈ Dashboard Customer</h1>

<h2>{{ auth()->user()->name }}</h2>

<p class="fs-5">
Selamat datang di Sistem Pemesanan Tiket Pesawat.
Pesan tiket dengan mudah dan aman.
</p>

<a href="{{ route('bookings.create') }}"
class="btn btn-warning btn-lg">
🎫 Pesan Tiket </a>

</div>

<div class="col-md-6">

<img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05">

</div>

</div>

</div>

<div class="row">

<div class="col-md-4 mb-3">
<div class="stat-card text-center">
<h1>🎫</h1>
<h3>Tiket Saya</h3>

<a href="{{ route('bookings.index') }}"
class="btn btn-primary">
Lihat Tiket </a>

</div>
</div>

<div class="col-md-4 mb-3">
<div class="stat-card text-center">
<h1>🛫</h1>
<h3>Jadwal Penerbangan</h3>

<a href="{{ route('flights.index') }}"
class="btn btn-success">
Lihat Jadwal </a>

</div>
</div>

<div class="col-md-4 mb-3">
<div class="stat-card text-center">
<h1>➕</h1>
<h3>Pesan Tiket</h3>

<a href="{{ route('bookings.create') }}"
class="btn btn-warning">
Pesan </a>

</div>
</div>

</div>

</div>

@endif

@endsection