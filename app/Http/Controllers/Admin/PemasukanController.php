<?php

// app/Http/Controllers/Admin/PemasukanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PemasukanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::query();

        if ($request->has(['tanggal1', 'tanggal2'])) {
            $tanggal1 = Carbon::createFromFormat('m/d/Y', $request->input('tanggal1'))->startOfDay();
            $tanggal2 = Carbon::createFromFormat('m/d/Y', $request->input('tanggal2'))->endOfDay();
            $query->whereBetween('created_at', [$tanggal1, $tanggal2]);
        }

        $pembayarans = $query->orderBy('created_at', 'desc')->paginate(10);

        // Calculate total income for the current month
        $totalCurrentMonth = Pembayaran::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');

        // Calculate total income for the current day
        $totalToday = Pembayaran::whereDate('created_at', Carbon::today())->sum('total_harga');

        return view('dashboard.admin.pemasukan.index', compact('pembayarans', 'totalCurrentMonth', 'totalToday'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('items.product')->findOrFail($id);

        return view('dashboard.admin.pemasukan.detail_invoice', compact('pembayaran'));
    }
}
