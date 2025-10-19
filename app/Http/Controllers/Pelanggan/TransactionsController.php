<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function index()
    {
        $query = Reservation::query();

        $query->where('email', Auth::user()->email)
            ->where('nama_lengkap', Auth::user()->name);

        $keyword = request('search');

        if (! empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_lengkap', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('nomor_telepon', 'like', "%{$keyword}%")
                    ->orWhere('payment_status', 'like', "%{$keyword}%")
                    ->orWhere('payment', 'like', "%{$keyword}%")
                    ->orWhere('reservation_date', 'like', "%{$keyword}%")
                    ->orWhere('reservation_code', 'like', "%{$keyword}%")
                    ->orWhere('number_of_seats', 'like', "%{$keyword}%")
                    ->orWhere('schedule_id', 'like', "%{$keyword}%")
                    ->orWhere('alamat', 'like', "%{$keyword}%")
                    ->orWhere('tujuan', 'like', "%{$keyword}%");
            });
        }

        $reservations = $query->paginate(10);

        return view('pelanggan.transactions', compact('reservations'));

    }

    public function delete($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->payment_status = 'canceled';

        $reservation->save();

        return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
