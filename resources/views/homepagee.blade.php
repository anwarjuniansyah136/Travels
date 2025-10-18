<!DOCTYPE html>
<html lang="en">
  <head>
    <title>YoraTrans - Sewa Bus Pariwisata</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('User/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('User/css/style.css') }}">

    <style>
      /* ===== CUSTOM STYLING ===== */
      body {
        font-family: 'Poppins', sans-serif;
        color: #333;
        background-color: #f9f9f9;
      }

      /* NAVBAR */
      .navbar {
        background: linear-gradient(90deg, #000000, #3a3a3a);
        padding: 15px 0;
      }
      .navbar-brand span {
        color: #f96d00;
      }
      .navbar-nav .nav-link {
        color: #fff !important;
        font-weight: 500;
        margin: 0 10px;
        transition: color 0.3s;
      }
      .navbar-nav .nav-link:hover {
        color: #f96d00 !important;
      }

      /* HERO SECTION */
      .hero-wrap {
        position: relative;
        background-size: cover;
        background-position: center center;
        height: 90vh;
        display: flex;
        align-items: center;
        color: #fff;
      }
      .hero-wrap::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
      }
      .hero-wrap .text {
        position: relative;
        z-index: 2;
      }
      .hero-wrap h1 span {
        color: #f96d00;
      }
      .request-form {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }
      .request-form h2 {
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
      }

      /* BUTTONS */
      .btn-custom {
        background-color: #f96d00;
        color: #fff;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all 0.3s ease;
      }
      .btn-custom:hover {
        background-color: #d85b00;
        color: #fff;
      }
      .btn-custom-outline {
        border: 2px solid #f96d00;
        color: #f96d00;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all 0.3s ease;
      }
      .btn-custom-outline:hover {
        background-color: #f96d00;
        color: #fff;
      }

      /* CARD BUS */
      .car-wrap {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
      }
      .car-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      }
      .car-wrap .img {
        height: 200px;
        background-size: cover;
        background-position: center;
      }
      .car-wrap .text h2 a {
        color: #333;
        font-size: 20px;
        text-decoration: none;
      }
      .car-wrap .text span.brand {
        color: #999;
        font-size: 14px;
      }

      /* FOOTER */
      footer {
        background: #222;
        color: #ddd;
        padding: 40px 0;
      }
      footer ul li {
        list-style: none;
        margin-bottom: 10px;
      }
      footer a {
        color: #f96d00;
        text-decoration: none;
      }
      footer a:hover {
        text-decoration: underline;
      }

      /* RESPONSIVE */
      @media (max-width: 768px) {
        .hero-wrap {
          height: auto;
          padding: 60px 0;
        }
        .request-form {
          margin-top: 20px;
        }
      }
    </style>
  </head>

  <body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar">
      <div class="container">
        <a class="navbar-brand" href="#">Yora<span>Trans</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="/" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="/" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="register" class="nav-link">Register</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HERO -->
    <div class="hero-wrap" style="background-image: url('{{ asset('images/yora.jpg') }}');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7">
            <div class="text">
              <h1 class="mb-4">Perjalanan <span>Nyaman</span> Bersama <span>Yora Trans</span></h1>
              <p>Nikmati pengalaman sewa bus pariwisata dengan kursi lega, fasilitas premium, dan layanan terpercaya untuk perjalanan wisata, keluarga, maupun perusahaan.</p>
            </div>
          </div>
          <div class="col-md-5">
            <form action="#" class="request-form">
              <h2>Cari Ketersediaan Bus</h2>
              <div class="form-group">
                <label for="book_pick_date">Tanggal</label>
                <input type="date" class="form-control" id="book_pick_date" placeholder="Pilih tanggal">
              </div>
              <input type="submit" value="Cari" class="btn btn-custom btn-block">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- LIST BUS -->
    <section class="ftco-section">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="font-weight-bold">Daftar Bus yang Tersedia</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-4 mb-4">
            <div class="car-wrap">
              <div class="img" style="background-image: url('{{ asset('images/yora.jpg') }}');"></div>
              <div class="text p-4 text-center">
                <h2><a href="#">SR 3 Mercedez Benz OH 1626</a></h2>
                <span class="brand">Mercedes</span>
                <div class="mt-3">
                  <a href="/" class="btn btn-custom mx-1">Reservasi</a>
                  <a href="/" class="btn btn-custom-outline mx-1">Detail</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="car-wrap">
              <div class="img" style="background-image: url('{{ asset('images/yoraa.jpg') }}');"></div>
              <div class="text p-4 text-center">
                <h2><a href="#">Mercedes Benz OH 1626 L</a></h2>
                <span class="brand">Ford</span>
                <div class="mt-3">
                  <a href="/" class="btn btn-custom mx-1">Reservasi</a>
                  <a href="/" class="btn btn-custom-outline mx-1">Detail</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="car-wrap">
              <div class="img" style="background-image: url('{{ asset('images/yora.jpg') }}');"></div>
              <div class="text p-4 text-center">
                <h2><a href="#">Legrest Premium</a></h2>
                <span class="brand">Chevrolet</span>
                <div class="mt-3">
                  <a href="/" class="btn btn-custom mx-1">Reservasi</a>
                  <a href="/" class="btn btn-custom-outline mx-1">Detail</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div class="container text-center">
        <h5 class="mb-3">Hubungi Kami</h5>
        <ul class="list-unstyled">
          <li><span class="icon icon-map-marker"></span> Jln Ciganitri No 14, Bandung 4028</li>
          <li><a href="#"><span class="icon icon-phone"></span> +62 818-0904-8010</a></li>
          <li><a href="#"><span class="icon icon-instagram"></span> @yoratrans.bdg</a></li>
        </ul>
        <p class="mt-4 mb-0">Copyright &copy;
          <script>document.write(new Date().getFullYear());</script> YoraTrans | All Rights Reserved
        </p>
      </div>
    </footer>

    <script src="{{ asset('User/js/jquery.min.js') }}"></script>
    <script src="{{ asset('User/js/bootstrap.min.js') }}"></script>
  </body>
</html>
