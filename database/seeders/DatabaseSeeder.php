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

        Kategori::create([
            'nama' => 'Cemilan',
        ]);

        Product::create([
            'nama' => 'Nasi Goreng',
            'harga' => '15000',
            'stok' => '10',
            'gambar' => 'nasigoreng.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Mie Pangsit',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'miepangsit.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Fuyung Hai',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'fuyunghai.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Bakso',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'bakso.jpg',
            'id_kategori' => 1,
        ]);


        Product::create([
            'nama' => 'Nasi Pecel',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'nasipecel.jpg',
            'id_kategori' => 1,
        ]);

        Product::create([
            'nama' => 'Bakmi Goreng',
            'harga' => '15000',
            'stok' => '10',
            'gambar' => 'bakmigoreng.jpg',
            'id_kategori' => 1,
        ]);


        Product::create([
            'nama' => 'Es Teh',
            'harga' => '5000',
            'stok' => '10',
            'gambar' => 'teh.jpg',
            'id_kategori' => 2,
        ]);

        Product::create([
            'nama' => 'Es Jeruk',
            'harga' => '5000',
            'stok' => '10',
            'gambar' => 'jeruk.jpg',
            'id_kategori' => 2,
        ]);

        Product::create([
            'nama' => 'Es Susu',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'susu.jpg',
            'id_kategori' => 2,
        ]);

        Product::create([
            'nama' => 'Air Putih',
            'harga' => '5000',
            'stok' => '10',
            'gambar' => 'airputih.jpg',
            'id_kategori' => 2,
        ]);


        Product::create([
            'nama' => 'Lumpia Ayam',
            'harga' => '15000',
            'stok' => '10',
            'gambar' => 'lumpia.jpg',
            'id_kategori' => 3,
        ]);

        Product::create([
            'nama' => 'Tahu Bakso',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'tahubakso.jpg',
            'id_kategori' => 3,
        ]);

        Product::create([
            'nama' => 'Sempol Ayam',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'sempol.jpg',
            'id_kategori' => 3,
        ]);

        Product::create([
            'nama' => 'Tahu Kucek',
            'harga' => '10000',
            'stok' => '10',
            'gambar' => 'tahukucek.jpg',
            'id_kategori' => 3,
        ]);

        Product::create([
            'nama' => 'Roti Bakar Coklat',
            'harga' => '15000',
            'stok' => '10',
            'gambar' => 'rotibakar.jpg',
            'id_kategori' => 3,
        ]);
    }
}
