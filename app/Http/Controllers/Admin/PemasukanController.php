<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        // Total income for the current month
        $totalCurrentMonth = Pemasukan::whereHas('pembayaran', function($query) use ($currentMonth, $currentYear) {
            $query->where('status', 1);
        })->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('jumlah'); // Ensure the correct column is being summed

        // Total income for the last month
        $totalLastMonth = Pemasukan::whereHas('pembayaran', function($query) use ($lastMonth, $lastMonthYear) {
            $query->where('status', 1);
        })->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('jumlah'); // Ensure the correct column is being summed

        // Total Income
        $totalIncome = Pemasukan::whereHas('pembayaran', function($query) {
            $query->where('status', 1);
        })->sum('jumlah');

        $pemasukans = Pemasukan::whereHas('pembayaran', function($query) {
            $query->where('status', 1);
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.admin.pemasukan.index', compact('pemasukans', 'totalCurrentMonth', 'totalLastMonth', 'totalIncome'));
    }
}
