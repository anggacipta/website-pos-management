<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $kategoris = Category::all();
        return view('dashboard.admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Category::find($id);
        return view('dashboard.admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Category::find($id)->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('kategori.index')->with('error', 'Kategori berhasil dihapus');
    }
}
