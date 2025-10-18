<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bus | YoraTrans</title>
    <link rel="stylesheet" href="{{ asset('User/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 1100px;
        }

        .bus-detail {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            margin-top: 60px;
            padding: 40px 50px;
            transition: all 0.3s ease;
        }

        .bus-detail:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }

        .bus-image {
            border-radius: 15px;
            overflow: hidden;
        }

        .bus-image img {
            width: 100%;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .bus-image img:hover {
            transform: scale(1.04);
        }

        .bus-info h3 {
            font-weight: 700;
            color: #222;
        }

        .price {
            color: #28a745;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .status {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status.tersedia {
            background-color: #d4edda;
            color: #155724;
        }

        .status.dipesan {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.perawatan {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .fasilitas-list {
            list-style: none;
            padding-left: 0;
            margin-top: 10px;
        }

        .fasilitas-list li {
            padding: 5px 0;
            border-bottom: 1px dashed #ddd;
            font-size: 0.95rem;
        }

        .btn-warning {
            background-color: #ff6600;
            border: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-warning:hover {
            background-color: #e65c00;
        }

        .btn-outline-secondary {
            border-radius: 8px;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
        }

        h5 {
            font-weight: 600;
            color: #333;
            margin-top: 25px;
        }

        @media (max-width: 768px) {
            .bus-detail {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="bus-detail row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0 bus-image">
            <img src="{{ asset('storage/images/' . $bus->image) }}" alt="{{ $bus->type }}">
        </div>

        <div class="col-md-6 bus-info">
            <h3>{{ $bus->type }}</h3>
            <p class="price">Rp {{ number_format($bus->price, 0, ',', '.') }}</p>

            <p>
                @php
                    $statusClass = strtolower($bus->status_ketersediaan) === 'tersedia' ? 'tersedia' :
                                   (strtolower($bus->status_ketersediaan) === 'dipesan' ? 'dipesan' : 'perawatan');
                @endphp
                <span class="status {{ $statusClass }}">Status: {{ ucfirst($bus->status_ketersediaan) }}</span>
            </p>

            <h5>Kapasitas:</h5>
            @if (!empty($bus->seat_capacity))
                <p>{{ $bus->seat_capacity }}</p>
            @else
                <p>Tidak ada data kapasitas.</p>
            @endif

            <h5>Fasilitas:</h5>
            @if (!empty($bus->facility))
                <ul class="fasilitas-list">
                    @foreach(explode(',', $bus->facility) as $item)
                        <li>🚍 {{ trim($item) }}</li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada fasilitas yang terdaftar.</p>
            @endif

            <div class="mt-4">
                <a href="/reservasi" class="btn btn-warning text-white me-2">Reservasi Sekarang</a>
                <a href="{{ url('/homepage') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('User/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
