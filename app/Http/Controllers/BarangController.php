<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('dashboard.admin.barang.index', compact('barangs'));
    }

    public function create($ruangan_id) {
        $totalBarang = Barang::where('ruang_id', $ruangan_id)->count() + 1;
        $kode_barang = 'BRG' . str_pad($totalBarang, 3, '0', STR_PAD_LEFT);
        return view('dashboard.admin.barang.create', compact('ruangan_id', 'kode_barang'));
    }

    public function ruangan(Request $request)
    {
        $search = $request->get('search');
        $ruangans = Ruangan::where('nama_ruang', 'like', "%$search%")->get();
        return view('dashboard.admin.barang.ruangan', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'ruang_id' => 'required'
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('dashboard.admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'ruang_id' => 'required'
        ]);

        $barang = Barang::find($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
