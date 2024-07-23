<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MerkBarang;
use Illuminate\Http\Request;

class MerkBarangController extends Controller
{
    public function index()
    {
        $merks = MerkBarang::all();
        return view('dashboard.admin.merk_barang.index', compact('merks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk_barang' => 'required',
        ]);

        MerkBarang::create($request->all());

        return redirect()->route('merk-barang.index')
            ->with('success', 'Merk Barang created successfully.');
    }

    public function edit($id)
    {
        $merk = MerkBarang::find($id);
        return view('dashboard.admin.merk_barang.edit', compact('merk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'merk_barang' => 'required',
        ]);

        $merk = MerkBarang::find($id);
        $merk->update($request->all());

        return redirect()->route('merk-barang.index')
            ->with('success', 'Merk Barang updated successfully');
    }

    public function destroy($id)
    {
        MerkBarang::find($id)->delete();
        return redirect()->route('merk-barang.index')
            ->with('success', 'Merk Barang deleted successfully');
    }
}
