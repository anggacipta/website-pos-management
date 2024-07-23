<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KondisiBarang;
use Illuminate\Http\Request;

class KondisiBarangController extends Controller
{
    public function index()
    {
        $kon_barangs = KondisiBarang::all();
        return view('dashboard.admin.kondisi_barang.index', compact('kon_barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kondisi_barang' => 'required',
        ]);

        KondisiBarang::create($request->all());

        return redirect()->route('kondisi-barang.index')
            ->with('success', 'Kondisi Barang created successfully.');
    }

    public function edit($id)
    {
        $kon_barang = KondisiBarang::find($id);
        return view('dashboard.admin.kondisi_barang.edit', compact('kon_barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kondisi_barang' => 'required',
        ]);

        $kon_barang = KondisiBarang::find($id);
        $kon_barang->update($request->all());

        return redirect()->route('kondisi-barang.index')
            ->with('success', 'Kondisi Barang updated successfully');
    }

    public function destroy($id)
    {
        KondisiBarang::find($id)->delete();
        return redirect()->route('kondisi-barang.index')
            ->with('success', 'Kondisi Barang deleted successfully');
    }
}
