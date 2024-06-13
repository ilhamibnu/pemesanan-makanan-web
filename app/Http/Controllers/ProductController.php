<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;

class ProductController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $product = Product::with('kategori')->get()->sortByDesc('id');
        return view('admin.pages.product', [
            'product' => $product,
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            // 'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok' => 'required|numeric',
            'id_kategori' => 'required',
        ], [
            'nama.required' => 'Nama produk harus diisi',
            // 'deskripsi.required' => 'Deskripsi produk harus diisi',
            'harga.required' => 'Harga produk harus diisi',
            'harga.numeric' => 'Harga produk harus berupa angka',
            'gambar.required' => 'Gambar produk harus diisi',
            'gambar.image' => 'Gambar produk harus berupa gambar',
            'gambar.mimes' => 'Gambar produk harus berupa gambar dengan format jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran gambar produk maksimal 2 MB',
            'stok.required' => 'Stok produk harus diisi',
            'stok.numeric' => 'Stok produk harus berupa angka',
            'id_kategori.required' => 'Kategori produk harus diisi',
        ]);

        $gambar = $request->file('gambar');
        $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move('img/product', $nama_gambar);

        Product::create([
            'nama' => $request->nama,
            // 'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $nama_gambar,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect('/admin/product')->with('store', 'Produk berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            // 'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok' => 'required|numeric',
            'id_kategori' => 'required',
        ], [
            'nama.required' => 'Nama produk harus diisi',
            // 'deskripsi.required' => 'Deskripsi produk harus diisi',
            'harga.required' => 'Harga produk harus diisi',
            'harga.numeric' => 'Harga produk harus berupa angka',
            'gambar.image' => 'Gambar produk harus berupa gambar',
            'gambar.mimes' => 'Gambar produk harus berupa gambar dengan format jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran gambar produk maksimal 2 MB',
            'stok.required' => 'Stok produk harus diisi',
            'stok.numeric' => 'Stok produk harus berupa angka',
            'id_kategori.required' => 'Kategori produk harus diisi',
        ]);

        $product = Product::find($id);

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            $gambar_lama = 'img/product/' . $product->gambar;
            if (file_exists($gambar_lama)) {
                unlink($gambar_lama);
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $gambar->move('img/product', $nama_gambar);
        } else {
            $nama_gambar = $product->gambar;
        }

        Product::where('id', $id)->update([
            'nama' => $request->nama,
            // 'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $nama_gambar,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect('/admin/product')->with('update', 'Produk berhasil diubah');
    }

    public function destroy($id)
    {
        // cek apakah produk ini memiliki transaksi
        $product = Product::find($id);
        if ($product->detailTransaksi->count() > 0) {
            return redirect('/admin/product')->with('product-transaksi', 'Produk ini ada di transaksi');
        }

        // cek apakah produk ini memiliki cart
        if ($product->cart->count() > 0) {
            return redirect('/admin/product')->with('product-cart', 'Produk ini ada di cart');
        }

        // hapus gambar
        $product = Product::find($id);
        $gambar = 'img/product/' . $product->gambar;
        if (file_exists($gambar)) {
            unlink($gambar);
        }

        Product::destroy($id);
        return redirect('/admin/product')->with('destroy', 'Produk berhasil dihapus');
    }
}
