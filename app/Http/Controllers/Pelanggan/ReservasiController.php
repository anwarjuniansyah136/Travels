<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Admin\BusType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->get();

        return view('pelanggan.reservation.index', compact('reservations'));
    }

    public function create()
    {
        $bus = BusType::all();
        $user = Auth::user();
        return view('pelanggan.reservation.create', compact('bus','user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:100',
            'number_of_seats' => 'required|integer|min:1',
            'bus_id' => 'required|exists:bus_type,id', // ini untuk menentukan bus
        ]);
        $bus = BusType::findOrFail($validated['bus_id']);
        $total_harga = $bus->price * $validated['number_of_seats'];
        
        $validated['payment'] = $total_harga;
        $validated['schedule_id'] = rand(1,100);

        // $start = Carbon::parse($request->tanggal_berangkat);
        // $end = Carbon::parse($request->tanggal_pulang);
        // $validated['reservation_duration'] = $start->diffInDays($end) + 1;
        // $reservation->reservation_duration = $start->diffInDays($end) + 1;

        $validated['payment_status'] = 'pending';

        

        $reservation = Reservation::create($validated);

        return redirect()->route('pelanggan.reservation.payment', $reservation->id);
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('pelanggan.reservation.show', compact('reservation'));
    }

    public function transaction($id)
    {
        $reservation = Reservation::findOrFail($id);

        return view('pelanggan.pembayaran', compact('reservation'));
    }

    public function pay($id)
    {
        $reservation = Reservation::findOrFail($id);

        Config::$serverKey = config('mitrands.server_key');
        Config::$isProduction = config('mitrands.is_production');
        Config::$isSanitized = config('mitrands.is_sanitized');
        Config::$is3ds = config('mitrands.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => 'RESV-'.$reservation->id.'-'.time(),
                'gross_amount' => $reservation->payment,
            ],
            'customer_details' => [
                'first_name' => $reservation->nama_lengkap,
                'email' => $reservation->email,
                'phone' => $reservation->nomor_telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pelanggan.payment', compact('reservation', 'snapToken'));
    }
}
