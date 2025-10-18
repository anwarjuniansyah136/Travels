@extends('home')
@section('title', 'Data Jadwal Bus')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Data Jadwal Bus</h1>

    <!-- Search Form -->
    @include('admin.components.search-form')

    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Data Jadwal Bus</h6>
            <a href="{{ route('schedule.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>No Pol</th>
                            <th>Kode Bus</th>
                            <th>Tipe Bus</th>
                            <th>Rute Awal</th>
                            <th>Rute Destinasi</th>
                            <th>Waktu Keberangkatan</th>
                            <th>Waktu Kedatangan</th>
                            <th>Total Kursi</th>
                            <th>Unit Tersedia</th>
                            <th>Kuota Unit</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                    </thead>
                    <tbody>
                        
                        @foreach($data as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->no_pol }}</td>
                            <td>{{ $value->bus_code }}</td>
                            <td>{{ $value->BusType ? $value->BusType->type : 'N/A' }}</td>
                            <td>{{ $value->initial_route }}</td>
                            <td>{{ $value->destination_route }}</td>
                            <td>{{ $value->departure_time }}</td>
                            <td>{{ $value->arrival_time }}</td>
                            <td>{{ $value->seat_total }}</td>
                            <td>{{ $value->unit_available }}</td>
                            <td>{{ $value->unit_quota}}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Jadwal">
                                  <a href="{{ url('/schedule/edit/'.$value->id) }}" class="text-white font-weight-bold text-xs">
                                    <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                                  </a>
                                </button>
                                <form action="{{ url('/schedule/delete/'.$value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Jadwal">
                                        <span class="text-white font-weight-bold text-xs">
                                            <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </form>
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
