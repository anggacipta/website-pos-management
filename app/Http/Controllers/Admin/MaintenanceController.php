<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiBarang;
use App\Models\Maintenance;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $maintenanceConditionId = KondisiBarang::where('kondisi_barang', 'Maintenance')->first()->id;

        $maintenances = Maintenance::query()
            ->when($user->role->name === 'server', function ($query) {
                $query->whereHas('barang.jenisBarang', function ($query) {
                    $query->whereIn('jenis_barang', ['Komputer', 'Elektronik']);
                });
            })
            ->when($user->role->name === 'iprs', function ($query) {
                $query->whereHas('barang.jenisBarang', function ($query) {
                    $query->whereIn('jenis_barang', ['Elektronik', 'Alat Kesehatan', 'Alat Rumah Tangga']);
                });
            })
            ->where('kondisi_barang_id', $maintenanceConditionId)
            ->get();
        return view('dashboard.admin.maintenance.index', compact('maintenances'));
    }

    public function indexMaintenanceLanjutan()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Maintenance Lanjutan')
                    ->orWhere('kondisi_barang', 'like', 'maintenance lanjutan');
            })
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_lanjutan', compact('maintenances'));
    }

    public function indexMaintenanceDiperbaiki()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Berhasil Diperbaiki')
                    ->orWhere('kondisi_barang', 'like', 'berhasil diperbaiki');
            })
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_diperbaiki', compact('maintenances'));
    }

    public function indexMaintenanceRusak()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Rusak')
                    ->orWhere('kondisi_barang', 'like', 'rusak');
            })
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_rusak', compact('maintenances'));
    }

    public function create($barangId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Maintenance')
                ->orWhere('kondisi_barang', 'like', 'maintenance')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $barang = Barang::find($barangId);
            return view('dashboard.admin.maintenance.create', compact('barang', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance' atau 'maintenance' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'alasan_rusak' => 'required',
                'kondisi_barang_id' => 'required',
                'barang_id' => 'required',
            ]);

            $maintenanceData = $request->all();
            Maintenance::create($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Maintenance')->first()->id
            ]);

            return redirect()->route('maintenance.index')->with('success', 'Data maintenance berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@store: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menambahkan data maintenance');
        }
    }

    public function createMaintenanceLanjutan($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Maintenance Lanjutan')
                ->orWhere('kondisi_barang', 'like', 'maintenance lanjutan')
                ->firstOrFail();

            $vendors = Vendor::all();

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_lanjut', compact('maintenance', 'kondisiBarang', 'vendors'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance Lanjutan' atau 'maintenance lanjutan' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function updateMaintenanceLanjutan(Request $request, $id)
    {
        try {
            $request->validate([
                'catatan' => 'required',
                'harga' => 'required',
                'kondisi_barang_id' => 'required',
                'barang_id' => 'required',
                'vendor_id' => 'required',
            ]);

            $maintenanceData = $request->all();
            Maintenance::find($id)->update($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Maintenance Lanjutan')->first()->id
            ]);

            return redirect()->route('maintenance.lanjutan.index')->with('success', 'Data maintenance lanjutan berhasil diupdate');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@updateMaintenanceLanjutan: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data maintenance lanjutan');
        }
    }

    public function createMaintenanceRusak($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Rusak')
                ->orWhere('kondisi_barang', 'like', 'rusak')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_rusak', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // kondisi_barang 'Maintenance Lanjutan' atau 'maintenance lanjutan' tidak ditemukan
            // Anda bisa mengarahkan user ke halaman error atau memberikan pesan error
        }
    }

    public function updateMaintenanceRusak(Request $request, $id)
    {
        try {
            $request->validate([
                'catatan' => 'required',
                'kondisi_barang_id' => 'required',
                'barang_id' => 'required',
            ]);

            $maintenanceData = $request->all();
            Maintenance::find($id)->update($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Rusak')->first()->id
            ]);

            return redirect()->route('maintenance.rusak.index')->with('success', 'Data maintenance rusak berhasil diupdate');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@updateMaintenanceRusak: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data maintenance rusak');
        }
    }

    public function createBerhasilDiperbaiki($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Normal')
                ->orWhere('kondisi_barang', 'like', 'normal')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_diperbaiki', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maintenance.index')->with('error', 'Maintenance or Kondisi Barang not found.');
        }
    }

    public function createBerhasilDiperbaikiLanjutan($maintenanceId)
    {
        try {
            $kondisiBarang = KondisiBarang::where('kondisi_barang', 'like', 'Normal')
                ->orWhere('kondisi_barang', 'like', 'normal')
                ->firstOrFail();

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_diperbaiki_lanjutan', compact('maintenance', 'kondisiBarang'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maintenance.index')->with('error', 'Maintenance or Kondisi Barang not found.');
        }
    }
    public function updateMaintenanceDiperbaiki($id, Request $request)
    {
        try {
            $maintenance = Maintenance::find($id);
            $barangId = $maintenance->barang_id;
            $barang = Barang::find($barangId);

            $normalKondisiBarangId = KondisiBarang::where('kondisi_barang', 'Normal')->first()->id;
            $berhasilDiperbaikiKondisiBarangId = KondisiBarang::where('kondisi_barang', 'Berhasil Diperbaiki')->first()->id;

            $barang->update([
                'kondisi_barang_id' => $normalKondisiBarangId
            ]);

            $maintenance->update([
                'kondisi_barang_id' => $berhasilDiperbaikiKondisiBarangId,
                'catatan' => $request->catatan,
                'harga' => $request->harga,
                'barang_id' => $request->barang_id,
                'diperbaiki' => $request->diperbaiki,
                'disetujui' => auth()->user()->name,
            ]);

            return redirect()->route('maintenance.diperbaiki.index')->with('success', 'Barang berhasil diperbaiki');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@destroy: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus data maintenance');
        }
    }
}
