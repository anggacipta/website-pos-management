<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->has(['tanggal1', 'tanggal2'])) {
            $tanggal1 = Carbon::createFromFormat('m/d/Y', $request->input('tanggal1'))->startOfDay();
            $tanggal2 = Carbon::createFromFormat('m/d/Y', $request->input('tanggal2'))->endOfDay();
            $query->whereBetween('created_at', [$tanggal1, $tanggal2]);
        }

        $pengeluarans = $query->orderBy('created_at', 'desc')->paginate(10);

        // Calculate total income for the current month
        $totalCurrentMonth = Pengeluaran::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('harga_barang');

        // Calculate total income for the current day
        $totalToday = Pengeluaran::whereDate('created_at', Carbon::today())->sum('harga_barang');

        return view('dashboard.admin.pengeluaran.index', compact('pengeluarans', 'totalCurrentMonth', 'totalToday'));
    }

    public function create()
    {
        $kategoris = KategoriPengeluaran::all();
        return view('dashboard.admin.pengeluaran.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_barang' => 'nullable',
            'potongan' => 'nullable|integer',
            'satuan' => 'required',
            'nama_toko' => 'required',
            'kategori_id' => 'required',
        ]);

        $data = $request->all();
        $data['potongan'] = $data['potongan'] ?? 0; // Set default value for potongan if not provided
        $data['jumlah_barang'] = $data['jumlah_barang'] ?? 1; // Set default value for jumlah_barang if not provided

        Pengeluaran::create($data);
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }
}
