<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\KondisiBarang;
use App\Models\MerkBarang;
use App\Models\Ruangan;
use App\Models\SumberPengadaan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $kondisi = KondisiBarang::query()->where('kondisi_barang', 'maintenance')->get();
        return view('dashboard.admin.barang.index', compact('barangs', 'kondisi'));
    }

    public function create()
    {
//        $totalBarang = Barang::where('ruang_id', $ruangan_id)->count() + 1;
//        $kode_barang = 'BRG' . str_pad($totalBarang, 3, '0', STR_PAD_LEFT);
        $unit_kerjas = UnitKerja::all();
        $merk_barangs = MerkBarang::all();
        $jenis_barangs = JenisBarang::all();
        $kondisi_barangs = KondisiBarang::all();
        $sumber_pengadaans = SumberPengadaan::all();
        return view('dashboard.admin.barang.create', compact('unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function ruangan(Request $request)
    {
        $search = $request->get('search');
        $ruangans = Ruangan::where('nama_ruang', 'like', "%$search%")->get();
        return view('dashboard.admin.barang.ruangan', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
            'kondisi_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $barangData = $request->all();

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $barangData['tahun_pengadaan'] = Carbon::createFromFormat('m/d/Y', $request->tahun_pengadaan)->format('Y-m-d');

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension(); // Menambahkan timestamp ke nama file
            $request->photo->move(public_path('images'), $imageName);
            $barangData['photo'] = $imageName;
        }

        Barang::create($barangData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $unit_kerjas = UnitKerja::all();
        $merk_barangs = MerkBarang::all();
        $jenis_barangs = JenisBarang::all();
        $kondisi_barangs = KondisiBarang::all();
        $sumber_pengadaans = SumberPengadaan::all();
        return view('dashboard.admin.barang.edit', compact('barang', 'unit_kerjas', 'merk_barangs',
            'jenis_barangs', 'kondisi_barangs', 'sumber_pengadaans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required',
            'unit_kerja_id' => 'required',
            'kondisi_barang_id' => 'required',
            'jenis_barang_id' => 'required',
            'merk_barang_id' => 'required',
            'sumber_pengadaan_id' => 'required',
            'tahun_pengadaan' => 'required|date_format:m/d/Y',
            'harga' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $barang = Barang::find($id);
        $barangData = $request->all();

        // Convert 'tahun_pengadaan' to 'YYYY-MM-DD' format
        $barangData['tahun_pengadaan'] = Carbon::createFromFormat('m/d/Y', $request->tahun_pengadaan)->format('Y-m-d');

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension(); // Menambahkan timestamp ke nama file
            $request->photo->move(public_path('images'), $imageName);
            $barangData['photo'] = $imageName;
        }

        $barang->update($barangData);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diubah');
    }

    public function destroy($id)
    {
        Barang::find($id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    public function countByUnitKerja($unitKerjaId)
    {
        $count = Barang::where('unit_kerja_id', $unitKerjaId)->count();
        return response()->json(['count' => $count]);
    }
}
