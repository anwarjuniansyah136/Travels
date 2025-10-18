<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BusType;

class PembayaranController extends Controller
{
    public function index()
    {
        // Ambil data bus supaya tidak error di layout
        $bus = BusType::where('status_ketersediaan', 'Tersedia')->get();

        return view('pelanggan.pembayaran', compact('bus'));
    }
}
