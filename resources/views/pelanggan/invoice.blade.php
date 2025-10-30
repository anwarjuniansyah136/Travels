@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold text-primary mb-0">YoraTrans</h4>
                <small class="text-muted">Sewa Bus Pariwisata</small>
            </div>
            <div class="text-end">
                <h5 class="fw-bold mb-0">INVOICE</h5>
                <small class="text-muted">No: {{ 'RESV-'.$reservation->id.'-'.$reservation->reservation_code }}</small>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="fw-bold text-secondary">Dibayarkan oleh:</h6>
                <p class="mb-0">{{ $reservation->nama_lengkap }}</p>
                <p class="mb-0">{{ $reservation->email }}</p>
                <p class="mb-0">Telp: {{ $reservation->nomor_telepon }}</p>
            </div>
            <div class="col-md-6 text-end">
                <h6 class="fw-bold text-secondary">Tanggal Pembayaran:</h6>
                <p class="mb-0">
                    {{ $reservation->payment_date ? $reservation->payment_date->format('d M Y H:i') : '-' }}
                </p>
                <h6 class="fw-bold text-secondary mt-3">Status:</h6>
                <span class="badge 
                    @if($reservation->payment_status === 'paid') bg-success
                    @elseif($reservation->payment_status === 'canceled') bg-danger
                    @else bg-danger
                    @endif
                ">
                    {{ strtoupper($reservation->status) }}
                </span>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-center">Jumlah Kursi</th>
                    <th class="text-center">Metode Pembayaran</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sewa Bus Pariwisata</td>
                    <td class="text-center">{{ $reservation->number_of_seats }}</td>
                    <td class="text-center">{{ strtoupper($reservation->set_payment_method ?? '-') }}</td>
                    <td class="text-end">Rp {{ number_format($reservation->payment, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-end mt-4">
            <h5 class="fw-bold">Total Dibayar:
                <span class="text-primary">Rp {{ number_format($reservation->payment, 0, ',', '.') }}</span>
            </h5>
        </div>

        <hr>

        <div class="text-center mt-3">
            <p class="text-muted mb-0">Terima kasih telah menggunakan layanan YoraTrans.</p>
            <p class="text-muted small">Invoice ini dibuat otomatis oleh sistem pada {{ now()->format('d M Y H:i') }}</p>
        </div>

        <div class="text-center mt-4">
            <a href="/homepage" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Reservasi
            </a>
        </div>
    </div>
</div>
@endsection
