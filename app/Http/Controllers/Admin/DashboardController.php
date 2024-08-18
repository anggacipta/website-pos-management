<?php

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;

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

        // Get pemasukan data for the chart
        $pemasukanData = Pemasukan::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(jumlah) as total')
        )->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();

        // Get pengeluaran data for the chart
        $pengeluaranData = Pengeluaran::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(jumlah) as total')
        )->groupBy('month')->orderBy('month')->pluck('total', 'month')->toArray();

        // Ensure all months are present in the data
        $pemasukanData = $this->fillMissingMonths($pemasukanData);
        $pengeluaranData = $this->fillMissingMonths($pengeluaranData);

        return view('dashboard.admin.index', compact('totalSudahBayar', 'totalBelumBayar', 'currentMonth', 'pemasukanData', 'pengeluaranData'));
    }

    private function fillMissingMonths($data)
    {
        $filledData = [];
        for ($i = 1; $i <= 12; $i++) {
            $filledData[$i] = $data[$i] ?? 0;
        }
        return $filledData;
    }
}
