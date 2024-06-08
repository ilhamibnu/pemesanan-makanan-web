<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Product;
use \App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);

        Kategori::create([
            'nama' => 'Makanan',
        ]);

        Kategori::create([
            'nama' => 'Minuman',
        ]);

        Product::create([
            'nama' => 'Ayam Goreng',
            'deskripsi' => 'Ayam Goreng Spesial',
            'harga' => '15000',
            'gambar' => 'ayam.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Nasi Goreng',
            'deskripsi' => 'Nasi Goreng Spesial',
            'harga' => '10000',
            'gambar' => 'nasi.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Mie Goreng',
            'deskripsi' => 'Mie Goreng Spesial',
            'harga' => '8000',
            'gambar' => 'mie.jpg',
            'id_kategori' => 1,
        ]);


        Product::create([
            'nama' => 'Es Teh',
            'deskripsi' => 'Es Teh Manis',
            'harga' => '5000',
            'gambar' => 'teh.jpg',
            'id_kategori' => 2,
        ]);

        Product::create([
            'nama' => 'Es Jeruk',
            'deskripsi' => 'Es Jeruk Manis',
            'harga' => '5000',
            'gambar' => 'jeruk.jpg',
            'id_kategori' => 2,
        ]);

        Product::create([
            'nama' => 'Es Campur',
            'deskripsi' => 'Es Campur Manis',
            'harga' => '8000',
            'gambar' => 'campur.jpg',
            'id_kategori' => 2,
        ]);
    }
}
