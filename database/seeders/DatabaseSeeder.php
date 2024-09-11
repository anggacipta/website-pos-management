<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        $this->call([
            AlamatSeeder::class,
            CategorySeeder::class,
            KategoriPengeluaranSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // Retrieve roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create users and assign roles
        $adminUser = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'role_id' => $adminRole->id,
        ]);
        $adminUser->assignRole($adminRole->name);

        $userUser = User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => bcrypt('user'),
            'email' => 'coba@gmail.com',
            'role_id' => $userRole->id,
        ]);
        $userUser->assignRole($userRole->name);
    }
}
