<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan - Yora Trans</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2c5aa0;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c5aa0;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #666;
            font-size: 16px;
            font-weight: normal;
        }
        
        .header p {
            color: #888;
            font-size: 11px;
            margin-top: 5px;
        }
        
        .summary-section {
            margin-bottom: 25px;
        }
        
        .summary-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        
        .summary-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px;
        }
        
        .summary-row {
            display: table-row;
        }
        
        .summary-box {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            border: 2px solid;
            border-radius: 8px;
            vertical-align: top;
        }
        
        .summary-box.blue {
            border-color: #3498db;
            background-color: #ebf3fd;
        }
        
        .summary-box.green {
            border-color: #27ae60;
            background-color: #eafaf1;
        }
        
        .summary-box.orange {
            border-color: #f39c12;
            background-color: #fef9e7;
        }
        
        .summary-box.red {
            border-color: #e74c3c;
            background-color: #fdf2f2;
        }
        
        .summary-box h3 {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #555;
        }
        
        .summary-box .number {
            font-size: 20px;
            font-weight: bold;
            color: #2c5aa0;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-left: 4px solid #2c5aa0;
            text-transform: uppercase;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }
        
        .table th {
            background-color: #2c5aa0;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #1e3d6f;
        }
        
        .table td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .table tr:hover {
            background-color: #e3f2fd;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .currency {
            font-weight: bold;
            color: #27ae60;
        }
        
        .status-paid {
            color: #27ae60;
            font-weight: bold;
        }
        
        .status-pending {
            color: #f39c12;
            font-weight: bold;
        }
        
        .status-cancelled {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #2c5aa0;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        
        .footer p {
            margin: 2px 0;
        }
        
        .report-info {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 11px;
        }
        
        .report-info strong {
            color: #2c5aa0;
        }
        
        @media print {
            body {
                font-size: 10px;
            }
            
            .summary-box {
                page-break-inside: avoid;
            }
            
            .section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>YORA TRANS</h1>
        <h2>Laporan Bulanan Sistem Manajemen Bus</h2>
        <p>Dibuat pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <strong>Periode Laporan:</strong> {{ $dateFrom->format('F Y') }}<br>
        <strong>Tanggal Mulai:</strong> {{ $dateFrom->format('d F Y') }}<br>
        <strong>Tanggal Akhir:</strong> {{ $dateTo->format('d F Y') }}
    </div>

    <!-- Summary Section -->
    <div class="summary-section">
        <div class="summary-title">Ringkasan Data</div>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-box blue">
                    <h3>Total Bus</h3>
                    <div class="number">{{ $totalBus }}</div>
                </div>
                <div class="summary-box green">
                    <h3>Total Jadwal</h3>
                    <div class="number">{{ $totalSchedule }}</div>
                </div>
                <div class="summary-box orange">
                    <h3>Total Reservasi</h3>
                    <div class="number">{{ $totalReservation }}</div>
                </div>
                <div class="summary-box red">
                    <h3>Total Pendapatan</h3>
                    <div class="number currency">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bus Type Overview -->
    <div class="section">
        <div class="section-title">Ringkasan Tipe Bus</div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30%;">Tipe Bus</th>
                    <th style="width: 20%;" class="text-center">Kapasitas</th>
                    <th style="width: 25%;" class="text-right">Harga (Rupiah)</th>
                    <th style="width: 25%;" class="text-center">Jadwal Aktif</th>
                </tr>
            </thead>
            <tbody>
                @forelse($busTypes as $bus)
                <tr>
                    <td><strong>{{ $bus->type }}</strong></td>
                    <td class="text-center">{{ $bus->seat_capacity }} kursi</td>
                    <td class="text-right currency">Rp {{ number_format($bus->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $bus->schedules_count }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data tipe bus</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Reservation Statistics -->
    <div class="section">
        <div class="section-title">Statistik Reservasi</div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50%;">Status Pembayaran</th>
                    <th style="width: 25%;" class="text-center">Jumlah</th>
                    <th style="width: 25%;" class="text-right">Total (Rupiah)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservationsByStatus as $status)
                <tr>
                    <td>
                        <span class="status-{{ strtolower($status->payment_status) }}">
                            {{ ucfirst($status->payment_status) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $status->count }}</td>
                    <td class="text-right currency">
                        @php
                            $statusRevenue = \App\Models\Admin\Reservation::where('payment_status', $status->payment_status)
                                ->whereBetween('created_at', [$dateFrom, $dateTo])
                                ->sum('payment');
                        @endphp
                        Rp {{ number_format($statusRevenue, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data reservasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Top Routes -->
    @if($topRoutes->count() > 0)
    <div class="section">
        <div class="section-title">Rute Terpopuler</div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 40%;">Rute Awal</th>
                    <th style="width: 40%;">Rute Tujuan</th>
                    <th style="width: 20%;" class="text-center">Jumlah Jadwal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topRoutes as $route)
                <tr>
                    <td>{{ $route->initial_route }}</td>
                    <td>{{ $route->destination_route }}</td>
                    <td class="text-center">{{ $route->schedule_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Monthly Revenue Details -->
    @if($monthlyRevenue->count() > 0)
    <div class="section">
        <div class="section-title">Detail Pendapatan Harian</div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 20%;">Tanggal</th>
                    <th style="width: 30%;" class="text-center">Jumlah Transaksi</th>
                    <th style="width: 50%;" class="text-right">Total Pendapatan (Rupiah)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyRevenue as $revenue)
                <tr>
                    <td>{{ $revenue->day }} {{ $dateFrom->format('F Y') }}</td>
                    <td class="text-center">
                        @php
                            $dailyTransactions = \App\Models\Admin\Reservation::where('payment_status', 'paid')
                                ->whereDay('payment_date', $revenue->day)
                                ->whereMonth('payment_date', $dateFrom->format('m'))
                                ->whereYear('payment_date', $dateFrom->format('Y'))
                                ->count();
                        @endphp
                        {{ $dailyTransactions }}
                    </td>
                    <td class="text-right currency">Rp {{ number_format($revenue->revenue, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>© Yora Trans {{ date('Y') }}</strong></p>
        <p>Laporan ini dibuat secara otomatis oleh Sistem Manajemen Bus Yora Trans</p>
        <p>ID Laporan: {{ uniqid() }} | Halaman 1 dari 1</p>
    </div>
</body>
</html>

