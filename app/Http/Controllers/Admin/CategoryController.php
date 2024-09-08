<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        Category::ensureDefaultCategoryExists();
        $kategoris = Category::all();
        return view('dashboard.admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori produk berhasil ditambahkan');
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

        return redirect()->route('kategori.index')->with('success', 'Kategori produk berhasil diubah');
    }

    public function destroy($id)
    {
        Category::ensureDefaultCategoryExists();
        $kategori = Category::find($id);
        if ($kategori) {
            // Update related records to default category
            Product::where('kategori_id', $id)->update(['kategori_id' => 1]);
            $kategori->delete();
        }

        return redirect()->route('kategori.index')->with('error', 'Kategori produk berhasil dihapus');
    }
}
