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

Route::get('/test-lte', function () {
    return view('dashboard/admin/index');
});

Route::get('/barang/ruangan', [\App\Http\Controllers\BarangController::class, 'ruangan'])->name('barang.ruangan');

// Route Ruangan
Route::resource('ruangan', \App\Http\Controllers\RuanganController::class);

// Route Barang
Route::resource('barang', \App\Http\Controllers\BarangController::class);

Route::get('/barang/create/{ruangan_id}', 'App\Http\Controllers\BarangController@create')->name('barang.create');
Route::post('/barang/store', 'App\Http\Controllers\BarangController@store')->name('barang.store');
