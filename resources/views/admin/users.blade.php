@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen User</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Tambah User</button>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr><th>No</th><th>Username</th><th>Kelas</th><th>Role</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->kelas ?? '-' }}</td>
                    <td>@if($item->role == 'admin') <span class="badge bg-danger">Admin</span> @else <span class="badge bg-primary">User</span> @endif</td>
                    <td>
                        @if($item->role != 'admin')
                        <form action="{{ route('admin.users.delete', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-header"><h5>Tambah User</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Username</label><input type="text" name="username" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Kelas</label><input type="text" name="kelas" class="form-control"></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
