<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('dashboard.admin.ruangan.index', compact('ruangans'));
    }

    public function create() {
        return view('dashboard.admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'nama_ruang' => 'required'
        ]);

        Ruangan::create($request->all());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('dashboard.admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ruang' => 'required'
        ]);

        $ruangan = Ruangan::find($id);
        $ruangan->update($request->all());

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diupdate');
    }

    public function destroy($id)
    {
        Ruangan::find($id)->delete();
        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
