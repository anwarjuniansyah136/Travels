@extends('home') {{-- Asumsi layout kamu pakai file main.blade.php --}}
@section('title', 'Data User')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data User</h1>

    {{-- Form Tambah User --}}
    <div class="card mb-4">
        <div class="card-header">Tambah User</div>
        <div class="card-body">
            <form action="{{ url('/user/create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="1">Admin</option>
                        <option value="2">Pelanggan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    {{-- Tabel User --}}
    <div class="card shadow mb-4">
        <div class="card-header">List User</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_id == 1 ? 'Admin' : 'Pelanggan' }}</td>
                                <td>
                                    <form action="{{ url('/user/delete/'.$user->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Belum ada user</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
