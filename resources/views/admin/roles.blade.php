@extends('home')
@section('title', 'Role')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Role Management</h1>

    <!-- Search Form -->
    @include('admin.components.search-form')

    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Data Role</h6>
            <a href="{{ route('role.create') }}" class="btn btn-success btn-sm shadow-sm">
                <i class="fas fa-plus"></i> Tambah Role
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1; ?>
                    </thead>
                    <tbody> 
                        @foreach($data as $value)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->name }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Edit Role">
                                  <a href="{{ route('roles.edit', $value->id) }}" class="text-white font-weight-bold text-xs">
                                    <i class="fa fa-edit pt-1" aria-hidden="true"></i>
                                  </a>
                                </button>
                                <button type="button" class="btn btn-danger btn-icon btn-sm p-1" style="width: 30px; height: 30px;" title="Hapus Role">
                                  <a href="javascript:;" class="text-white font-weight-bold text-xs">
                                    <i class="fa fa-trash pt-1" aria-hidden="true"></i>
                                  </a>
                                </button>
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
