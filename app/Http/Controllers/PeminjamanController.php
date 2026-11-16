<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\LogAktivitas;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // peminjam hanya melihat data miliknya sendiri
        $peminjaman = Peminjaman::with('user', 'alat')
            ->when($user->role === 'peminjam', fn ($q) => $q->where('id_user', $user->id))
            ->latest()
            ->limit(500)
            ->get();

        return view('home.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // hanya alat yang stoknya masih ada
        $alat = Alat::where('stok', '>', 0)->orderBy('nama_alat')->get();

        return view('home.peminjaman.create', compact('alat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_alat' => ['required', Rule::exists(Alat::class, 'id')],
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'batas_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->id_alat);

        // cek stok saat pengajuan (stok baru berkurang setelah disetujui petugas)
        if ($request->jumlah > $alat->stok) {
            return back()->withInput()->with('error', 'Jumlah melebihi stok. Stok tersedia: ' . $alat->stok);
        }

        $peminjaman = Peminjaman::create([
            'id_user' => Auth::id(),
            'id_alat' => $alat->id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'batas_kembali' => $request->batas_kembali,
            'status' => 'menunggu',
        ]);

        LogAktivitas::catat('Mengajukan peminjaman ' . $alat->nama_alat . ' (#' . $peminjaman->id . ')');

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim');
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
     * Setujui peminjaman (petugas).
     */
    public function setujui(string $id)
    {
        $hasil = DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::with('alat')->lockForUpdate()->findOrFail($id);

            if ($peminjaman->status !== 'menunggu') {
                return 'Peminjaman ini sudah diproses';
            }

            // stok dicek ulang karena bisa berubah sejak pengajuan
            if ($peminjaman->jumlah > $peminjaman->alat->stok) {
                return 'Stok tidak cukup. Stok tersedia: ' . $peminjaman->alat->stok;
            }

            $peminjaman->alat->decrement('stok', $peminjaman->jumlah);

            $peminjaman->update([
                'status' => 'disetujui',
                'id_petugas' => Auth::id(),
            ]);

            LogAktivitas::catat('Menyetujui peminjaman #' . $peminjaman->id);

            return true;
        });

        if ($hasil !== true) {
            return redirect()->route('peminjaman.index')->with('error', $hasil);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui');
    }

    /**
     * Tolak peminjaman (petugas).
     */
    public function tolak(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'menunggu') {
            return redirect()->route('peminjaman.index')->with('error', 'Peminjaman ini sudah diproses');
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'id_petugas' => Auth::id(),
        ]);

        LogAktivitas::catat('Menolak peminjaman #' . $peminjaman->id);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman ditolak');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // yang sedang dipinjam tidak boleh dihapus karena stok alat sedang berkurang
        if ($peminjaman->status === 'disetujui') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman yang masih berjalan tidak bisa dihapus');
        }

        $peminjaman->delete();

        LogAktivitas::catat('Menghapus data peminjaman #' . $id);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
