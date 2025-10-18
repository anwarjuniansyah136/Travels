<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\BusType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BusType::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('type', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('seat_capacity', 'LIKE', "%{$search}%")
                    ->orWhere('facility', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->paginate(10);
        return view('Admin.bus_type', compact('data'));
    }

    /**
     * Search bus types
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
        return view('admin.create_bus');
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
            'type' => 'required',
            'price' => 'required',
            'facility' => 'required',
            'seat_capacity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // simpan file ke storage/public/images
        $path = $request->file('image')->store('images', 'public');

        // ambil nama file
        $filename = basename($path);

        $bus = new BusType();
        $bus->type = $request->type;
        $bus->price = $request->price;
        $bus->facility = $request->facility;
        $bus->seat_capacity = $request->seat_capacity;
        $bus->status_ketersediaan= $request->status_ketersediaan;
        $bus->image = $filename;
        $bus->save();

        return redirect()->route('bus_type')->with('success', 'Data Bus berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bus_type = BusType::find($id);
        return $bus_type;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bus = BusType::findOrFail($id);
        return view('admin.edit_bus', compact('bus'));
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
            'type' => 'required',
            'price' => 'required',
            'facility' => 'required',
            'seat_capacity' => 'required',
            'status_ketersediaan'=> 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $bus_type = BusType::findOrFail($id);

        $bus_type->type = $request->type;
        $bus_type->price = $request->price;
        $bus_type->facility = $request->facility;
        $bus_type->seat_capacity = $request->seat_capacity;
        $bus_type->status_ketersediaan= $request->status_ketersediaan;

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $bus_type->image = $request->image;
        }

        $bus_type->save();

        return redirect('/bus_type')->with('success', 'Data Bus berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus_type = BusType::findOrFail($id);
        $bus_type->delete();

        return redirect('/bus_type')->with('success', 'Data Bus berhasil dihapus');
    }
}
