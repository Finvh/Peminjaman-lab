@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="mb-4">Dashboard Admin</h2>

<div class="row">
    <div class="col-md-3"><div class="card text-white bg-primary mb-3"><div class="card-body"><h5>Total User</h5><h2>{{ $totalUsers }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-success mb-3"><div class="card-body"><h5>Total Barang</h5><h2>{{ $totalBarang }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-warning mb-3"><div class="card-body"><h5>Total Peminjaman</h5><h2>{{ $totalPeminjaman }}</h2></div></div></div>
    <div class="col-md-3"><div class="card text-white bg-danger mb-3"><div class="card-body"><h5>Pending</h5><h2>{{ $pendingCount }}</h2></div></div></div>
</div>

<div class="card mt-3">
    <div class="card-header"><h5>Daftar Peminjaman</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>No</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Barang</th><th>Jumlah</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $item)
                        @foreach($item->detailPeminjaman as $detail)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td>
                            <td>{{ $item->user->username }} ({{ $item->user->kelas }})</td>
                            <td>{{ $item->tggl_pinjam }}</td>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>
                                @if($item->status == 'pending') <span class="badge bg-warning">Menunggu</span>
                                @elseif($item->status == 'disetujui') <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status == 'dipinjam') <span class="badge bg-info">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan') <span class="badge bg-secondary">Dikembalikan</span>
                                @else <span class="badge bg-danger">Ditolak</span>@endif
                            </td>
                            <td>
                                <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="disetujui">
                                    @if($item->status == 'pending')
                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                    @endif
                                </form>
                                <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="dipinjam">
                                    @if($item->status == 'disetujui')
                                        <button type="submit" class="btn btn-info btn-sm">Dipinjam</button>
                                    @endif
                                </form>
                                <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="dikembalikan">
                                    @if($item->status == 'dipinjam')
                                        <button type="submit" class="btn btn-secondary btn-sm">Dikembalikan</button>
                                    @endif
                                </form>
                                <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    @if($item->status == 'pending')
                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr><td colspan="7" class="text-center">Belum ada peminjaman</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
