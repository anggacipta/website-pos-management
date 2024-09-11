<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'data.master',
            'data.produk',
            'tambah.produk',
            'update.produk',
            'hapus.produk',
            'tambah.stok',
            'kurangi.stok',
            'log.stok',
            'tambah.pengeluaran',
            'log.pengeluaran',
            'users',
            'roles',
            'permission',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
