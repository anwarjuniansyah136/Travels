<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YoraTrans - Sewa Bus Pariwisata</title>

    <!-- Font & Bootstrap -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        }

        /* Navbar */
        .navbar {
            background: var(--primary-color);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
        }
        .navbar-brand span {
            color: var(--accent-color);
        }
        .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin-left: 10px;
        }
        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        /* Footer */
        footer {
            background: var(--primary-color);
            color: #fff;
            padding: 40px 0;
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

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">YORA<span>TRANS</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="/homepage" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="/reservasi" class="nav-link">Reservasi</a></li>
                    {{-- <li class="nav-item"><a href="/pembayaran" class="nav-link">Pembayaran</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container text-center">
            <h5 class="mb-3">Hubungi Kami</h5>
            <ul class="list-unstyled">
                <li>Jl. Ciganitri No 14, Bandung 4028</li>
                <li><a href="#">+62 818-0904-8010</a></li>
                <li><a href="#">@yoratrans.bdg</a></li>
            </ul>
            <p class="mt-4 mb-0">© <script>document.write(new Date().getFullYear());</script> YoraTrans | All Rights Reserved</p>
        </div>
    </footer>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
