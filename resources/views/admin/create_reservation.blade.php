@extends('home')
@section('title', 'Tambah Reservasi')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah Reservasi</h1>

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
            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id">User ID</label>
                        <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="schedule_id">Jadwal ID</label>
                        <input type="text" name="schedule_id" id="schedule_id" class="form-control" value="{{ old('schedule_id') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="number_of_seats">Jumlah Kursi</label>
                        <input type="number" name="number_of_seats" id="number_of_seats" class="form-control" value="{{ old('number_of_seats') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="reservation_code">Kode Reservasi</label>
                        <input type="text" name="reservation_code" id="reservation_code" class="form-control" value="{{ old('reservation_code') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="reservation_date">Tanggal Reservasi</label>
                        <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ old('reservation_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="reservation_duration">Durasi Reservasi</label>
                        <input type="date" name="reservation_duration" id="reservation_duration" class="form-control" value="{{ old('reservation_duration') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="payment_date">Tanggal Bayar</label>
                        <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ old('payment_date') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="payment">Jumlah Pembayaran</label>
                        <input type="text" name="payment" id="payment" class="form-control" value="{{ old('payment') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="set_payment_method">Metode Pembayaran</label>
                        <input type="text" name="set_payment_method" id="set_payment_method" class="form-control" value="{{ old('set_payment_method') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                     <label for="payment_status">Status Pembayaran</label>
                    <select name="payment_status" id="payment_status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Dibayar">Unpaid</option>
                        <option value="Menunggu Konfirmasi">Pending</option>
                        <option value="Sudah Dibayar">Paid</option>
                        <option value="Gagal Dibayar">Failed</option>
                        <option value="Dibatalkan">Cancelled</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
