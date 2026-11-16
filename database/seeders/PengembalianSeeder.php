<?php

namespace Database\Seeders;

use App\Http\Controllers\PengembalianController;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengembalianSeeder extends Seeder
{
    /**
     * 4 data pengembalian, masing-masing dengan peminjaman berstatus dikembalikan.
     * Angka 'pinjam', 'batas', 'kembali' = selisih hari dari hari ini.
     */
    public function run(): void
    {
        $alat = Alat::orderBy('id')->pluck('id')->values();

        if ($alat->isEmpty()) {
            $this->command->warn('Data alat kosong. Jalankan AlatSeeder lebih dulu.');
            return;
        }

        $petugas = User::where('email', 'qoiry@gmail.com')->value('id');

        $data = [

            [
                'email' => 'wirayudha@gmail.com',
                'alat' => 19,
                'jumlah' => 7,
                'pinjam' => -20,
                'batas' => -13,
                'kembali' => -13
            ],

            [
                'email' => 'reyhan@gmail.com',
                'alat' => 34,
                'jumlah' => 13,
                'pinjam' => -18,
                'batas' => -11,
                'kembali' => -9
            ],

            [
                'email' => 'fianda@gmail.com',
                'alat' => 25,
                'jumlah' => 9,
                'pinjam' => -15,
                'batas' => -8,
                'kembali' => -10
            ],

            [
                'email' => 'rafli@gmail.com',
                'alat' => 8,
                'jumlah' => 4,
                'pinjam' => -12,
                'batas' => -7,
                'kembali' => -4
            ],
        ];

        foreach ($data as $d) {
            $waktuPinjam = now()->addDays($d['pinjam']);
            $waktuKembali = now()->addDays($d['kembali']);

            $peminjaman = (new Peminjaman())->forceFill([
                'id_user' => User::where('email', $d['email'])->value('id'),
                'id_alat' => $alat[$d['alat'] % $alat->count()],
                'id_petugas' => $petugas,
                'jumlah' => $d['jumlah'],
                'tanggal_pinjam' => $waktuPinjam->toDateString(),
                'batas_kembali' => now()->addDays($d['batas'])->toDateString(),
                'status' => 'dikembalikan',
                'created_at' => $waktuPinjam,
                'updated_at' => $waktuKembali,
            ]);
            $peminjaman->save();

            // hari terlambat = tanggal kembali - batas kembali (kalau positif)
            $hariTerlambat = max(0, $d['kembali'] - $d['batas']);

            (new Pengembalian())->forceFill([
                'id_peminjaman' => $peminjaman->id,
                'tanggal_kembali' => $waktuKembali->toDateString(),
                'denda' => $hariTerlambat * PengembalianController::DENDA_PER_HARI,
                'keterangan' => $hariTerlambat > 0 ? 'Terlambat ' . $hariTerlambat . ' hari' : 'Tepat waktu',
                'created_at' => $waktuKembali,
                'updated_at' => $waktuKembali,
            ])->save();
        }
    }
}
