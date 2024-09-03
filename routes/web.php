<?php

use Illuminate\Support\Facades\Route;

// Route for server
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    // Route Category
    Route::resource('kategori', \App\Http\Controllers\Admin\CategoryController::class);

    // Route Product
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('tambah-stok/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'tambahStok'])->name('products.tambah-stok');
    Route::get('kurang-stok/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'kurangStok'])->name('products.kurang-stok');
    Route::put('update-stok-tambah/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'updateStokTambah'])->name('products.update-stok-tambah');
    Route::put('update-stok-kurang/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'updateStokKurang'])->name('products.update-stok-kurang');

    // Route POS
    Route::get('/pos', [\App\Http\Controllers\Admin\POSController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart/{id}', [\App\Http\Controllers\Admin\POSController::class, 'addToCart'])->name('pos.addToCart');
    Route::post('/pos/increase-cart-item/{id}', [\App\Http\Controllers\Admin\POSController::class, 'increaseCartItem'])->name('pos.increaseCartItem');
    Route::post('/pos/decrease-cart-item/{id}', [\App\Http\Controllers\Admin\POSController::class, 'decreaseCartItem'])->name('pos.decreaseCartItem');
    Route::get('/pos/search', [\App\Http\Controllers\Admin\POSController::class, 'search'])->name('pos.search');
    Route::post('/pos/process-payment', [\App\Http\Controllers\Admin\POSController::class, 'processPayment'])->name('pos.processPayment');
    Route::get('/pos/invoice/{id}', [\App\Http\Controllers\Admin\POSController::class, 'showInvoice'])->name('pos.showInvoice');
    // Route Pembayaran
    Route::resource('pembayaran', \App\Http\Controllers\Admin\PembayaranController::class);

    // Route Pengeluaran
    Route::get('pengeluaran', [\App\Http\Controllers\Admin\PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('pengeluaran/create', [\App\Http\Controllers\Admin\PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('pengeluaran/store', [\App\Http\Controllers\Admin\PengeluaranController::class, 'store'])->name('pengeluaran.store');

    // Route Pemasukan
    Route::get('pemasukan', [\App\Http\Controllers\Admin\PemasukanController::class, 'index'])->name('pemasukan.index');

    // Route Roles
    Route::resource('roles', \App\Http\Controllers\RolePermissionController::class);

    // Route Permissions
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);

    // Extra Route Roles and Permissions
    Route::get('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'showForm'])->name('role-assignment.form');
    Route::post('/role-assignment', [\App\Http\Controllers\RolePermissionController::class, 'assignRole'])->name('role-assignment.assign');
    Route::get('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'edit'])->name('roles.permissions.edit');
    Route::put('roles/{role}/permissions', [\App\Http\Controllers\RolePermissionController::class, 'update'])->name('roles.permissions.update');

    // Route Users
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});
