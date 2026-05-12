@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8 text-center">
        <h1 class="display-4">Selamat Datang di <span class="text-primary">LabBooking</span></h1>
        <p class="lead">Sistem Peminjaman Alat Laboratorium</p>
        <hr>
        <p>Silakan login untuk meminjam alat laboratorium</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login Sekarang</a>
    </div>
</div>
@endsection
