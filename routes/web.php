<?php

use Illuminate\Support\Facades\Route;

// Route for server
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');

    // Route Warga
    Route::resource('warga', \App\Http\Controllers\Admin\WargaController::class);
    Route::post('warga/{id}/send-reminder', [\App\Http\Controllers\Admin\WargaController::class, 'sendReminder'])->name('warga.send-reminder');

    // Route Pembayaran
    Route::resource('pembayaran', \App\Http\Controllers\Admin\PembayaranController::class);

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
