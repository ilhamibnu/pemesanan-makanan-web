<?php

namespace App\Console\Commands;

use App\Models\Transaksi;
use Illuminate\Console\Command;

class CheckEstimasiPemesanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-estimasi-pemesanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check estimasi pemesanan dan update status pemesanan jika sudah lewat dari waktu sekarang';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transaksi = Transaksi::all();

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
    }
}
