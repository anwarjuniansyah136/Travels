<!DOCTYPE html>
<html lang="en">
  <head>
    <title>YoraTrans - Sewa Bus Pariwisata</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('User/css/bootstrap.min.css') }}">
    <style>
      :root {
        --primary-color: #9b0000;
        --accent-color: #ff6600;
        --text-dark: #333;
      }

      body {
        font-family: 'Poppins', sans-serif;
        background-color: #fdfdfd;
        color: var(--text-dark);
        scroll-behavior: smooth;
      }

      /* Navbar */
      .navbar {
        background: var(--primary-color);
        padding: 0.8rem 0;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      }
      .navbar-brand {
        font-weight: 700;
        color: #fff !important;
        letter-spacing: 1px;
      }
      .navbar-brand span {
        color: var(--accent-color);
      }
      .nav-link {
        color: #fff !important;
        font-weight: 500;
        margin-left: 1rem;
        transition: 0.3s;
      }
      .nav-link:hover {
        color: var(--accent-color) !important;
      }

      /* Hero */
      .hero-wrap {
        background-size: cover;
        background-position: center;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        color: white;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
      .hero-wrap::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
      }
      .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 0 15px;
      }
      .hero-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
      }
      .hero-content h1 span {
        color: var(--accent-color);
      }

      /* Search Box */
      .search-box {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-top: -70px;
        position: relative;
        z-index: 10;
      }

      /* Buttons */
      .btn-warning {
        background-color: var(--accent-color);
        border: none;
        font-weight: 600;
        transition: 0.3s;
      }
      .btn-warning:hover {
        background-color: #ff8533;
      }
      .btn-outline-warning {
        color: var(--accent-color);
        border-color: var(--accent-color);
      }
      .btn-outline-warning:hover {
        background-color: var(--accent-color);
        color: white;
      }

      /* Cards */
      .card {
        border: none;
        border-radius: 15px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
      .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
      }
      .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        height: 180px;
        object-fit: cover;
      }

      /* Footer */
      footer {
        background: var(--primary-color);
        color: #fff;
        padding: 50px 0;
        margin-top: 60px;
      }
      footer a {
        color: #fff;
        text-decoration: none;
      }
      footer a:hover {
        color: var(--accent-color);
      }
    </style>
  </head>
  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') }}">YORA<span>TRANS</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link active">Beranda</a></li>
            <li class="nav-item"><a href="/reservasi" class="nav-link">Reservasi</a></li>
            <li class="nav-item"><a href="/transaction" class="nav-link">Transaksi</a></li>
          </ul>
          @auth
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                Logout
              </a>
            </li>
          </ul>
          @endauth
        </div>
      </div>
    </nav>

    <!-- HERO -->
    <div class="hero-wrap" style="background-image: url('{{ asset('images/yora.jpg') }}'); margin-top: 56px;">
      <div class="hero-content">
        <h1>Perjalanan Nyaman Bersama <span>Yora Trans</span></h1>
        <p class="lead mt-3">Nikmati perjalanan pariwisata dengan layanan terbaik dan fasilitas lengkap.</p>
      </div>
    </div>

    <!-- FORM CARI BUS -->
    <section class="container search-box">
      <form action="{{ route('homepage') }}" method="GET">
        <div class="row g-3 align-items-end justify-content-center">
          <div class="col-md-4">
            <label for="tipe_bus" class="form-label fw-semibold">Tipe Bus</label>
            <select name="tipe_bus" id="tipe_bus" class="form-select">
              <option value="">Pilih Tipe Bus</option>
              @php
                $tipeBus = \App\Models\Admin\BusType::select('type')->distinct()->get();
              @endphp
              @foreach($tipeBus as $t)
                <option value="{{ $t->type }}" {{ request('tipe_bus') == $t->type ? 'selected' : '' }}>
                  {{ $t->type }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-warning w-100 text-white">Cari Ketersediaan</button>
          </div>
        </div>
      </form>
    </section>

    <!-- LIST BUS -->
    <section class="py-5">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold text-dark">Daftar Bus yang Tersedia</h2>
          <p class="text-muted">Pilih bus sesuai kebutuhan perjalanan Anda</p>
        </div>

        <div class="row g-4 justify-content-center">
          @forelse($bus as $value)
            <div class="col-md-4 col-lg-3 d-flex">
              <div class="card shadow-sm w-100">
                <img src="{{ asset('storage/images/'.$value->image) }}" class="card-img-top" alt="{{ $value->type }}">
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold">{{ $value->type }}</h5>
                  <p class="text-muted mb-1">Rp {{ number_format($value->price, 0, ',', '.') }}</p>
                  <span class="badge {{ $value->status_ketersediaan == 'Tersedia' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $value->status_ketersediaan }}
                  </span>
                  <div class="mt-3 d-flex justify-content-center gap-2">
                    <a href="/reservasi" class="btn btn-warning text-white btn-sm">Reservasi</a>
                    <a href="{{ route('detail.bus', $value->id) }}" class="btn btn-outline-warning btn-sm">Detail</a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <p class="text-center text-muted">Belum ada data bus tersedia.</p>
          @endforelse
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div class="container text-center">
        <h5 class="mb-3 fw-semibold">Hubungi Kami</h5>
        <ul class="list-unstyled mb-3">
          <li>Jl. Ciganitri No 14, Bandung 4028</li>
          <li><a href="tel:+6281809048010">+62 818-0904-8010</a></li>
          <li><a href="#">@yoratrans.bdg</a></li>
        </ul>
        <p class="mb-0 small">
          © <script>document.write(new Date().getFullYear());</script> YoraTrans | All Rights Reserved
        </p>
      </div>
    </footer>

    <script src="{{ asset('User/js/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
