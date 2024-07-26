<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\KondisiBarang;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Maintenance')
                    ->orWhere('kondisi_barang', 'like', 'maintenance');
            })
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

    public function indexMaintenanceRusak()
    {
        $maintenances = Maintenance::query()
            ->whereHas('kondisiBarang', function ($query) {
                $query->where('kondisi_barang', 'like', 'Rusak')
                    ->orWhere('kondisi_barang', 'like', 'rusak');
            })
            ->get();
        return view('dashboard.admin.maintenance.index_maintenance_lanjutan', compact('maintenances'));
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

            return redirect()->route('barang.index')->with('success', 'Data maintenance berhasil ditambahkan');
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

            $id = $kondisiBarang->id;

            $maintenance = Maintenance::find($maintenanceId);
            return view('dashboard.admin.maintenance.maintenance_lanjut', compact('maintenance', 'kondisiBarang'));
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
            ]);

            $maintenanceData = $request->all();
            Maintenance::find($id)->update($maintenanceData);

            $barang = Barang::find($request->barang_id);
            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Maintenance Lanjutan')->first()->id
            ]);

            return redirect()->route('maintenance.index')->with('success', 'Data maintenance lanjutan berhasil diupdate');
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

            return redirect()->route('maintenance.index')->with('success', 'Data maintenance rusak berhasil diupdate');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@updateMaintenanceRusak: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data maintenance rusak');
        }
    }

    public function maintenanceDiperbaiki($id)
    {
        try {
            $maintenance = Maintenance::find($id);
            $barangId = $maintenance->barang_id;
            $barang = Barang::find($barangId);

            $barang->update([
                'kondisi_barang_id' => KondisiBarang::where('kondisi_barang', 'Normal')->first()->id
            ]);
            $maintenance->delete();

            return redirect()->route('maintenance.index')->with('success', 'Barang berhasil diperbaiki');
        } catch (\Exception $e) {
            Log::error('Error in MaintenanceController@destroy: ', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus data maintenance');
        }
    }
}
