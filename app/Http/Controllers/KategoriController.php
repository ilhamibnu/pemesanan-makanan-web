<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all()->sortByDesc('id');
        return view('admin.pages.kategori', [
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama kategori harus diisi',
        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect('/admin/kategori')->with('store', 'Kategori berhasil ditambahkan');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama kategori harus diisi',
        ]);

        Kategori::where('id', $id)->update([
            'nama' => $request->nama,
        ]);

        return redirect('/admin/kategori')->with('update', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        // cek apakah kategori ini memiliki produk
        $kategori = Kategori::find($id);
        if ($kategori->product->count() > 0) {
            return redirect('/admin/kategori')->with('kategori-product', 'Kategori ini memiliki produk');
        }

        Kategori::destroy($id);
        return redirect('/admin/kategori')->with('destroy', 'Kategori berhasil dihapus');
    }
}
