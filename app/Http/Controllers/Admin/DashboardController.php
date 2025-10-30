<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Admin\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Admin\BusType;
use App\Models\Admin\CustomerData;
use App\Models\Admin\Roles;
use App\Models\Admin\Schedule;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Basic counts
        $totalCustomer = CustomerData::count();
        $totalReservation = Reservation::count();
        $totalBus = BusType::count();
        $totalSchedule = Schedule::count();
        $totalRoles = Roles::count();

        // Bus data statistics
        $busTypes = BusType::select('type', 'seat_capacity', 'price')
            ->withCount(['schedules' => function ($query) {
                $query->where('unit_available', '>', 0);
            }])
            ->get();

        $totalSeatCapacity = BusType::sum('seat_capacity');
        $averagePrice = BusType::avg('price');

        // Customer data statistics
        $recentCustomers = CustomerData::latest('created_at')->take(5)->get();

        // Reservation capacity and statistics
        $totalReservedSeats = Reservation::sum('number_of_seats');
        $reservationCapacity = $totalSeatCapacity - $totalReservedSeats;
        $reservationPercentage = $totalSeatCapacity > 0 ? round(($totalReservedSeats / $totalSeatCapacity) * 100, 2) : 0;

        $recentReservations = Reservation::with('user')
            ->latest('created_at')
            ->take(5)
            ->get();

        $reservationsByStatus = Reservation::selectRaw('payment_status, COUNT(*) as count')
            ->groupBy('payment_status')
            ->get();

        // Schedule statistics
        $activeSchedules = Schedule::where('unit_available', '>', 0)->count();

        // Revenue statistics
        $totalRevenue = Reservation::where('payment_status', 'paid')->sum('payment');
        $monthlyRevenue = Reservation::selectRaw('DAY(payment_date) as day, SUM(payment) as revenue')
            ->where('payment_status', 'paid')
            ->whereMonth('payment_date', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Top routes
        $topRoutes = Schedule::selectRaw('initial_route, destination_route, COUNT(*) as schedule_count')
            ->groupBy('initial_route', 'destination_route')
            ->orderByDesc('schedule_count')
            ->take(5)
            ->get();

        // Bus utilization
        $busUtilization = BusType::withCount(['schedules' => function ($query) {
            $query->where('unit_available', '>', 0);
        }])
            ->withCount(['schedules' => function ($query) {
                $query->where('unit_available', '=', 0);
            }])
            ->get()
            ->map(function ($bus) {
                $totalSchedules = $bus->schedules_count + $bus->schedules_count;
                $utilization = $totalSchedules > 0 ? round(($bus->schedules_count / $totalSchedules) * 100, 2) : 0;

                return [
                    'type' => $bus->type,
                    'utilization' => $utilization,
                    'active_schedules' => $bus->schedules_count,
                    'total_schedules' => $totalSchedules,
                ];
            });

        return view('Admin.dashboard', compact(
            'totalCustomer',
            'totalReservation',
            'totalBus',
            'totalSchedule',
            'totalRoles',
            'busTypes',
            'totalSeatCapacity',
            'averagePrice',
            'recentCustomers',
            'totalReservedSeats',
            'reservationCapacity',
            'reservationPercentage',
            'recentReservations',
            'reservationsByStatus',
            'activeSchedules',
            'totalRevenue',
            'monthlyRevenue',
            'topRoutes',
            'busUtilization'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $dashboard = Dashboard::find($id);
        // return $dashboard;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Generate comprehensive dashboard report
     *
     * @return \Illuminate\Http\Response
     */
    public function generateReport(Request $request)
    {
        try {
            $reportType = $request->get('type', 'monthly');

            // Ambil bulan dan tahun dari request, default ke bulan ini
            $month = $request->get('month', Carbon::now()->month);
            $year = $request->get('year', Carbon::now()->year);

            $dateFrom = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $dateTo = Carbon::createFromDate($year, $month, 1)->endOfMonth();

            $totalCustomer = CustomerData::whereBetween('created_at', [$dateFrom, $dateTo])->count();
            $totalReservation = Reservation::whereBetween('created_at', [$dateFrom, $dateTo])->count();
            $totalBus = BusType::count();
            $totalSchedule = Schedule::whereBetween('created_at', [$dateFrom, $dateTo])->count();

            $busTypes = BusType::select('type', 'seat_capacity', 'price')
                ->withCount(['schedules' => function ($query) use ($dateFrom, $dateTo) {
                    $query->whereBetween('created_at', [$dateFrom, $dateTo])
                        ->where('unit_available', '>', 0);
                }])->get();

            $totalSeatCapacity = BusType::sum('seat_capacity');
            $averagePrice = BusType::avg('price');

            $customersByMonth = CustomerData::selectRaw('DAY(created_at) as day, COUNT(*) as count')
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $totalReservedSeats = Reservation::whereBetween('created_at', [$dateFrom, $dateTo])->sum('number_of_seats');
            $reservationCapacity = $totalSeatCapacity - $totalReservedSeats;
            $reservationPercentage = $totalSeatCapacity > 0 ? round(($totalReservedSeats / $totalSeatCapacity) * 100, 2) : 0;

            $reservationsByStatus = Reservation::selectRaw('payment_status, COUNT(*) as count')
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->groupBy('payment_status')
                ->get();

            $activeSchedules = Schedule::whereBetween('created_at', [$dateFrom, $dateTo])
                ->where('unit_available', '>', 0)
                ->count();

            $totalRoutes = Schedule::selectRaw('COUNT(DISTINCT CONCAT(initial_route, "-", destination_route)) as route_count')
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->first();

            $totalRevenue = Reservation::where('payment_status', 'paid')
                ->whereBetween('payment_date', [$dateFrom, $dateTo])
                ->sum('payment');

            $monthlyRevenue = Reservation::selectRaw('DAY(payment_date) as day, SUM(payment) as revenue')
                ->where('payment_status', 'paid')
                ->whereBetween('payment_date', [$dateFrom, $dateTo])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            $topRoutes = Schedule::selectRaw('initial_route, destination_route, COUNT(*) as schedule_count')
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->groupBy('initial_route', 'destination_route')
                ->orderByDesc('schedule_count')
                ->take(10)
                ->get();

            $recentCustomers = CustomerData::whereBetween('created_at', [$dateFrom, $dateTo])
                ->latest('created_at')->take(10)->get();

            $recentReservations = Reservation::with('user')
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->latest('created_at')
                ->take(10)
                ->get();

            // Generate PDF
            $pdf = PDF::loadView('reports.monthly', compact(
                'reportType',
                'dateFrom',
                'dateTo',
                'totalCustomer',
                'totalReservation',
                'totalBus',
                'totalSchedule',
                'busTypes',
                'totalSeatCapacity',
                'averagePrice',
                'customersByMonth',
                'totalReservedSeats',
                'reservationCapacity',
                'reservationPercentage',
                'reservationsByStatus',
                'activeSchedules',
                'totalRoutes',
                'totalRevenue',
                'monthlyRevenue',
                'topRoutes',
                'recentCustomers',
                'recentReservations'
            ));

            $monthNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
            ];

            $monthName = $monthNames[$month];
            $filename = 'Laporan-Bulanan-'.$monthName.'-'.$year.'.pdf';
            $filepath = $filename;

            $pdf->save(storage_path($filepath));

            return response()->json([
                'success' => true,
                'message' => 'Laporan bulanan berhasil dibuat!',
                'download_url' => asset('storage/'.$filename),
                'filename' => $filename,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat laporan: '.$e->getMessage(),
            ], 500);
        }
    }
}

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        // Tentukan rentang waktu laporan
        $dateFrom = Carbon::parse($request->get('from', Carbon::now()->startOfMonth()));
        $dateTo = Carbon::parse($request->get('to', Carbon::now()->endOfMonth()));
        $totalReservation = Reservation::whereBetween('created_at', [$dateFrom, $dateTo])->count();

        // Data dasar
        $totalBus = BusType::count();

        $totalReservation = Reservation::whereBetween('reservation_date', [$dateFrom, $dateTo])->count();
        $totalRevenue = Reservation::where('payment_status', 'paid')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('payment');

        // Ambil semua bus
        $buses = BusType::all();

        //Ambil Semua Data Reservasi
        $reservasi = Reservation::all();

        return view('reports.monthly', compact(
            'dateFrom',
            'dateTo',
            'totalBus',
            'totalReservation',
            'totalRevenue',
            'buses'
        ));
    }
    // public function index(Request request)
}