<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $query = Reservation::query();

        if (request()->filled('search')) { // <-- pakai helper global
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('nomor_telepon', 'like', "%$search%");
            });

        }

        $data = $query->orderBy('reservation_date', 'desc')->paginate(10);
        
        return view('admin.reservation', compact('data'));
    }

    public function show($id)
    {
        $reservation = Reservation::with('user')->findOrFail($id);

        return view('admin.reservation.show', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.reservation.index')->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
