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

        // date dan time sekarang
        $now = date('Y-m-d H:i:s');

        foreach ($transaksi as $item) {
            // jika estimasi pemesanan sudah lewat dari waktu sekarang, maka status pemesanan menjadi Pemesanan Selesai
            if ($item->estimasi_pemesanan == !null && $item->estimasi_pemesanan < $now) {
                $item->update([
                    'status_pemesanan' => 'Pemesanan Selesai'
                ]);
            }
        }

        return view('user.pages.pemesanan', [
            'transaksi' => $transaksi
        ]);
    }
}
