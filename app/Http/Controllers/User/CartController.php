<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('id_user', auth()->user()->id)->get();
        $sum_cart = Cart::where('id_user', auth()->user()->id)->sum('total_harga');
        return view('user.pages.cart', [
            'cart' => $cart,
            'sum_cart' => $sum_cart
        ]);
    }

    public function store(Request $request)
    {
        $cart = Cart::where('id_user', auth()->user()->id)->where('id_product', $request->id_product)->first();
        if ($cart) {
            $cart->update([
                'jumlah' => $cart->jumlah + $request->jumlah,
                'total_harga' => $cart->product->harga * ($cart->jumlah + $request->jumlah)
            ]);
        } else {
            Cart::create([
                'id_user' => auth()->user()->id,
                'id_product' => $request->id_product,
                'jumlah' => $request->jumlah,
                'total_harga' => $request->jumlah * $request->harga
            ]);
        }
        return redirect('/user/cart')->with('success', 'Produk berhasil dimasukkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->update([
            'jumlah' => $request->jumlah,
            'total_harga' => $cart->product->harga * $request->jumlah
        ]);
        return redirect('/user/cart')->with('success', 'Jumlah produk berhasil diubah');
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/user/cart')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
