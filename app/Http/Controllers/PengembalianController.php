<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // denda per hari keterlambatan (rupiah)
    const DENDA_PER_HARI = 5000;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->when($user->role === 'peminjam', function ($q) use ($user) {
                $q->whereHas('peminjaman', fn ($p) => $p->where('id_user', $user->id));
            })
            ->latest()
            ->limit(500)
            ->get();

        return view('home.pengembalian.index', compact('pengembalian'));
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
    public function store(string $id)
    {
        // semua proses di dalam transaction: data dikunci supaya klik ganda tidak lolos dua kali
        $hasil = DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::with('alat')->lockForUpdate()->findOrFail($id);

            // peminjam hanya boleh mengembalikan miliknya sendiri yang berstatus disetujui
            if ((int) $peminjaman->id_user !== (int) Auth::id() || $peminjaman->status !== 'disetujui') {
                return null;
            }

            // hitung denda: hari terlambat x denda per hari
            $hariIni = now()->startOfDay();
            $batas = $peminjaman->batas_kembali->copy()->startOfDay();
            $hariTerlambat = 0;
            if ($hariIni->gt($batas)) {
                $hariTerlambat = (int) $batas->diffInDays($hariIni);
            }
            $denda = $hariTerlambat * self::DENDA_PER_HARI;

            Pengembalian::create([
                'id_peminjaman' => $peminjaman->id,
                'tanggal_kembali' => $hariIni->toDateString(),
                'denda' => $denda,
                'keterangan' => $hariTerlambat > 0 ? 'Terlambat ' . $hariTerlambat . ' hari' : 'Tepat waktu',
            ]);

            // proses penambahan stok alat
            $peminjaman->alat->increment('stok', $peminjaman->jumlah);

            $peminjaman->update(['status' => 'dikembalikan']);

            return ['peminjaman' => $peminjaman, 'denda' => $denda];
        });

        if ($hasil === null) {
            return redirect()->route('peminjaman.index')->with('error', 'Peminjaman ini tidak bisa dikembalikan');
        }

        $peminjaman = $hasil['peminjaman'];
        $denda = $hasil['denda'];

        LogAktivitas::catat('Mengembalikan ' . $peminjaman->alat->nama_alat . ' (#' . $peminjaman->id . ')');

        $pesan = 'Alat berhasil dikembalikan';
        if ($denda > 0) {
            $pesan .= '. Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('peminjaman.index')->with('success', $pesan);
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
