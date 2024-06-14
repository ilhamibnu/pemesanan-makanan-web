<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user', 'detailTransaksi')->get()->sortByDesc('id');

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

        return view('admin.pages.transaksi', [
            'transaksi' => $transaksi
        ]);
    }
}
