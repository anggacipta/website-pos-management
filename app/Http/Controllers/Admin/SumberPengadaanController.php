<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SumberPengadaan;
use Illuminate\Http\Request;

class SumberPengadaanController extends Controller
{
    public function index()
    {
        $sumbers = SumberPengadaan::all();
        return view('dashboard.admin.sumber_pengadaan.index', compact('sumbers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sumber_pengadaan' => 'required',
        ]);

        SumberPengadaan::create($request->all());

        return redirect()->route('sumber-pengadaan.index')
            ->with('success', 'Sumber Pengadaan created successfully.');
    }

    public function edit($id)
    {
        $sumber = SumberPengadaan::find($id);
        return view('dashboard.admin.sumber_pengadaan.edit', compact('sumber'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sumber_pengadaan' => 'required',
        ]);

        $sumber = SumberPengadaan::find($id);
        $sumber->update($request->all());

        return redirect()->route('sumber-pengadaan.index')
            ->with('success', 'Sumber Pengadaan updated successfully');
    }

    public function destroy($id)
    {
        SumberPengadaan::find($id)->delete();
        return redirect()->route('sumber-pengadaan.index')
            ->with('success', 'Sumber Pengadaan deleted successfully');
    }
}
