@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen User</h2>
        <p class="text-muted mb-0">Kelola user dan lihat riwayat login mereka.</p>
    </div>
    <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-lg me-2"></i>Tambah User
    </button>
</div>

{{-- Alert Error --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong>Gagal!</strong> 
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- TABEL USER --}}
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0">📋 Daftar User</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Username</th>
                        <th class="py-3">Kelas</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Terakhir Login</th>
                        <th class="py-3 pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->username }}</td>
                        <td>{{ $item->kelas ?? '-' }}</td>
                        <td>
                            @if($item->role == 'admin')
                                <span class="badge bg-danger rounded-pill px-3 py-1">👑 Admin</span>
                            @else
                                <span class="badge bg-primary rounded-pill px-3 py-1">👤 User</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $item->last_login ? \Carbon\Carbon::parse($item->last_login)->diffForHumans() : 'Belum pernah login' }}
                                <br>
                                <span class="fs-12">{{ $item->last_login_ip ?? '-' }}</span>
                            </small>
                        </td>
                        <td class="pe-4 text-center">
                            <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-3 me-1" 
                                    data-bs-toggle="modal" data-bs-target="#loginHistoryModal{{ $item->id }}">
                                <i class="bi bi-clock-history me-1"></i>Riwayat
                            </button>
                            @if($item->role != 'admin')
                            <form action="{{ route('admin.users.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                        onclick="return confirm('Yakin ingin menghapus user {{ $item->username }}?')">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-people fs-1 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada user terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH USER --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white rounded-top-4 border-0">
                    <h5 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Tambah User Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control rounded-3" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Minimal 6 karakter" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelas</label>
                        <input type="text" name="kelas" class="form-control rounded-3" placeholder="Contoh: XII RPL 1">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select rounded-3">
                            <option value="user">User (Siswa)</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL RIWAYAT LOGIN (untuk setiap user) --}}
@foreach($users as $item)
<div class="modal fade" id="loginHistoryModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-info text-white rounded-top-4 border-0">
                <h5 class="fw-bold mb-0">
                    <i class="bi bi-clock-history me-2"></i>Riwayat Login - {{ $item->username }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">No</th>
                                <th class="py-3">Waktu Login</th>
                                <th class="py-3">IP Address</th>
                                <th class="py-3 pe-4">User Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($item->loginHistories as $history)
                            <tr>
                                <td class="ps-4">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($history->login_at)->format('d/m/Y H:i:s') }}</td>
                                <td><code>{{ $history->ip_address ?? '-' }}</code></td>
                                <td class="pe-4 small text-muted">{{ Str::limit($history->user_agent ?? '-', 50) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-3"></i>
                                    <p class="mb-0 mt-2">Belum ada riwayat login</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 py-3 px-4">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .fs-12 {
        font-size: 11px;
    }
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        color: #475569;
    }
    .btn-outline-info {
        border-color: #0ea5e9;
        color: #0284c7;
    }
    .btn-outline-info:hover {
        background-color: #0ea5e9;
        color: white;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1b5a7a !important;
        box-shadow: 0 0 0 0.2rem rgba(27, 90, 122, 0.1) !important;
    }
</style>
@endsection