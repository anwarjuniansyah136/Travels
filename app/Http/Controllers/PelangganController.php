<?php

namespace App\Http\Controllers;

use App\Models\Admin\BusType;
use App\Models\Bus; // atau BusType kalau datanya dari situ
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $bus = BusType::all();
        return view('pelanggan.home', compact('bus'));
    }

    public function detailBus($id)
    {
        $bus = BusType::findOrFail($id);
        return view('pelanggan.detail-bus', compact('bus'));
    }
}
