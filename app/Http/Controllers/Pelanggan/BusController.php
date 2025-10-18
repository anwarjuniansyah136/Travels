<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Admin\BusType;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // 🚌 Menampilkan daftar bus
    public function index(Request $request)
    {
        $query = BusType::query();

        if ($request->filled('tipe_bus')) {
            $query->where('type', $request->tipe_bus);
        }

        $query->where('status_ketersediaan', 'Tersedia');

        $bus = $query->get();

        return view('layout', compact('bus')); // kamu pakai layout.blade.php untuk homepage
    }

    // 🧾 Menampilkan detail bus
    public function show($id)
    {
        $bus = BusType::findOrFail($id);
        return view('pelanggan.detail-bus', compact('bus'));
    }
}
