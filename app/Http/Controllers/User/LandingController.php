<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $product = Product::with('kategori')->get()->sortByDesc('id');
        return view('user.pages.index', [
            'product' => $product,
        ]);
    }

    public function menu()
    {
        $product = Product::with('kategori')->get()->sortByDesc('id');
        return view('user.pages.menu', [
            'product' => $product,
        ]);
    }

    public function shop()
    {
        $kategori = Kategori::all();
        $product = Product::with('kategori')->get()->sortByDesc('id');
        return view('user.pages.shop', [
            'product' => $product,
            'kategori' => $kategori,
        ]);
    }

    public function contact()
    {
        return view('user.pages.contact');
    }
}
