<?php

namespace App\Http\Controllers\Admin; // ⚠️ Pastikan namespace-nya benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product; // Pastikan semua model yang dibutuhkan diimport
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    // Pindahkan fungsi history() dari TransactionController
    public function history()
    {
        // 1. Ambil data transaksi (biar tabel tetap muncul)
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->paginate(10); // Tambahkan pagination agar tidak berat

        // 2. HITUNG DUIT (Total Omzet)
        $total_pemasukan = Transaction::sum('total_price'); // Ambil total dari semua transaksi, tidak perlu ambil semua data dulu.

        // 3. HITUNG DUIT HARI INI SAJA (Bonus Fitur)
        $pemasukan_hari_ini = Transaction::whereDate('created_at', date('Y-m-d'))->sum('total_price');

        // 4. Hitung Jumlah Transaksi
        $total_transaksi = Transaction::count();

        // Kirim semua variabel angka tadi ke View
        return view('admin.transactions.index', compact(
            'transactions',
            'total_pemasukan',
            'pemasukan_hari_ini',
            'total_transaksi'
        ));
    }

    // Pindahkan fungsi financialReport() dari TransactionController
    public function financialReport(Request $request)
    {
        // **⚠️ Tambahkan logika filter tanggal di sini ⚠️**
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));
        $endDateWithTime = $endDate . ' 23:59:59';

        // 1. Ambil semua detail penjualan yang difilter tanggal
        $details = TransactionDetail::with('product')
            ->whereHas('transaction', function ($query) use ($startDate, $endDateWithTime) {
                $query->whereBetween('created_at', [$startDate, $endDateWithTime]);
            })
            ->get();

        // 2. HITUNG OMZET (Total Uang Masuk)
        $total_omzet = $details->sum(function ($item) {
            return $item->qty * $item->price_at_transaction;
        });

        // 3. HITUNG TOTAL MODAL/HPP
        $total_hpp = $details->sum(function ($item) {
            // Asumsi purchase_price adalah kolom HPP/Modal
            $modal = $item->product ? $item->product->purchase_price : 0;
            return $item->qty * $modal;
        });

        // 4. HITUNG LABA BERSIH
        $total_laba = $total_omzet - $total_hpp;

        // 5. Bonus: Produk Terlaris (Filter harus berdasarkan transaksi yang difilter)
        $transactionIds = Transaction::whereBetween('created_at', [$startDate, $endDateWithTime])->pluck('id');

        $top_products = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->whereIn('transaction_id', $transactionIds)
            ->take(5)
            ->get();

        return view('admin.reports.financial', compact(
            'total_omzet',
            'total_hpp',
            'total_laba',
            'top_products',
            'startDate',
            'endDate'
        ));
    }
}
