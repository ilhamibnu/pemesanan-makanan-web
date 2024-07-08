<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user', 'detailTransaksi')->get()->sortByDesc('id');
        $total = Transaksi::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total_revenue'))
            ->groupBy('date')
            ->get();
        $transactions = Transaksi::with('detailTransaksi.product')
            ->get();

        // Mengelompokkan dan menghitung data per produk
        $productData = [];

        foreach ($transactions as $transaction) {
            foreach ($transaction->detailTransaksi as $detail) {
                $productName = $detail->product->nama;
                $quantity = $detail->jumlah;
                $price = $detail->product->harga;

                if (!isset($productData[$productName])) {
                    $productData[$productName] = [
                        'name' => $productName,
                        'total_sold' => 0,
                        'total_revenue' => 0,
                    ];
                }

                $productData[$productName]['total_sold'] += $quantity;
                $productData[$productName]['total_revenue'] += $quantity * $price;
            }
        }

        // Format hasil akhir
        $result = [];
        foreach ($productData as $product) {
            $result[] = [
                'name' => $product['name'],
                'total_sold' => $product['total_sold'],
                'total_revenue' => $product['total_revenue'],
            ];
        }
        return view('admin.pages.report', [
            'transaksi' => $transaksi,
            'total' => $total,
            'result' => $result
        ]);
    }

    public function filter(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $status = $request->status;

        // Base query with relationships loaded
        $query = Transaksi::with('user', 'detailTransaksi');

        // Apply filters if both dates and status are provided
        if ($date1 && $date2 && $status) {
            $query->whereBetween('created_at', [$date1, $date2])
                ->where('status_pembayaran', $status);
        }
        // Apply date range filter if both dates are provided but status is not
        elseif ($date1 && $date2) {
            $query->whereBetween('created_at', [$date1, $date2]);
        }
        // Apply status filter if status is provided but dates are not
        elseif ($status) {
            $query->where('status_pembayaran', $status);
        }

        // Execute the query and get the results
        $transaksi = $query->get();


        // tampilkan total pendapatan per tanggal yang dipilih jika ada filter tanggal yang dipilih dan status nya
        if ($date1 && $date2 && $status) {
            $total = Transaksi::whereBetween('created_at', [$date1, $date2])
                ->where('status_pembayaran', $status)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total_revenue'))
                ->groupBy('date')
                ->get();
        }
        // tampilkan total pendapatan per tanggal yang dipilih jika ada filter tanggal yang dipilih
        elseif ($date1 && $date2) {
            $total = Transaksi::whereBetween('created_at', [$date1, $date2])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total_revenue'))
                ->groupBy('date')
                ->get();
        }
        // tampilkan total pendapatan per tanggal yang dipilih jika ada filter status nya
        elseif ($status) {
            $total = Transaksi::where('status_pembayaran', $status)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total_revenue'))
                ->groupBy('date')
                ->get();
        }
        // tampilkan total pendapatan per tanggal yang dipilih jika tidak ada filter tanggal dan status
        else {
            $total = Transaksi::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total_revenue'))
                ->groupBy('date')
                ->get();
        }

        // Ambil data transaksi sesuai dengan filter yang diterapkan
        if ($date1 && $date2 && $status) {
            $transactions = Transaksi::whereBetween('created_at', [$date1, $date2])
                ->where('status_pembayaran', $status)
                ->with('detailTransaksi.product')
                ->get();
        } elseif ($date1 && $date2) {
            $transactions = Transaksi::whereBetween('created_at', [$date1, $date2])
                ->with('detailTransaksi.product')
                ->get();
        } elseif ($status) {
            $transactions = Transaksi::where('status_pembayaran', $status)
                ->with('detailTransaksi.product')
                ->get();
        } else {
            $transactions = Transaksi::with('detailTransaksi.product')
                ->get();
        }

        // Mengelompokkan dan menghitung data per produk
        $productData = [];

        foreach ($transactions as $transaction) {
            foreach ($transaction->detailTransaksi as $detail) {
                $productName = $detail->product->nama;
                $quantity = $detail->jumlah;
                $price = $detail->product->harga;

                if (!isset($productData[$productName])) {
                    $productData[$productName] = [
                        'name' => $productName,
                        'total_sold' => 0,
                        'total_revenue' => 0,
                    ];
                }

                $productData[$productName]['total_sold'] += $quantity;
                $productData[$productName]['total_revenue'] += $quantity * $price;
            }
        }

        // Format hasil akhir
        $result = [];
        foreach ($productData as $product) {
            $result[] = [
                'name' => $product['name'],
                'total_sold' => $product['total_sold'],
                'total_revenue' => $product['total_revenue'],
            ];
        }

        return view('admin.pages.report', [
            'transaksi' => $transaksi,
            'total' => $total,
            'result' => $result
        ]);
    }
}
