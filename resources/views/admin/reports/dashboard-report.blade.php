<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Dashboard Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .summary-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .summary-card h3 {
            margin: 0 0 10px 0;
            color: #495057;
            font-size: 14px;
            text-transform: uppercase;
        }
        .summary-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            margin: 0;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #007bff;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #dee2e6;
            padding-top: 20px;
        }
        .date-range {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Monthly Dashboard Report</h1>
        <p>Bus Management System</p>
        <p>Generated on: {{ date('F d, Y H:i:s') }}</p>
    </div>

    <div class="date-range">
        <strong>Report Period:</strong> {{ $dateFrom->format('F d, Y') }} - {{ $dateTo->format('F d, Y') }}
    </div>

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card">
            <h3>Total Buses</h3>
            <p class="number">{{ $totalBus }}</p>
        </div>
        <div class="summary-card">
            <h3>Bus Schedules</h3>
            <p class="number">{{ $totalSchedule }}</p>
        </div>
        <div class="summary-card">
            <h3>Reservations</h3>
            <p class="number">{{ $totalReservation }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Revenue</h3>
            <p class="number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Bus Types Section -->
    <div class="section">
        <h2>Bus Types Overview</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Bus Type</th>
                    <th>Seat Capacity</th>
                    <th>Price</th>
                    <th>Active Schedules</th>
                </tr>
            </thead>
            <tbody>
                @foreach($busTypes as $bus)
                <tr>
                    <td>{{ $bus->type }}</td>
                    <td>{{ $bus->seat_capacity }}</td>
                    <td>Rp {{ number_format($bus->price, 0, ',', '.') }}</td>
                    <td>{{ $bus->schedules_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Reservation Statistics -->
    <div class="section">
        <h2>Reservation Statistics</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Payment Status</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservationsByStatus as $status)
                <tr>
                    <td>{{ ucfirst($status->payment_status) }}</td>
                    <td>{{ $status->count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Top Routes -->
    <div class="section">
        <h2>Top Routes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Schedule Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topRoutes as $route)
                <tr>
                    <td>{{ $route->initial_route }}</td>
                    <td>{{ $route->destination_route }}</td>
                    <td>{{ $route->schedule_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Monthly Revenue -->
    @if($monthlyRevenue->count() > 0)
    <div class="section">
        <h2>Monthly Revenue ({{ date('Y') }})</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyRevenue as $revenue)
                <tr>
                    <td>{{ date('F', mktime(0, 0, 0, $revenue->month, 1)) }}</td>
                    <td>Rp {{ number_format($revenue->revenue, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>This report was automatically generated by the Bus Management System</p>
        <p>Report ID: {{ uniqid() }}</p>
    </div>
</body>
</html>

