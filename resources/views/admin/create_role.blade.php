@extends('home')
@section('title', 'Tambah Role')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah Role</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm px-4 py-2">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
