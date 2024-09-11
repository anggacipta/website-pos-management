<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesPermissions = [
            'kasir' => ['dashboard', 'data.produk', 'pos.system'],
            'admin' => ['dashboard', 'data.master', 'data.produk', 'tambah.produk', 'update.produk', 'hapus.produk', 'tambah.stok', 'kurangi.stok', 'data.pemasukan',
                'log.stok', 'tambah.pengeluaran', 'log.pengeluaran', 'users', 'roles', 'permission', 'pos.system'],
        ];

        foreach ($rolesPermissions as $role => $permissions) {
            $role = Role::where('name', $role)->first();
            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
