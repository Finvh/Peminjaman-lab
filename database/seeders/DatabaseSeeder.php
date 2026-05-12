<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Users
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'kelas' => null,
                'created_at' => now(),
            ],
            [
                'username' => 'budi',
                'password' => Hash::make('123456'),
                'role' => 'user',
                'kelas' => '12 IPA 1',
                'created_at' => now(),
            ],
            [
                'username' => 'siti',
                'password' => Hash::make('123456'),
                'role' => 'user',
                'kelas' => '12 IPS 2',
                'created_at' => now(),
            ],
        ]);

        // Barang
        DB::table('barang')->insert([
            [
                'nama_barang' => 'Mikroskop',
                'jumlah_barang' => 10,
                'foto' => 'mikroskop.jpg',
                'deskripsi' => 'Mikroskop binokuler untuk praktikum biologi',
                'created_at' => now(),
            ],
            [
                'nama_barang' => 'Tabung Reaksi',
                'jumlah_barang' => 50,
                'foto' => 'tabung_reaksi.jpg',
                'deskripsi' => 'Tabung reaksi kaca tahan panas',
                'created_at' => now(),
            ],
            [
                'nama_barang' => 'Laptop',
                'jumlah_barang' => 15,
                'foto' => 'laptop.jpg',
                'deskripsi' => 'Laptop untuk praktikum programming',
                'created_at' => now(),
            ],
            [
                'nama_barang' => 'Multimeter',
                'jumlah_barang' => 8,
                'foto' => 'multimeter.jpg',
                'deskripsi' => 'Multimeter digital untuk mengukur listrik',
                'created_at' => now(),
            ],
            [
                'nama_barang' => 'Proyektor',
                'jumlah_barang' => 5,
                'foto' => 'proyektor.jpg',
                'deskripsi' => 'Proyektor LCD untuk presentasi',
                'created_at' => now(),
            ],
        ]);
    }
}
