<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Login dan logout (di luar grup auth)
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('/logout', [LoginController::class, 'actionLogout'])->name('actionLogout');

// Semua halaman di bawah ini wajib login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // ===== Semua role: admin, petugas, peminjam =====
    Route::get('/alat', [AlatController::class, 'index'])->name('alat.index');
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

    // ===== Admin saja =====
    Route::middleware('role:admin')->group(function () {
        // User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/simpan', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/hapus/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/simpan', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Alat (tambah, edit, hapus)
        Route::get('/alat/tambah', [AlatController::class, 'create'])->name('alat.create');
        Route::post('/alat/simpan', [AlatController::class, 'store'])->name('alat.store');
        Route::get('/alat/edit/{id}', [AlatController::class, 'edit'])->name('alat.edit');
        Route::post('/alat/update/{id}', [AlatController::class, 'update'])->name('alat.update');
        Route::get('/alat/hapus/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');

        // Hapus data peminjaman dan log aktivitas
        Route::get('/peminjaman/hapus/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log.index');
    });

    // ===== Petugas saja =====
    Route::middleware('role:petugas')->group(function () {
        Route::post('/peminjaman/setujui/{id}', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
        Route::post('/peminjaman/tolak/{id}', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // ===== Peminjam saja =====
    Route::middleware('role:peminjam')->group(function () {
        Route::get('/peminjaman/ajukan', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman/simpan', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::post('/pengembalian/kembalikan/{id}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });
});
