<?php

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pengeluaranData = Pengeluaran::select(DB::raw('kategori_id, COUNT(*) as count'))
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori->nama_kategori,
                    'count' => $item->count
                ];
            });

        $totalPengeluaranHariIni = Pengeluaran::whereDate('created_at', Carbon::today())->count();

        // Fetch total penjualan for the last 7 days
        $penjualanHariIni = Pembayaran::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_harga) as total'))
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Fetch total penjualan for the last 12 months
        $penjualanBulanIni = Pembayaran::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_harga) as total'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'),
                    'total' => $item->total
                ];
            });

        // Fetch total pengeluarans for the last 7 days
        $pengeluaranHariIni = Pengeluaran::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(harga_barang) as total'))
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Fetch total pengeluarans for the last 12 months
        $pengeluaranBulanIni = Pengeluaran::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(harga_barang) as total'))
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'),
                    'total' => $item->total
                ];
            });

        // Fetch total pembayarans and pengeluarans for the pie chart
        $totalPembayarans = Pembayaran::sum('total_harga');
        $totalPengeluarans = Pengeluaran::sum('harga_barang');

        // Get total pemasukan and pengeluaran for the current month
        $totalPemasukanBulanan = Pembayaran::whereMonth('created_at', Carbon::now()->month)->sum('total_harga');
        $totalPengeluaranBulanan = Pengeluaran::whereMonth('created_at', Carbon::now()->month)->sum('harga_barang');

        return view('dashboard.admin.index', compact('pengeluaranData', 'totalPengeluaranHariIni', 'penjualanHariIni',
            'penjualanBulanIni', 'totalPembayarans', 'totalPengeluarans',
            'totalPemasukanBulanan', 'totalPengeluaranBulanan',
            'pengeluaranHariIni', 'pengeluaranBulanIni'));
    }
}
