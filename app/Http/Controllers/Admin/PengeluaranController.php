<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        // Total Income
        $totalIncome = Pemasukan::whereHas('pembayaran', function($query) {
            $query->where('status', 1);
        })->sum('jumlah');

        // Total Pengeluaran
        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // Total Sisa
        $totalSisa = $totalIncome - $totalPengeluaran;

        $pengeluarans = Pengeluaran::paginate(10);
        return view('dashboard.admin.pengeluaran.index', compact('pengeluarans', 'totalIncome', 'totalPengeluaran', 'totalSisa'));
    }

    public function create()
    {
        return view('dashboard.admin.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string'
        ]);

        // Total Income
        $totalIncome = Pemasukan::whereHas('pembayaran', function($query) {
            $query->where('status', 1);
        })->sum('jumlah');

        if ($totalIncome - $request->jumlah <= 0)
        {
            Pengeluaran::create($request->all());
            return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dibuat')
                ->with('error', 'Pengeluaran lebih dari pendapatan');
        } else {
            Pengeluaran::create($request->all());
            return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dibuat');
        }
    }
}
