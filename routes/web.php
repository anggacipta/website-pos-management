<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard/admin/index');
    });

    // Route Ruangan
    Route::resource('ruangan', \App\Http\Controllers\RuanganController::class);

    // Route Barang
    Route::resource('barang', \App\Http\Controllers\BarangController::class);

    // Route Jenis Barang
    Route::resource('jenis-barang', \App\Http\Controllers\Admin\JenisBarangController::class);

    // Route Merk Barang
    Route::resource('merk-barang', \App\Http\Controllers\Admin\MerkBarangController::class);

    // Route Kondisi Barang
    Route::resource('kondisi-barang', \App\Http\Controllers\Admin\KondisiBarangController::class);

    // Route Sumber Pengadaan
    Route::resource('sumber-pengadaan', \App\Http\Controllers\Admin\SumberPengadaanController::class);

    // Route Unit Kerja
    Route::resource('unit-kerja', \App\Http\Controllers\Admin\UnitKerjaController::class);

    // Route Maintenance
    Route::resource('maintenance', \App\Http\Controllers\Admin\MaintenanceController::class);

    // Extra Route Maintenance
    Route::get('maintenance-lanjutan', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceLanjutan'])->name('maintenance.lanjutan.index');
    Route::get('maintenance-rusak', [\App\Http\Controllers\Admin\MaintenanceController::class, 'indexMaintenanceRusak'])->name('maintenance.rusak.index');
    Route::get('maintenance/create/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::get('maintenance-lanjutan/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceLanjutan'])->name('maintenance.lanjutan');
    Route::put('maintenan-lanjutan/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceLanjutan'])->name('maintenance.lanjutan.update');
    Route::get('maintenance-rusak/{maintenanceId}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'createMaintenanceRusak'])->name('maintenance.rusak');
    Route::put('maintenance-rusak/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateMaintenanceRusak'])->name('maintenance.rusak.update');
    Route::delete('maintenance-diperbaiki/{id}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'maintenanceDiperbaiki'])->name('maintenance.diperbaiki');

    // Get Barang
    Route::get('barang/count/{unitKerjaId}', [\App\Http\Controllers\BarangController::class, 'countByUnitKerja']);
});

Route::middleware(['auth', 'checkrole:user'])->group(function () {
    Route::get('/user', function () {
        return view('dashboard/admin/index');
    });
});

//Route::middleware(['checkrole:admin'])->group(function () {
//
//});
//
//Route::middleware('checkrole:user')->group(function () {
//    Route::get('/user', function () {
//        return view('dashboard/admin/index');
//    });
//
//    // Route Ruangan
//    Route::resource('ruangan', \App\Http\Controllers\RuanganController::class);
//
//    // Route Barang
//    Route::resource('barang', \App\Http\Controllers\BarangController::class);
//
//    // Route Jenis Barang
//    Route::resource('jenis-barang', \App\Http\Controllers\Admin\JenisBarangController::class);
//});
//
