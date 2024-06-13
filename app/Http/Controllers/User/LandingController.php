<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $product2 = Product::with('kategori')->get()->sortByDesc('id');

        // product dengan jumlah terbali terbanyak dengan transaksi paid
        $mostproduct = DB::table('product')
            ->join('detail_transaksi', 'product.id', '=', 'detail_transaksi.id_product')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id')
            ->where('transaksi.status_pembayaran', 'paid')
            ->select('product.*', DB::raw('count(detail_transaksi.jumlah) as jumlah'))
            ->groupBy('product.id', 'product.nama', 'product.harga', 'product.stok', 'product.gambar', 'product.id_kategori', 'product.created_at', 'product.updated_at')
            ->orderBy('jumlah', 'desc')
            ->limit(5)
            ->get();

        $product = Product::with('kategori')->get()->sortByDesc('id');
        return view('user.pages.index', [
            'product' => $product,
            'mostproduct' => $mostproduct,
            'product2' => $product2,
            'kategori' => $kategori,
        ]);
    }

    // public function menu()
    // {
    //     $product = Product::with('kategori')->get()->sortByDesc('id');
    //     return view('user.pages.menu', [
    //         'product' => $product,
    //     ]);
    // }

    // public function shop()
    // {
    //     $kategori = Kategori::all();
    //     $product = Product::with('kategori')->get()->sortByDesc('id');
    //     return view('user.pages.shop', [
    //         'product' => $product,
    //         'kategori' => $kategori,
    //     ]);
    // }

    public function contact()
    {
        return view('user.pages.contact');
    }
}
