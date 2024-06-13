<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DetailProductController extends Controller
{
    public function index($id)
    {
        $product = Product::with('kategori')->find($id);
        // $relateProduct = Product::where('id_kategori', $product->id_kategori)->where('id', '!=', $id)->get();
        return view('user.pages.product-detail', [
            'product' => $product,
            // 'relateProduct' => $relateProduct,
        ]);
    }
}
