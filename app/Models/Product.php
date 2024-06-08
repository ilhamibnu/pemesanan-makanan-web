<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        // 'stok',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_product', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'id_product', 'id');
    }
}
