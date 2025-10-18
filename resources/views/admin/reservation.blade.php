@extends('home')
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
            {{-- <a href="{{ route('reservation.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            {{-- <th>Jadwal ID</th> --}}
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Tujuan</th>
                            <th>Jumlah Kursi</th>
                            <th>Kode Reservasi</th>
                            <th>Tanggal Reservasi</th>
                            <th>Durasi Reservasi</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            {{-- <th>Aksi</th> --}}
                          </tr>
                          <?php $no = 1; ?>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->nama_lengkap }}</td>
                                <td>{{ $value->email }}</td>
                                {{-- <td>{{ $value->schedule_id }}</td> --}}
                                 <td>{{ $value->nomor_telepon }}</td>
                                 <td>{{ $value->alamat }}</td>
                                 <td>{{ $value->tujuan }}</td>
                                <td>{{ $value->number_of_seats }}</td>
                                <td>{{ $value->reservation_code }}</td>
                                <td>{{ $value->reservation_date }}</td>
                                <td>{{ $value->reservation_duration }}</td>
                                <td>{{ $value->payment_date }}</td>
                                <td>{{ $value->payment }}</td>
                                <td>{{ $value->set_payment_method }}</td>
                                <td>
                                <form action="{{ route('reservation.updateStatus', $value->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <div class="btn-group" role="group">
                                        <button type="submit" name="status" value="paid" 
                                            class="btn btn-sm {{ $value->payment_status === 'paid' ? 'btn-success' : 'btn-outline-success' }}">
                                            Paid
                                        </button>
                                        <button type="submit" name="status" value="canceled" 
                                            class="btn btn-sm {{ $value->payment_status === 'canceled' ? 'btn-danger' : 'btn-outline-danger' }}">
                                            Canceled
                                        </button>
                                        <button type="submit" name="status" value="refund" 
                                            class="btn btn-sm {{ $value->payment_status === 'refund' ? 'btn-warning' : 'btn-outline-warning' }}">
                                            Refund
                                        </button>
                                    </div>
                                </form>
                            </td>

                                {{-- <td>{{ $value->payment_status }}</td> --}}
                                {{-- <td class="align-middle"> --}}
                                    {{-- <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Reservasi">
                                      <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                        <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                                      </a>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Reservasi">
                                      <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                        <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                                      </a>
                                    </button> --}}
                                  </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $data->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection
