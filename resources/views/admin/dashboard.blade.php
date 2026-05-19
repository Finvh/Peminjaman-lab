@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold text-dark mb-4">Dashboard Admin</h2>

    <!-- Stats Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-primary text-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase small mb-1 fw-bold">Total User</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-success text-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase small mb-1 fw-bold">Total Barang</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalBarang ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-box-seam fs-1 text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-warning text-dark">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-dark-50 text-uppercase small mb-1 fw-bold">Total Peminjaman</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalPeminjaman ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-journal-text fs-1 text-dark-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 bg-danger text-white">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-white-50 text-uppercase small mb-1 fw-bold">Pending Approval</h6>
                        <h2 class="mb-0 fw-bold">{{ $pendingCount ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-clock-history fs-1 text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 fw-bold text-secondary">Daftar Pengajuan Peminjaman</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Detail Barang</th>
                            <th>Status</th>
                            <th class="pe-4 text-end">Aksi Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $item)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $item->user->username ?? 'N/A' }}</span>
                                <small class="text-muted">Kelas: {{ $item->user->kelas ?? '-' }}</small>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tggl_pinjam)->translatedFormat('d M Y') }}</td>
                            <td>
                                <!-- Melist barang belanjaan di dalam satu cell agar rapi -->
                                <ul class="list-unstyled mb-0">
                                    @foreach($item->detailPeminjaman as $detail)
                                        <li>
                                            <i class="bi bi-dot text-primary"></i> 
                                            {{ $detail->barang->nama_barang ?? 'Barang Terhapus' }} 
                                            <span class="badge bg-light text-dark border sm-text">x{{ $detail->jumlah }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($item->status == 'pending') <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu</span>
                                @elseif($item->status == 'disetujui') <span class="badge bg-success px-3 py-2 rounded-pill">Disetujui</span>
                                @elseif($item->status == 'dipinjam') <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan') <span class="badge bg-secondary px-3 py-2 rounded-pill">Dikembalikan</span>
                                @else <span class="badge bg-danger px-3 py-2 rounded-pill">Ditolak</span>@endif
                            </td>
                            <td class="pe-4 text-end">
                                <!-- Tombol Aksi Tunggal per Transaksi -->
                                @if($item->status == 'pending')
                                    <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill">Tolak</button>
                                    </form>
                                @endif

                                @if($item->status == 'disetujui')
                                    <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="dipinjam">
                                        <button type="submit" class="btn btn-info btn-sm text-dark px-3 rounded-pill">Serahkan Barang</button>
                                    </form>
                                @endif

                                @if($item->status == 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="dikembalikan">
                                        <button type="submit" class="btn btn-secondary btn-sm px-3 rounded-pill">Selesai / Kembali</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada riwayat pengajuan peminjaman barang.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .sm-text { font-size: 0.75rem; padding: 2px 6px; }
</style>
@endsection