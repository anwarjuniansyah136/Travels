@extends('layout')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-dark">Pembayaran</h2>
    <p class="text-muted">Lengkapi data pembayaran Anda di bawah ini</p>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm p-4 rounded-4">
        <form action="#" method="POST">
          @csrf

          <div class="mb-3">
            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email aktif" required>
          </div>

          <div class="mb-3">
            <label for="metode" class="form-label fw-semibold">Metode Pembayaran</label>
            <select name="metode" id="metode" class="form-select" required>
              <option value="">Pilih Metode</option>
              <option value="transfer">Transfer Bank</option>
              <option value="qris">QRIS</option>
              <option value="cash">Bayar di Tempat</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="total" class="form-label fw-semibold">Total Pembayaran</label>
            <input type="text" name="total" id="total" class="form-control" placeholder="Rp 0" readonly>
          </div>

          <button type="submit" class="btn btn-warning text-white w-100 fw-semibold">
            Konfirmasi Pembayaran
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
