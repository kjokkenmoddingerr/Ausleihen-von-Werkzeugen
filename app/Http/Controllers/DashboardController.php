<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'admin') {
            // admin: ringkasan data master
            $data['total_user'] = User::count();
            $data['total_kategori'] = Kategori::count();
            $data['total_alat'] = Alat::sum('stok');
            $data['total_peminjaman'] = Peminjaman::count();
        } elseif ($user->role === 'petugas') {
            // petugas: ringkasan pekerjaan transaksi
            $data['total_menunggu'] = Peminjaman::where('status', 'menunggu')->count();
            $data['total_dipinjam'] = Peminjaman::where('status', 'disetujui')->sum('jumlah');
            $data['total_dikembalikan'] = Peminjaman::where('status', 'dikembalikan')->count();
            $data['total_terlambat'] = Peminjaman::where('status', 'disetujui')
                ->whereDate('batas_kembali', '<', now()->toDateString())
                ->count();
        } else {
            // peminjam: semua angka hanya milik dirinya sendiri
            $data['total_menunggu'] = Peminjaman::where('id_user', $user->id)->where('status', 'menunggu')->count();
            $data['total_dipinjam'] = Peminjaman::where('id_user', $user->id)->where('status', 'disetujui')->sum('jumlah');
            $data['total_dikembalikan'] = Peminjaman::where('id_user', $user->id)->where('status', 'dikembalikan')->count();
            $data['total_denda'] = Pengembalian::whereHas('peminjaman', fn ($q) => $q->where('id_user', $user->id))
                ->sum('denda');
        }

        // 5 history terakhir: peminjam hanya melihat miliknya sendiri
        $data['riwayat_peminjaman'] = Peminjaman::with('user', 'alat')
            ->when($user->role === 'peminjam', fn ($q) => $q->where('id_user', $user->id))
            ->latest()
            ->limit(5)
            ->get();

        $data['riwayat_pengembalian'] = Pengembalian::with('peminjaman.user', 'peminjaman.alat')
            ->when($user->role === 'peminjam', function ($q) use ($user) {
                $q->whereHas('peminjaman', fn ($p) => $p->where('id_user', $user->id));
            })
            ->latest()
            ->limit(5)
            ->get();

        return view('home.dashboard', $data);
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
