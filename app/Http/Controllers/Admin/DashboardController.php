<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        // Residents who have paid for the current month and year
        $totalSudahBayar = Warga::whereHas('pembayaran', function ($query) use ($currentMonth, $currentYear) {
            $query->where('bulan', $currentMonth)
                ->where('tahun', $currentYear)
                ->where('status', 1);
        })->count();

        // Residents who have not paid for the current month and year
        $totalBelumBayar = Warga::whereDoesntHave('pembayaran', function ($query) use ($currentMonth, $currentYear) {
            $query->where('bulan', $currentMonth)
                ->where('tahun', $currentYear);
        })->orWhereHas('pembayaran', function ($query) use ($currentMonth, $currentYear) {
            $query->where('bulan', $currentMonth)
                ->where('tahun', $currentYear)
                ->where('status', 0);
        })->count();

        return view('dashboard.admin.index', compact('totalSudahBayar', 'totalBelumBayar', 'currentMonth'));
    }
}
