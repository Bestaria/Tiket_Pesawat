<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airline;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with('airline')->get();
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        $airlines = Airline::all();
        return view('admin.flights.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'kode_penerbangan' => 'required|unique:flights',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'jam_tiba' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'status' => 'nullable|in:scheduled,delayed,cancelled,completed'
        ]);

        $data = $request->all();
        $data['sisa_kuota'] = $data['kuota'];

        Flight::create($data);

        return redirect()
            ->route('flights.index')
            ->with('success', 'Penerbangan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $flight = Flight::with('airline')->findOrFail($id);
        return view('admin.flights.show', compact('flight'));
    }

    public function edit($id)
    {
        $flight = Flight::with('airline')->findOrFail($id);
        $airlines = Airline::all();
        return view('admin.flights.edit', compact('flight', 'airlines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'kode_penerbangan' => 'required|unique:flights,kode_penerbangan,' . $id,
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'jam_tiba' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'status' => 'nullable|in:scheduled,delayed,cancelled,completed'
        ]);

        $flight = Flight::findOrFail($id);
        $flight->update($request->all());

        return redirect()
            ->route('flights.index')
            ->with('success', 'Penerbangan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return redirect()
            ->route('flights.index')
            ->with('success', 'Penerbangan berhasil dihapus!');
    }
}