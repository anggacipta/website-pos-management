<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $units = UnitKerja::all();
        return view('dashboard.admin.unit_kerja.index', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_kerja' => 'required',
        ]);

        UnitKerja::create($request->all());

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja created successfully.');
    }

    public function edit($id)
    {
        $unit = UnitKerja::find($id);
        return view('dashboard.admin.unit_kerja.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_kerja' => 'required',
        ]);

        $unit = UnitKerja::find($id);
        $unit->update($request->all());

        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja updated successfully');
    }

    public function destroy($id)
    {
        UnitKerja::find($id)->delete();
        return redirect()->route('unit-kerja.index')
            ->with('success', 'Unit Kerja deleted successfully');
    }
}
