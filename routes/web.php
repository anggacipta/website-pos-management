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
