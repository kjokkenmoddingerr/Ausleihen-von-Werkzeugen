<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dari   = $request->input('dari');
        $sampai = $request->input('sampai');

        $query = Peminjaman::with(['user', 'alat', 'pengembalian'])
            ->orderBy('tanggal_pinjam', 'desc');

        if ($dari) {
            $query->whereDate('tanggal_pinjam', '>=', $dari);
        }
        if ($sampai) {
            $query->whereDate('tanggal_pinjam', '<=', $sampai);
        }

        $laporan = $query->get();

        return view('laporan.index', compact('laporan', 'dari', 'sampai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
