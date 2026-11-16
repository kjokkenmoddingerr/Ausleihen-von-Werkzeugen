<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    /**
     * 5 peminjaman yang belum dikembalikan (menunggu, disetujui, ditolak).
     * Angka 'pinjam' dan 'batas' = selisih hari dari hari ini (negatif = sudah lewat).
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
                'email' => 'reyhan@gmail.com',
                'alat' => 7,
                'jumlah' => 1,
                'pinjam' => -1,
                'batas' => 6,
                'status' => 'menunggu'
            ],

            [
                'email' => 'fianda@gmail.com',
                'alat' => 5,
                'jumlah' => 3,
                'pinjam' => -2,
                'batas' => 5,
                'status' => 'menunggu'
            ],

            [
                'email' => 'zhafif@gmail.com',
                'alat' => 44,
                'jumlah' => 10,
                'pinjam' => -3,
                'batas' => 4,
                'status' => 'ditolak'
            ],

            [
                'email' => 'rohman@gmail.com',
                'alat' => 10,
                'jumlah' => 2,
                'pinjam' => -10,
                'batas' => -3,
                'status' => 'disetujui'
            ],

            [
                'email' => 'rafli@gmail.com',
                'alat' => 31,
                'jumlah' => 7,
                'pinjam' => -4,
                'batas' => 3,
                'status' => 'disetujui'
            ],
        ];

        foreach ($data as $d) {
            $idAlat = $alat[$d['alat'] % $alat->count()];
            $waktuPinjam = now()->addDays($d['pinjam']);

            (new Peminjaman())->forceFill([
                'id_user' => User::where('email', $d['email'])->value('id'),
                'id_alat' => $idAlat,
                'id_petugas' => $d['status'] === 'menunggu' ? null : $petugas,
                'jumlah' => $d['jumlah'],
                'tanggal_pinjam' => $waktuPinjam->toDateString(),
                'batas_kembali' => now()->addDays($d['batas'])->toDateString(),
                'status' => $d['status'],
                'created_at' => $waktuPinjam,
                'updated_at' => $waktuPinjam,
            ])->save();

            // stok berkurang saat disetujui, sama seperti alur di aplikasi
            if ($d['status'] === 'disetujui') {
                Alat::where('id', $idAlat)->decrement('stok', $d['jumlah']);
            }
        }
    }
}
