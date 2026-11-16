<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Alat;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = Alat::with('kategori')->latest()->get();
        return view('home.alat.index', compact('alat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('home.alat.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
        ]);

        Alat::create([
            'nama_alat' => $request->nama_alat,
            'id_kategori' => $request->id_kategori,
            'stok' => $request->stok,
        ]);

        return redirect()->route('alat.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();
        return view('home.alat.edit', compact('alat', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategori,id',
            'stok' => 'required|integer|min:0',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update([
            'nama_alat' => $request->nama_alat,
            'id_kategori' => $request->id_kategori,
            'stok' => $request->stok,
        ]);

        return redirect()->route('alat.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        if ($alat->peminjaman()->exists()) {
            return redirect()->route('alat.index')->with('error', 'Alat tidak bisa dihapus karena punya riwayat peminjaman');
        }

        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Data berhasil dihapus.');
    }
}
