<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPenguranganStok;
use App\Models\Product;
use Illuminate\Http\Request;

class PenguranganStokController extends Controller
{
    public function indexKurangStok()
    {
        $stoks = LogPenguranganStok::all();
        return view('dashboard.admin.products.index_kurang_stok', compact('stoks'));
    }

    public function createKurangStok()
    {
        $products = Product::all();
        return view('dashboard.admin.products.create_kurang_stok', compact('products'));
    }

    public function updateStokKurang(Request $request)
    {
        $request->validate([
            'stok' => 'required',
            'product_id' => 'required',
        ]);

        LogPenguranganStok::create([
            'product_id' => $request->product_id,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);

        $product = Product::find($request->product_id);
        $product->stok -= $request->stok;
        $product->save();

        return redirect()->route('products.kurang-stok')->with('success', 'Stock berhasil dikurangi');
    }

}
