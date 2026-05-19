@extends('layouts.app')

@section('title', 'Manajemen Peralatan Komputer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Manajemen Peralatan Komputer</h2>
        <p class="text-muted mb-0">Kelola data perangkat keras, peripheral, dan komponen jaringan laboratorium.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBarangModal">
        <i class="bi bi-plus-lg me-2"></i>Tambah Perangkat
    </button>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Nama Perangkat</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Merk</th>
                        <th class="py-3">Spesifikasi</th>
                        <th class="py-3 text-center">Tersedia</th>
                        <th class="py-3 text-center">Rusak</th>
                        <th class="py-3">Kondisi</th>
                        <th class="py-3 pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                    <tr>
                        <td class="ps-4">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $item->nama_barang }}</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-1" 
                                  style="background-color: {{ $item->kategori == 'Komputer' ? '#0284c7' : ($item->kategori == 'Networking' ? '#059669' : ($item->kategori == 'Peripheral' ? '#dc2626' : ($item->kategori == 'Multimedia' ? '#d97706' : '#6b7280'))) }}20; color: {{ $item->kategori == 'Komputer' ? '#0284c7' : ($item->kategori == 'Networking' ? '#059669' : ($item->kategori == 'Peripheral' ? '#dc2626' : ($item->kategori == 'Multimedia' ? '#d97706' : '#6b7280'))) }};">
                                {{ $item->kategori ?? 'Lainnya' }}
                            </span>
                        </td>
                        <td>{{ $item->merk ?? '-' }}</td>
                        <td>
                            <span class="small text-muted" style="max-width: 200px; display: inline-block;">
                                {{ Str::limit($item->spesifikasi ?? '-', 50) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="fw-semibold text-success">{{ $item->jumlah_barang }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-semibold text-warning">{{ $item->jumlah_rusak ?? 0 }}</span>
                        </td>
                        <td>
                            @php
                                $kondisiBadges = [
                                    'baik' => '<span class="badge bg-success rounded-pill px-3 py-1">Baik</span>',
                                    'cukup_baik' => '<span class="badge bg-info rounded-pill px-3 py-1">Cukup Baik</span>',
                                    'rusak_ringan' => '<span class="badge bg-warning rounded-pill px-3 py-1">Rusak Ringan</span>',
                                    'rusak_berat' => '<span class="badge bg-danger rounded-pill px-3 py-1">Rusak Berat</span>',
                                    'perbaikan' => '<span class="badge bg-secondary rounded-pill px-3 py-1">Perbaikan</span>',
                                ];
                            @endphp
                            {!! $kondisiBadges[$item->kondisi ?? 'baik'] ?? '<span class="badge bg-secondary rounded-pill px-3 py-1">-</span>' !!}
                        </td>
                        <td class="pe-4 text-center">
                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1" data-bs-toggle="modal" data-bs-target="#editBarangModal{{ $item->id }}">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </button>
                            <form action="{{ route('admin.barang.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus perangkat {{ $item->nama_barang }}?')">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editBarangModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 rounded-4 shadow-lg">
                                <form method="POST" action="{{ route('admin.barang.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-primary text-white rounded-top-4">
                                        <h5 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Perangkat</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Nama Perangkat</label>
                                                <input type="text" name="nama_barang" class="form-control rounded-3" value="{{ $item->nama_barang }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Kategori</label>
                                                <select name="kategori" class="form-select rounded-3">
                                                    <option value="Komputer" {{ ($item->kategori ?? '') == 'Komputer' ? 'selected' : '' }}>💻 Komputer & Laptop</option>
                                                    <option value="Networking" {{ ($item->kategori ?? '') == 'Networking' ? 'selected' : '' }}>🌐 Jaringan / Networking</option>
                                                    <option value="Peripheral" {{ ($item->kategori ?? '') == 'Peripheral' ? 'selected' : '' }}>⌨️ Peripheral & Input</option>
                                                    <option value="Multimedia" {{ ($item->kategori ?? '') == 'Multimedia' ? 'selected' : '' }}>🎥 Multimedia & Audio</option>
                                                    <option value="Komponen" {{ ($item->kategori ?? '') == 'Komponen' ? 'selected' : '' }}>🔌 Komponen & Kabel</option>
                                                    <option value="Lainnya" {{ ($item->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Merk</label>
                                                <input type="text" name="merk" class="form-control rounded-3" value="{{ $item->merk ?? '' }}" placeholder="Contoh: ASUS, Dell, Cisco">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Lokasi Rak</label>
                                                <input type="text" name="lokasi_rak" class="form-control rounded-3" value="{{ $item->lokasi_rak ?? '' }}" placeholder="Contoh: Rak A1, Lab 1">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Jumlah Tersedia</label>
                                                <input type="number" name="jumlah_barang" class="form-control rounded-3" value="{{ $item->jumlah_barang }}" required min="0">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Jumlah Rusak</label>
                                                <input type="number" name="jumlah_rusak" class="form-control rounded-3" value="{{ $item->jumlah_rusak ?? 0 }}" min="0">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Kondisi</label>
                                                <select name="kondisi" class="form-select rounded-3">
                                                    <option value="baik" {{ ($item->kondisi ?? 'baik') == 'baik' ? 'selected' : '' }}>✅ Baik</option>
                                                    <option value="cukup_baik" {{ ($item->kondisi ?? '') == 'cukup_baik' ? 'selected' : '' }}>👍 Cukup Baik</option>
                                                    <option value="rusak_ringan" {{ ($item->kondisi ?? '') == 'rusak_ringan' ? 'selected' : '' }}>⚠️ Rusak Ringan</option>
                                                    <option value="rusak_berat" {{ ($item->kondisi ?? '') == 'rusak_berat' ? 'selected' : '' }}>❌ Rusak Berat</option>
                                                    <option value="perbaikan" {{ ($item->kondisi ?? '') == 'perbaikan' ? 'selected' : '' }}>🔧 Dalam Perbaikan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Tahun Perolehan</label>
                                                <input type="number" name="tahun_perolehan" class="form-control rounded-3" value="{{ $item->tahun_perolehan ?? '' }}" placeholder="Contoh: 2023">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Spesifikasi</label>
                                                <textarea name="spesifikasi" class="form-control rounded-3" rows="3" placeholder="Contoh: Intel Core i7, RAM 16GB, SSD 512GB">{{ $item->spesifikasi ?? '' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control rounded-3" rows="2">{{ $item->deskripsi ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pb-4 px-4">
                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="bi bi-cpu fs-1 text-muted"></i>
                            <p class="mt-3 text-muted mb-0">Belum ada data peralatan komputer.</p>
                            <p class="text-muted small">Klik "Tambah Perangkat" untuk mulai menambahkan data.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Perangkat -->
<div class="modal fade" id="addBarangModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <form method="POST" action="{{ route('admin.barang.store') }}">
                @csrf
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Perangkat Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Perangkat <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control rounded-3" placeholder="Contoh: Laptop ASUS ROG" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select rounded-3" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Komputer">💻 Komputer & Laptop</option>
                                <option value="Networking">🌐 Jaringan / Networking</option>
                                <option value="Peripheral">⌨️ Peripheral & Input</option>
                                <option value="Multimedia">🎥 Multimedia & Audio</option>
                                <option value="Komponen">🔌 Komponen & Kabel</option>
                                <option value="Lainnya">📦 Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Merk</label>
                            <input type="text" name="merk" class="form-control rounded-3" placeholder="Contoh: ASUS, Dell, Cisco">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Lokasi Rak</label>
                            <input type="text" name="lokasi_rak" class="form-control rounded-3" placeholder="Contoh: Rak A1, Lab 1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jumlah Tersedia <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_barang" class="form-control rounded-3" value="0" required min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jumlah Rusak</label>
                            <input type="number" name="jumlah_rusak" class="form-control rounded-3" value="0" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kondisi</label>
                            <select name="kondisi" class="form-select rounded-3">
                                <option value="baik">✅ Baik</option>
                                <option value="cukup_baik">👍 Cukup Baik</option>
                                <option value="rusak_ringan">⚠️ Rusak Ringan</option>
                                <option value="rusak_berat">❌ Rusak Berat</option>
                                <option value="perbaikan">🔧 Dalam Perbaikan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tahun Perolehan</label>
                            <input type="number" name="tahun_perolehan" class="form-control rounded-3" placeholder="Contoh: 2023" min="2000" max="{{ date('Y') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Spesifikasi</label>
                            <textarea name="spesifikasi" class="form-control rounded-3" rows="3" placeholder="Contoh: Intel Core i7-12700, RAM 16GB, SSD 512GB, NVIDIA GTX 1650"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control rounded-3" rows="2" placeholder="Deskripsi lengkap perangkat dan fungsinya..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perangkat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #475569;
    }
    
    .table td {
        vertical-align: middle;
        font-size: 0.9rem;
    }
    
    .btn-outline-warning {
        border-color: #f59e0b;
        color: #d97706;
    }
    
    .btn-outline-warning:hover {
        background-color: #f59e0b;
        border-color: #f59e0b;
        color: white;
    }
    
    .btn-outline-danger {
        border-color: #ef4444;
        color: #dc2626;
    }
    
    .btn-outline-danger:hover {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #1b5a7a;
        box-shadow: 0 0 0 0.2rem rgba(27, 90, 122, 0.1);
    }
    
    .modal-header {
        border-bottom: none;
    }
    
    .modal-footer {
        border-top: none;
    }
</style>
@endsection