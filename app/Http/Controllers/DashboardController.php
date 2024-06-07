<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_transaksi = Transaksi::count();
        $total_user = User::where('role', 'user')->count();
        $total_produk = Product::count();
        $total_kategori = Kategori::count();
        return view('admin.pages.dashboard', [
            'total_transaksi' => $total_transaksi,
            'total_user' => $total_user,
            'total_produk' => $total_produk,
            'total_kategori' => $total_kategori,
        ]);
    }
}
