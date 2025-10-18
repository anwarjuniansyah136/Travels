<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user')->latest()->get();
        return view('admin.reservation.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);
        return view('admin.reservation.show', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string'
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'payment_status' => $request->payment_status
        ]);

        return redirect()->route('admin.reservation.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
