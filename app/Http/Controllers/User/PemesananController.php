<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;


class PemesananController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user', 'detailTransaksi')->where('id_user', auth()->user()->id)->get()->sortByDesc('id');
        return view('user.pages.pemesanan', [
            'transaksi' => $transaksi
        ]);
    }
}
