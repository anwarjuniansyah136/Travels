@extends('home')
@section('title', 'Dashboard')

@section('content')
<style>
  body {
    background: #f4f6fa;
    font-family: 'Poppins', sans-serif;
  }

  .dashboard-header {
    font-size: 28px;
    font-weight: 600;
    color: #343a40;
    margin-bottom: 20px;
  }

  .btn-generate {
    background-color: #dc3545;
    color: white;
    border-radius: 8px;
    padding: 10px 20px;
    border: none;
    transition: background 0.3s ease;
  }

  .btn-generate:hover {
    background-color: #c82333;
  }

  .card-dashboard {
    border: none;
    border-radius: 1rem;
    padding: 1.5rem;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
  }

  .card-dashboard:hover {
    transform: translateY(-5px);
  }

  .card-icon {
    font-size: 36px;
    color: #4e73df;
  }

  .table-custom {
    border: none;
    border-radius: .5rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    margin-bottom: 1.5rem;
  }

  .table-custom thead {
    background: #eef2f7;
  }

  .text-muted {
    font-size: 14px;
  }

  .card-header {
    border-radius: 1rem 1rem 0 0 !important;
  }

  .card-body canvas {
    max-height: 300px;
  }

  .chart-container {
    position: relative;
    height: 300px;
    width: 100%;
  }

</style>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="dashboard-header">Dashboard</h1>
    <button id="generateReportBtn" class="btn btn-generate shadow">
      <i class="fas fa-file-download me-1"></i> Buat Laporan
    </button>
  </div>

  <!-- Success/Error Messages -->
  <div id="reportMessage" class="alert" style="display: none;"></div>


  <div class="row mb-5 gx-4">
    {{-- <div class="col-md-6 col-lg-3 mb-4">
      <div class="card-dashboard h-100 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-uppercase text-muted">Data Jadwal Bus</small>
          <h3 class="mb-0 fw-bold">{{ $totalSchedule }}</h3>
        </div>
        <i class="fas fa-calendar-alt card-icon"></i>
      </div>
    </div> --}}

    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card-dashboard h-100 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-uppercase text-muted">Data Bus</small>
          <h3 class="mb-0 fw-bold">{{ $totalBus }}</h3>
        </div>
        <i class="fas fa-users card-icon"></i>
      </div>
    </div>

  </div>

  <div class="row mb-5 gx-4">
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card-dashboard h-100 d-flex justify-content-between align-items-center">
        <div>
          <small class="text-uppercase text-muted">Data Reservasi</small>
          <h3 class="mb-0 fw-bold">{{ $totalReservation }}</h3>
        </div>
        <i class="fas fa-calendar-check card-icon"></i>
      </div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="row mb-5 gx-4">
    <div class="col-lg-6 mb-4">
      <div class="card-dashboard">
        <div class="card-header bg-primary text-white py-3">
          <h6 class="m-0 font-weight-bold">Bus Types Distribution</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="busTypesChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
      <div class="card-dashboard">
        <div class="card-header bg-success text-white py-3">
          <h6 class="m-0 font-weight-bold">Reservation Status</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="reservationStatusChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-5 gx-4">
    <div class="col-lg-8 mb-4">
      <div class="card-dashboard">
        <div class="card-header bg-info text-white py-3">
          <h6 class="m-0 font-weight-bold">Monthly Revenue Trend</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="revenueChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 mb-4">
      <div class="card-dashboard">
        <div class="card-header bg-warning text-white py-3">
          <h6 class="m-0 font-weight-bold">Schedule Capacity</h6>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <canvas id="capacityChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#generateReportBtn').click(function() {
        var btn = $(this);
        var originalText = btn.html();
        
        // Show loading state
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Membuat...');
        
        // Hide any previous messages
        $('#reportMessage').hide();
        
        $.ajax({
            url: '{{ route("dashboard.generate-report") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                type: 'monthly'
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    $('#reportMessage')
                        .removeClass('alert-danger')
                        .addClass('alert-success')
                        .html('<strong>Berhasil!</strong> ' + response.message + 
                              ' <a href="' + response.download_url + '" class="btn btn-sm btn-outline-success ms-2" download>' +
                              '<i class="fas fa-download me-1"></i>Unduh PDF</a>')
                        .show();
                    
                    // Auto-hide after 10 seconds
                    setTimeout(function() {
                        $('#reportMessage').fadeOut();
                    }, 10000);
                } else {
                    throw new Error(response.message);
                }
            },
            error: function(xhr) {
                var errorMessage = 'Terjadi kesalahan saat membuat laporan.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                $('#reportMessage')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html('<strong>Error!</strong> ' + errorMessage)
                    .show();
            },
            complete: function() {
                // Restore button state
                btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Initialize Charts
    initializeCharts();
});

function initializeCharts() {
    // Bus Types Distribution Chart (Doughnut)
    const busTypesCtx = document.getElementById('busTypesChart').getContext('2d');
    new Chart(busTypesCtx, {
        type: 'doughnut',
        data: {
            labels: [
                @foreach($busTypes as $bus)
                    '{{ $bus->type }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($busTypes as $bus)
                        {{ $bus->schedules_count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Reservation Status Chart (Pie)
    const reservationStatusCtx = document.getElementById('reservationStatusChart').getContext('2d');
    new Chart(reservationStatusCtx, {
        type: 'pie',
        data: {
            labels: [
                @foreach($reservationsByStatus as $status)
                    '{{ ucfirst($status->payment_status) }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($reservationsByStatus as $status)
                        {{ $status->count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#28a745',
                    '#ffc107',
                    '#dc3545',
                    '#17a2b8',
                    '#6f42c1'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Monthly Revenue Trend Chart (Line)
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: [
                @foreach($monthlyRevenue as $revenue)
                    '{{ $revenue->day }}',
                @endforeach
            ],
            datasets: [{
                label: 'Daily Revenue (Rp)',
                data: [
                    @foreach($monthlyRevenue as $revenue)
                        {{ $revenue->revenue }},
                    @endforeach
                ],
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#17a2b8',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    // Schedule Capacity Chart (Bar)
    const capacityCtx = document.getElementById('capacityChart').getContext('2d');
    new Chart(capacityCtx, {
        type: 'bar',
        data: {
            labels: ['Total Capacity', 'Reserved', 'Available'],
            datasets: [{
                label: 'Seats',
                data: [
                    {{ $totalSeatCapacity }},
                    {{ $totalReservedSeats }},
                    {{ $reservationCapacity }}
                ],
                backgroundColor: [
                    '#6c757d',
                    '#dc3545',
                    '#28a745'
                ],
                borderWidth: 1,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}
</script>
