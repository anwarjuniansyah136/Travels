@extends('layouts.app')

@section('title', 'Data Reservasi')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Data Reservasi</h1>

    <!-- Search Form -->
    @include('admin.components.search-form')

    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Data Reservasi</h6>
            {{-- Tombol tambah data jika dibutuhkan --}}
            {{-- <a href="{{ route('reservation.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a> --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>

                            <th>Jumlah Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($reservations as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->nama_lengkap }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ number_format($value->payment, 0, ',', '.') }}</td>
                            <td>
                                @switch($value->payment_status)
                                    @case('paid')
                                        <span class="badge bg-success">Paid</span>
                                        @break
                                    @case('canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                        @break
                                    @default
                                        <span class="badge bg-warning text-dark">Pending</span>
                                @endswitch
                            </td>
                            <td>
                                @if($value->payment_status !== 'paid')
                                
                                <form action="{{ route('pelanggan.transaction.delete', $value->id) }}" method="POST" 
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Batalkan
                                    </button>
                                </form>
                            @else
                            
                                <button class="btn btn-secondary btn-sm" disabled>
                                    <i class="fa fa-trash"></i> Batalkan
                                </button>

                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reservations->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
