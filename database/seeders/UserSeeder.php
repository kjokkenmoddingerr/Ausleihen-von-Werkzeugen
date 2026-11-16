<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Yessa',
                'email' => 'yessa@gmail.com',
                'password' => bcrypt('admin123#'),
                'role' => 'admin',
            ],
            [
                'name' => 'Qoiry',
                'email' => 'qoiry@gmail.com',
                'password' => bcrypt('petugas123#'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Reyhan',
                'email' => 'reyhan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Fianda',
                'email' => 'fianda@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Rafli',
                'email' => 'rafli@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Rohman',
                'email' => 'rohman@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Zhafif',
                'email' => 'zhafif@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Wirayudha',
                'email' => 'wirayudha@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],

        ]);
    }
}
