@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Formulir Reservasi Bus</h2>

    <div class="card shadow-lg p-5 rounded-5 border-0">
        <form action="{{ route('pelanggan.reservation.store') }}" method="POST">
            @csrf

            {{-- Nama & Email --}}
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control"  value="{{ $user->name }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="text" name="email" class="form-control"  value="{{ $user->email }}" readonly>
                </div>
            </div>

            {{-- Nomor Telepon & Alamat --}}
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="nomor_telepon" class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" class="form-control" placeholder="Masukkan nomor telepon" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat" required>
                </div>
            </div>

            {{-- Tujuan --}}
            <div class="mb-3">
                <label for="tujuan" class="form-label fw-semibold">Tujuan</label>
                <input type="text" name="tujuan" class="form-control" placeholder="Masukkan tujuan" required>
            </div>

            {{-- Tanggal --}}
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="tanggal_berangkat" class="form-label fw-semibold">Tanggal Berangkat</label>
                    <input type="date" name="tanggal_berangkat" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_pulang" class="form-label fw-semibold">Tanggal Pulang</label>
                    <input type="date" name="tanggal_pulang" class="form-control" required>
                </div>
            </div>

            {{-- Pilih Bus --}}
            <div class="mb-3">
                <label for="bus_id" class="form-label fw-semibold">Pilih Bus</label>
                <select name="bus_id" class="form-select" required>
                    <option value="">-- Pilih Bus --</option>
                    @foreach($bus as $b)
                        <option value="{{ $b->id }}">{{ $b->type }} - Rp {{ number_format($b->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah Penumpang --}}
            <div class="mb-3">
                <label for="number_of_seats" class="form-label fw-semibold">Jumlah Penumpang</label>
                <input type="number" name="number_of_seats" class="form-control" min="1" placeholder="Masukkan jumlah penumpang" required>
            </div>

            {{-- Tombol Submit --}}
            <div class="text-center">
                <button type="submit" class="btn btn-warning btn-lg text-white px-5 rounded-pill shadow-sm">
                    Kirim Reservasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
