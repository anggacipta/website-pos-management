<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    public function index()
    {
        KategoriPengeluaran::ensureDefaultCategoryExists();
        $kategoris = KategoriPengeluaran::all();
        return view('dashboard.admin.kategori_pengeluaran.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriPengeluaran::create($request->all());

        return redirect()->route('kategori-pengeluaran.index')->with('success', 'Kategori pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = KategoriPengeluaran::find($id);
        return view('dashboard.admin.kategori_pengeluaran.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KategoriPengeluaran::find($id)->update($request->all());

        return redirect()->route('kategori-pengeluaran.index')->with('success', 'Kategori pengeluaran berhasil diubah');
    }

    public function destroy($id)
    {
        KategoriPengeluaran::ensureDefaultCategoryExists(); // Ensure default category exists

        $kategori = KategoriPengeluaran::find($id);
        if ($kategori) {
            // Update related records to default category
            Pengeluaran::where('kategori_id', $id)->update(['kategori_id' => 1]);
            $kategori->delete();
        }

        return redirect()->route('kategori-pengeluaran.index')->with('error', 'Kategori pengeluaran berhasil dihapus');
    }
}
