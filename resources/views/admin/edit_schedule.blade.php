@extends('home')
@section('title', 'Edit Jadwal Bus')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Edit Jadwal Bus</h1>

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
            <form action="{{ url('/schedule/update/'.$schedule->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_pol">No Pol</label>
                        <input type="text" name="no_pol" id="no_pol" class="form-control" value="{{ old('no_pol', $schedule->no_pol) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bus_code">Kode Bus</label>
                        <input type="text" name="bus_code" id="bus_code" class="form-control" value="{{ old('bus_code', $schedule->bus_code) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="bus_type_id">Tipe Bus</label>
                        <input type="number" name="bus_type_id" id="bus_type_id" class="form-control" value="{{ old('bus_type_id', $schedule->bus_type_id) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="initial_route">Rute Awal</label>
                        <input type="text" name="initial_route" id="initial_route" class="form-control" value="{{ old('initial_route', $schedule->initial_route) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="destination_route">Rute Destinasi</label>
                        <input type="text" name="destination_route" id="destination_route" class="form-control" value="{{ old('destination_route', $schedule->destination_route) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="departure_time">Waktu Keberangkatan</label>
                        <input type="datetime-local" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time', $schedule->departure_time) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="arrival_time">Waktu Kedatangan</label>
                        <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control" value="{{ old('arrival_time', $schedule->arrival_time) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="seat_total">Total Kursi</label>
                        <input type="number" name="seat_total" id="seat_total" class="form-control" value="{{ old('seat_total', $schedule->seat_total) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="seat_available">Unit Tersedia</label>
                        <input type="number" name="seat_available" id="seat_available" class="form-control" value="{{ old('seat_available', $schedule->seat_available) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="seat_available">Kuota Unit</label>
                        <input type="number" name="seat_available" id="seat_available" class="form-control" value="{{ old('seat_available', $schedule->seat_available) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/schedule') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

@endsection






















