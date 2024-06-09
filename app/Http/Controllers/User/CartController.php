<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('id_user', auth()->user()->id)->get()->sortByDesc('id');
        $sum_cart = Cart::where('id_user', auth()->user()->id)->sum('total_harga');
        return view('user.pages.cart', [
            'cart' => $cart,
            'sum_cart' => $sum_cart
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id_product);
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
                'total_harga' => $request->jumlah * $product->harga
            ]);
        }
        return redirect('/user/cart')->with('storecart', 'Produk berhasil dimasukkan ke keranjang');
    }

    public function update(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'items.*.id' => 'required|exists:cart,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        // Loop melalui item yang diterima dari form
        foreach ($request->items as $item) {
            $cart = Cart::find($item['id']);
            $cart->update([
                'jumlah' => $item['jumlah'],
                'total_harga' => $cart->product->harga * $item['jumlah'],
            ]);
        }

        return redirect('/user/cart')->with('updatecart', 'Keranjang berhasil diupdate');
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/user/cart')->with('deletecart', 'Produk berhasil dihapus dari keranjang');
    }


    public function checkout()
    {
        $cart = Cart::where('id_user', auth()->user()->id)->get();
        $transaksi = new Transaksi();
        $transaksi->no_transaksi = 'TRX' . date('YmdHis');
        $transaksi->total_harga = $cart->sum('total_harga');
        $transaksi->status_pembayaran = 'Belum Pilih Pembayaran';
        $transaksi->bank = '';
        $transaksi->no_va = '';
        $transaksi->expired_at = '';
        $transaksi->id_user = auth()->user()->id;
        $transaksi->save();
        foreach ($cart as $c) {
            $detail_transaksi = new DetailTransaksi();
            $detail_transaksi->id_transaksi = $transaksi->id;
            $detail_transaksi->id_product = $c->id_product;
            $detail_transaksi->total_harga = $c->total_harga;
            $detail_transaksi->jumlah = $c->jumlah;
            $detail_transaksi->save();
        }

        $delete_cart = Cart::where('id_user', auth()->user()->id)->get();
        if ($delete_cart) {
            foreach ($delete_cart as $dc) {
                $dc->delete();
            }
        }

        \Midtrans\Config::$serverKey = 'SB-Mid-server-QmM6Wx6PNzqhOeVL9f4tnBM7';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;

        // \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->no_transaksi,
                'gross_amount' => $transaksi->total_harga,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                // 'phone' => auth()->user()->phone,
                'email' => auth()->user()->email,
            ),
            'item_details' => array(
                array(
                    'id' => $transaksi->no_transaksi,
                    'price' => $transaksi->total_harga,
                    'quantity' => 1,
                    'name' => 'Pembayaran Produk',
                ),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('user.pages.checkout', [
            'transaksi' => $transaksi,
            'snapToken' => $snapToken
        ]);
    }

    public function callback(Request $request)
    {
        $serverkey = 'SB-Mid-server-QmM6Wx6PNzqhOeVL9f4tnBM7';
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverkey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'settlement') {

                $order = Transaksi::where('no_transaksi', $request->order_id)->first();
                $order->bank = $request->va_numbers[0]['bank'];
                $order->no_va = $request->va_numbers[0]['va_number'];
                $order->expired_at = $request->expiry_time;
                $order->status_pembayaran = 'paid';
                $order->save();
            } elseif ($request->transaction_status == 'pending') {

                $order = Transaksi::where('no_transaksi', $request->order_id)->first();
                $order->bank = $request->va_numbers[0]['bank'];
                $order->no_va = $request->va_numbers[0]['va_number'];
                $order->expired_at = $request->expiry_time;
                $order->status_pembayaran = 'pending';
                $order->save();
            } else {
                $order = Transaksi::where('no_transaksi', $request->order_id)->first();
                $order->bank = $request->va_numbers[0]['bank'];
                $order->no_va = $request->va_numbers[0]['va_number'];
                $order->expired_at = $request->expiry_time;
                $order->status_pembayaran = 'expire';
                $order->save();
            }
        }
    }
}
