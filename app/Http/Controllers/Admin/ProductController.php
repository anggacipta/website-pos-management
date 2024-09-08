<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LogPenguranganStok;
use App\Models\Product;
use App\Service\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $products = Product::all();
        return view('dashboard.admin.products.index', compact('products'));
    }

    public function create()
    {
        $kategoris = Category::all();
        return view('dashboard.admin.products.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,svg,webp',
            'kategori_id' => 'required',
        ]);

        $imagePath = $this->imageUploadService->upload($request->file('gambar'));

        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $imagePath,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('products.create')->with('success', 'Product berhasil dibuat');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $kategoris = Category::all();
        return view('dashboard.admin.products.edit', compact('product', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
        ]);

        $product = Product::find($id);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'required|image|mimes:jpg,jpeg,png,svg,webp',
            ]);

            // Delete the old image file if it exists
            $oldImagePath = public_path($product->gambar);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload the new image and update the product's image path
            $imagePath = $this->imageUploadService->upload($request->file('gambar'));
            $product->gambar = $imagePath;
        }

        $product->nama_produk = $request->nama_produk;
        $product->harga = $request->harga;
        $product->kategori_id = $request->kategori_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            // Delete the file if it exists
            $filePath = public_path($product->gambar);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the Barang instance
            $product->delete();

            return redirect()->route('products.index')->with('error', 'Produk berhasil dihapus');
        }

        return redirect()->route('barang.index')->with('error', 'Product tidak ditemukan');
    }

    public function tambahStok($id)
    {
        $product = Product::find($id);
        return view('dashboard.admin.products.create_stok', compact('product'));
    }

    public function updateStokTambah(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required',
        ]);

        $product = Product::find($id);
        $product->stok += $request->stok;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Stock berhasil ditambahkan');
    }
}
