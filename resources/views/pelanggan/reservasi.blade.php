@extends('layout')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold text-center mb-4">Formulir Reservasi Bus</h2>

  @if($bus)
  <!-- Info bus yang dipilih -->
  <div class="card shadow-sm mb-4">
    <div class="card-body text-center">
      <h5 class="fw-bold">{{ $bus->type }}</h5>
      <p class="mb-1 text-muted">Harga: Rp {{ number_format($bus->price, 0, ',', '.') }}</p>
      <p>Status: <span class="badge {{ $bus->status_ketersediaan == 'Tersedia' ? 'bg-success' : 'bg-warning text-dark' }}">
        {{ $bus->status_ketersediaan }}
      </span></p>
    </div>
  </div>
  @endif

  <!-- Formulir reservasi -->
  <form>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukkan nama anda">
      </div>
      <div class="col-md-6">
        <label class="form-label">Nomor Telepon</label>
        <input type="text" class="form-control" placeholder="Masukkan nomor telepon">
      </div>
      <div class="col-md-6">
        <label class="form-label">Tanggal Keberangkatan</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Durasi Sewa (hari)</label>
        <input type="number" class="form-control" min="1">
      </div>
      <div class="col-12">
        <label class="form-label">Catatan Tambahan</label>
        <textarea class="form-control" rows="3" placeholder="Tambahkan keterangan jika perlu"></textarea>
      </div>
    </div>
    <div class="text-center mt-4">
      <a href="{{ route('pembayaran') }}" class="btn btn-warning text-white px-4">Lanjut ke Pembayaran</a>
    </div>
  </form>
</div>
@endsection
