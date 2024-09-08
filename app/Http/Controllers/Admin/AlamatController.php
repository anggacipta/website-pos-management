<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function index()
    {
        $alamats = Alamat::all();
        $hasAlamat =  $alamats->count() > 0;
        return view('dashboard.admin.alamat.index', compact('alamats', 'hasAlamat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required'
        ]);

        Alamat::create($request->all());

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alamat = Alamat::findOrFail($id);
        return view('dashboard.admin.alamat.edit', compact('alamat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required'
        ]);

        $alamat = Alamat::findOrFail($id);
        $alamat->update($request->all());

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diubah');
    }

    public function destroy($id)
    {
        $alamat = Alamat::findOrFail($id);
        $alamat->delete();

        return redirect()->route('alamat.index')->with('error', 'Alamat berhasil dihapus');
    }
}
