<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;

class AirlineController extends Controller
{
    public function index()
    {
        $airlines = Airline::all();
        return view('admin.airlines.index', compact('airlines'));
    }

    public function create()
    {
        return view('admin.airlines.create');
    }

    public function store(Request $request)
    {
        // ✅ Validasi dengan nama kolom yang benar di database
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:5|unique:airlines,kode',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|string'
        ]);

        // ✅ Simpan dengan nama kolom yang benar
        Airline::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'logo' => $request->logo
        ]);

        return redirect()
            ->route('airlines.index')
            ->with('success', 'Maskapai "' . $request->nama . '" berhasil ditambahkan!');
    }

    public function show($id)
    {
        $airline = Airline::findOrFail($id);
        return view('admin.airlines.show', compact('airline'));
    }

    public function edit($id)
    {
        $airline = Airline::findOrFail($id);
        return view('admin.airlines.edit', compact('airline'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:5|unique:airlines,kode,' . $id,
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|string'
        ]);

        $airline = Airline::findOrFail($id);
        $airline->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'logo' => $request->logo
        ]);

        return redirect()
            ->route('airlines.index')
            ->with('success', 'Maskapai "' . $request->nama . '" berhasil diupdate!');
    }

    public function destroy($id)
    {
        $airline = Airline::findOrFail($id);
        $nama = $airline->nama;
        $airline->delete();

        return redirect()
            ->route('airlines.index')
            ->with('success', 'Maskapai "' . $nama . '" berhasil dihapus!');
    }
}