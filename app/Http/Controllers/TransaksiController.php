<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user', 'detailTransaksi')->get()->sortByDesc('id');
        return view('admin.pages.transaksi', [
            'transaksi' => $transaksi
        ]);
    }
}
