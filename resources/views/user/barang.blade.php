
@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<h2 class="mb-4">Daftar Barang Laboratorium</h2>

<div class="row">
    @foreach($barang as $item)
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama_barang }}</h5>
                <p class="card-text">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                <hr>
                <p>Stok: <strong>{{ $item->jumlah_barang }}</strong></p>
                <a href="{{ route('user.booking.create') }}" class="btn btn-primary btn-sm">Pinjam</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
