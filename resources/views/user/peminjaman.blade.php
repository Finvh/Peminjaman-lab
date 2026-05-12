@extends('layouts.app')

@section('title', 'Form Peminjaman')

@section('content')
<h2 class="mb-4">Form Peminjaman Barang</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('user.booking.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tggl_pinjam" class="form-control" required>
            </div>

            <h5>Pilih Barang</h5>
            <table class="table table-bordered" id="barangTable">
                <thead>
                    <tr><th>Barang</th><th>Stok</th><th>Jumlah</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-select barang-select" required>
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}" data-stok="{{ $b->jumlah_barang }}">{{ $b->nama_barang }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="stok-cell">-</td>
                        <td><input type="number" name="jumlah[]" class="form-control" min="1" value="1" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary btn-sm" id="addRow">+ Tambah Barang</button>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('addRow').onclick = function() {
    const tbody = document.querySelector('#barangTable tbody');
    const newRow = document.querySelector('#barangTable tbody tr').cloneNode(true);
    newRow.querySelectorAll('input').forEach(i => i.value = '');
    newRow.querySelector('select').value = '';
    tbody.appendChild(newRow);
}

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
        const rows = document.querySelectorAll('#barangTable tbody tr');
        if (rows.length > 1) e.target.closest('tr').remove();
        else alert('Minimal satu barang harus dipilih!');
    }
});

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('barang-select')) {
        const row = e.target.closest('tr');
        const stok = e.target.options[e.target.selectedIndex]?.dataset.stok || 0;
        row.querySelector('.stok-cell').innerText = stok;
    }
});
</script>
@endsection
