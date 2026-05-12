@extends('layouts.app')

@section('title', 'Manajemen Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Barang</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarangModal">+ Tambah Barang</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>No</th><th>Nama Barang</th><th>Jumlah</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($barang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBarangModal{{ $item->id }}">Edit</button>
                        <form action="{{ route('admin.barang.delete', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editBarangModal{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.barang.update', $item->id) }}">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5>Edit Barang</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3"><label>Nama Barang</label><input type="text" name="nama_barang" class="form-control" value="{{ $item->nama_barang }}" required></div>
                                    <div class="mb-3"><label>Jumlah Barang</label><input type="number" name="jumlah_barang" class="form-control" value="{{ $item->jumlah_barang }}" required></div>
                                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea></div>
                                </div>
                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addBarangModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.barang.store') }}">
                @csrf
                <div class="modal-header"><h5>Tambah Barang</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Nama Barang</label><input type="text" name="nama_barang" class="form-control" required></div>
                    <div class="mb-3"><label>Jumlah Barang</label><input type="number" name="jumlah_barang" class="form-control" required></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
