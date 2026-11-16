<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alats')->insert([
            // Kategori 1: Elektronik
            [
                'nama_alat' => 'Laptop',
                'id_kategori' => 1,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Proyektor',
                'id_kategori' => 1,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Speaker',
                'id_kategori' => 1,
                'stok' => 12,
            ],
            [
                'nama_alat' => 'Monitor',
                'id_kategori' => 1,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Keyboard',
                'id_kategori' => 1,
                'stok' => 15,
            ],
            [
                'nama_alat' => 'Mouse',
                'id_kategori' => 1,
                'stok' => 20,
            ],
            [
                'nama_alat' => 'Printer',
                'id_kategori' => 1,
                'stok' => 5,
            ],

            // Kategori 2: Peralatan Olahraga
            [
                'nama_alat' => 'Bola Sepak',
                'id_kategori' => 2,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Bola Basket',
                'id_kategori' => 2,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Bola Voli',
                'id_kategori' => 2,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Raket Bulu Tangkis',
                'id_kategori' => 2,
                'stok' => 12,
            ],
            [
                'nama_alat' => 'Shuttlecock',
                'id_kategori' => 2,
                'stok' => 30,
            ],
            [
                'nama_alat' => 'Net Voli',
                'id_kategori' => 2,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Matras Olahraga',
                'id_kategori' => 2,
                'stok' => 10,
            ],

            // Kategori 3: Peralatan Laboratorium
            [
                'nama_alat' => 'Mikroskop',
                'id_kategori' => 3,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Gelas Ukur',
                'id_kategori' => 3,
                'stok' => 15,
            ],
            [
                'nama_alat' => 'Tabung Reaksi',
                'id_kategori' => 3,
                'stok' => 30,
            ],
            [
                'nama_alat' => 'Gelas Kimia',
                'id_kategori' => 3,
                'stok' => 20,
            ],
            [
                'nama_alat' => 'Termometer Laboratorium',
                'id_kategori' => 3,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Neraca Digital',
                'id_kategori' => 3,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Cawan Petri',
                'id_kategori' => 3,
                'stok' => 20,
            ],

            // Kategori 4: Peralatan Musik
            [
                'nama_alat' => 'Gitar Akustik',
                'id_kategori' => 4,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Keyboard Musik',
                'id_kategori' => 4,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Drum',
                'id_kategori' => 4,
                'stok' => 2,
            ],
            [
                'nama_alat' => 'Rekorder',
                'id_kategori' => 4,
                'stok' => 15,
            ],
            [
                'nama_alat' => 'Tamborin',
                'id_kategori' => 4,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Marakas',
                'id_kategori' => 4,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Mikrofon',
                'id_kategori' => 4,
                'stok' => 8,
            ],

            // Kategori 5: Peralatan Dapur
            [
                'nama_alat' => 'Kompor Gas',
                'id_kategori' => 5,
                'stok' => 3,
            ],
            [
                'nama_alat' => 'Panci',
                'id_kategori' => 5,
                'stok' => 20,
            ],
            [
                'nama_alat' => 'Wajan',
                'id_kategori' => 5,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Pisau Dapur',
                'id_kategori' => 5,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Talenan',
                'id_kategori' => 5,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Blender',
                'id_kategori' => 5,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Timbangan Dapur',
                'id_kategori' => 5,
                'stok' => 5,
            ],

            // Kategori 6: Peralatan Kebersihan
            [
                'nama_alat' => 'Sapu Lantai',
                'id_kategori' => 6,
                'stok' => 15,
            ],
            [
                'nama_alat' => 'Alat Pel',
                'id_kategori' => 6,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Ember',
                'id_kategori' => 6,
                'stok' => 12,
            ],
            [
                'nama_alat' => 'Pengki',
                'id_kategori' => 6,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Kemoceng',
                'id_kategori' => 6,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Sikat Lantai',
                'id_kategori' => 6,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Tempat Sampah',
                'id_kategori' => 6,
                'stok' => 15,
            ],

            // Kategori 7: Peralatan Fotografi
            [
                'nama_alat' => 'Kamera DSLR',
                'id_kategori' => 7,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Tripod',
                'id_kategori' => 7,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Kamera Mirrorless',
                'id_kategori' => 7,
                'stok' => 3,
            ],
            [
                'nama_alat' => 'Lensa Kamera',
                'id_kategori' => 7,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Lampu Ring Light',
                'id_kategori' => 7,
                'stok' => 6,
            ],
            [
                'nama_alat' => 'Flash Kamera',
                'id_kategori' => 7,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Tas Kamera',
                'id_kategori' => 7,
                'stok' => 5,
            ],

            // Kategori 8: Peralatan Kesehatan
            [
                'nama_alat' => 'Termometer Digital',
                'id_kategori' => 8,
                'stok' => 10,
            ],
            [
                'nama_alat' => 'Tensimeter',
                'id_kategori' => 8,
                'stok' => 4,
            ],
            [
                'nama_alat' => 'Stetoskop',
                'id_kategori' => 8,
                'stok' => 5,
            ],
            [
                'nama_alat' => 'Timbangan Badan',
                'id_kategori' => 8,
                'stok' => 3,
            ],
            [
                'nama_alat' => 'Kotak P3K',
                'id_kategori' => 8,
                'stok' => 8,
            ],
            [
                'nama_alat' => 'Kursi Roda',
                'id_kategori' => 8,
                'stok' => 2,
            ],
            [
                'nama_alat' => 'Tongkat Bantu Jalan',
                'id_kategori' => 8,
                'stok' => 3,
            ],
        ]);
    }
}
