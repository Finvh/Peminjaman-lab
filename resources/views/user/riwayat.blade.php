@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<h2 class="mb-4">Riwayat Peminjaman</h2>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>No</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Barang</th><th>Jumlah</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $item)
                        @foreach($item->detailPeminjaman as $detail)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td>
                            <td>{{ $item->tggl_pinjam }}</td>
                            <td>{{ $item->tggl_kembali ?? '-' }}</td>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>
                                @if($item->status == 'pending') <span class="badge bg-warning">Menunggu</span>
                                @elseif($item->status == 'disetujui') <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status == 'dipinjam') <span class="badge bg-info">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan') <span class="badge bg-secondary">Dikembalikan</span>
                                @else <span class="badge bg-danger">Ditolak</span>@endif
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada riwayat</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
