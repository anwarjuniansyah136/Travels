<?php

namespace App\Http\Controllers\Admin;

use App\Models\BusType;
use App\Models\Admin\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Schedule::with('BusType');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_pol', 'LIKE', "%{$search}%")
                    ->orWhere('bus_code', 'LIKE', "%{$search}%")
                    ->orWhere('initial_route', 'LIKE', "%{$search}%")
                    ->orWhere('destination_route', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->paginate(10);
        return view('Admin.schedule', compact('data'));
    }

    /**
     * Search schedules
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.create_schedule');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pol' => 'required',
            'bus_code' => 'required',
            'bus_type_id' => 'required',
            'initial_route' => 'required',
            'destination_route' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'seat_total' => 'required',
            'unit_available' => 'required',
            'unit_quota' => 'required',
        ]);

        $jadwal = new Schedule();
        $jadwal->no_pol = $request->no_pol;
        $jadwal->bus_code = $request->bus_code;
        $jadwal->bus_type_id = $request->bus_type_id;
        $jadwal->initial_route = $request->initial_route;
        $jadwal->destination_route = $request->destination_route;
        $jadwal->departure_time = $request->departure_time;
        $jadwal->arrival_time = $request->arrival_time;
        $jadwal->seat_total = $request->seat_total;
        $jadwal->unit_available = $request->unit_available;
        $jadwal->unit_quota = $request->unit_quota;
        $jadwal->save();

        return redirect()->route('schedule')->with('success', 'Data Jadwal berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::with('BusType')->find($id);
        return $schedule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::with('BusType')->findOrFail($id);
        return view('admin.edit_schedule', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_pol' => 'required',
            'bus_code' => 'required',
            'bus_type_id' => 'required',
            'initial_route' => 'required',
            'destination_route' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'seat_total' => 'required|integer',
            'unit_available' => 'required|integer',
            'unit_quota' => 'required|integer',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->no_pol = $request->no_pol;
        $schedule->bus_code = $request->bus_code;
        $schedule->bus_type_id = $request->bus_type_id;
        $schedule->initial_route = $request->initial_route;
        $schedule->destination_route = $request->destination_route;
        $schedule->departure_time = $request->departure_time;
        $schedule->arrival_time = $request->arrival_time;
        $schedule->seat_total = $request->seat_total;
        $schedule->unit_available = $request->unit_available;
        $schedule->save();
        return redirect('/schedule')->with('success', 'Data Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return back()->with('success', 'Data Jadwal berhasil dihapus');
    }
}
