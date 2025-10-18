@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Reservasi</h2>
    <div class="card p-3">
        <p><strong>Nama Lengkap:</strong> {{ $reservation->nama_lengkap }}</p>
        <p><strong>Email:</strong> {{ $reservation->email }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $reservation->nomor_telepon }}</p>
        <p><strong>Alamat:</strong> {{ $reservation->alamat }}</p>
        <p><strong>Tujuan:</strong> {{ $reservation->tujuan }}</p>
        <p><strong>Jumlah Kursi:</strong> {{ $reservation->number_of_seats }}</p>
        <p><strong>Status Pembayaran:</strong> {{ ucfirst($reservation->payment_status) }}</p>
        <p><strong>Tanggal Pesan:</strong> {{ $reservation->created_at->format('d-m-Y H:i') }}</p>
    </div>
    <a href="{{ route('pelanggan.reservation.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
