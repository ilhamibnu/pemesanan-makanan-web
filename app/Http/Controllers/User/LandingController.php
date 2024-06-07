<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $product = Product::with('kategori')->get();
        return view('user.pages.landing', [
            'product' => $product,
        ]);
    }
}
