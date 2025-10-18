@extends('home')
@section('title', 'Data Customer')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Data Customer</h1>

    <!-- Search Form -->
    @include('admin.components.search-form')

    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Data Customer</h6>
            <a href="{{ route('customer.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                          </tr>
                          <?php $no = 1; ?>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->full_name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone_number }}</td>
                                <td>{{ $value->address }}</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Customer">
                                      <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                        <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                                      </a>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Customer">
                                      <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                        <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                                      </a>
                                    </button>
                                  </td>
                            </tr>
                            @endforeach
                    </thead>
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
