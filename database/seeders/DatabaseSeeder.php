<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        Role::create(
            [
                'name' => 'user',
            ],
        );
        Role::create(
            [
                'name' => 'iprs',
            ],
        );
        Role::create(
            [
                'name' => 'server',
            ],
        );
        $serverRole = Role::where('name', 'server')->first();
        $iprsRole = Role::where('name', 'iprs')->first();
        User::create([
            'name' => 'Admin',
            'username' => 'admin', // Add this line
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'role_id' => $iprsRole->id,
        ]);
        User::create([
            'name' => 'Server',
            'username' => 'server', // Add this line
            'password' => bcrypt('server'),
            'email' => 'server@gmail.com',
            'role_id' => $serverRole->id,
        ]);
        $this->call([
            KondisiBarang::class,
            UnitKerja::class,
            JenisBarang::class,
            MerkBarang::class,
            SumberPengadaan::class,
            VendorSeeder::class
        ]);
    }
}
