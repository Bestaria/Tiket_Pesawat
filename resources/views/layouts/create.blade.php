@extends('layouts.app')

@section('content')

<style>

.create-wrapper{
    min-height:85vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.create-card{

    width:100%;
    max-width:550px;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,.2);

    border-radius:30px;

    padding:40px;

    box-shadow:
    0 20px 40px rgba(0,0,0,.3);

    color:white;
}

.create-title{

    text-align:center;

    font-size:32px;

    font-weight:700;

    margin-bottom:30px;
}

.form-label{

    font-weight:600;
}

.form-control,
.form-select{

    height:55px;

    border:none;

    border-radius:15px;

    background:rgba(255,255,255,.9);
}

.btn-save{

    width:100%;

    height:55px;

    border:none;

    border-radius:15px;

    background:linear-gradient(
    135deg,
    #8b5cf6,
    #6366f1);

    color:white;

    font-weight:700;

    font-size:18px;
}

.btn-save:hover{

    transform:translateY(-2px);

    transition:.3s;
}

.btn-back{

    width:100%;

    margin-top:10px;

    border-radius:15px;
}

</style>

<div class="container">

<div class="create-wrapper">

    <div class="create-card">

        <h2 class="create-title">
            {{ $title }}
        </h2>

        @yield('form-content')

    </div>

</div>

</div>

@endsection