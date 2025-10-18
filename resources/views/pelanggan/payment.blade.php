@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Pembayaran Reservasi</h4>
                </div>

                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Detail Reservasi</h5>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Nama</span>
                            <strong>{{ $reservation->nama_lengkap }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Email</span>
                            <strong>{{ $reservation->email }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Jumlah Kursi</span>
                            <strong>{{ $reservation->number_of_seats }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total Harga</span>
                            <strong>Rp {{ number_format($reservation->payment, 0, ',', '.') }}</strong>
                        </li>
                    </ul>

                    <div class="text-center">
                        <button id="pay-button" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                            <i class="bi bi-credit-card"></i> Bayar Sekarang
                        </button>
                    </div>
                </div>

                <div class="card-footer text-center bg-light py-3">
                    <small class="text-muted">Pastikan detail reservasi sudah benar sebelum melanjutkan pembayaran.</small>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
document.getElementById('pay-button').addEventListener('click', function () {
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            alert("Pembayaran sukses!");
            window.location.href = "/reservasi/success";
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
        },
        onError: function(result){
            alert("Terjadi kesalahan");
        },
        onClose: function(){
            alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
        }
    });
});
</script>
@endsection
