<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Peralatan Olahraga'],
            ['nama_kategori' => 'Peralatan Laboratorium'],
            ['nama_kategori' => 'Peralatan Musik'],
            ['nama_kategori' => 'Peralatan Dapur'],
            ['nama_kategori' => 'Peralatan Kebersihan'],
            ['nama_kategori' => 'Peralatan Fotografi'],
            ['nama_kategori' => 'Peralatan Kesehatan'],
        ]);
    }
}
