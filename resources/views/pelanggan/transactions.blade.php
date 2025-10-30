@extends('layouts.app')

@section('title', 'Data Reservasi')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800 fw-bold mb-0">Data Reservasi</h1>
    </div>

    <!-- Search Form -->
    @include('admin.components.search-form')

    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">Daftar Reservasi</h6>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Jumlah Pembayaran</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col" width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $index => $value)
                            <tr>
                                <td class="fw-semibold text-center ">{{ $value->nama_lengkap }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($value->payment, 0, ',', '.') }}</td>
                                <td>
                                    @switch($value->payment_status)
                                        @case('paid')
                                            <span class="badge bg-success px-3 py-2">Lunas</span>
                                            @break
                                        @case('canceled')
                                            <span class="badge bg-danger px-3 py-2">Gagal</span>
                                            @break
                                        @default
                                            <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($value->payment_status === 'pending')
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('pelanggan.transaction.delete', $value->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                                    <i class="fas fa-times-circle me-1"></i> Batalkan
                                                </button>
                                            </form>

                                            <form action="{{ route('pelanggan.reservation.payment', $value->id) }}" method="GET">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-sm rounded-pill">
                                                    <i class="fas fa-credit-card me-1"></i> Bayar
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-secondary btn-sm rounded-pill" disabled>
                                                <i class="fas fa-lock me-1"></i> Batalkan
                                            </button>
                                            <a href="{{ route('pelanggan.invoice', $value->id) }}" 
                                               class="btn btn-primary btn-sm rounded-pill">
                                                <i class="fas fa-file-invoice me-1"></i> Lihat Invoice
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i>Belum ada data reservasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $reservations->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
