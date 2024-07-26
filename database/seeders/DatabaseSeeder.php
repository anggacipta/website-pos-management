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
                'name' => 'User',
            ],
        );
        Role::create(
            [
                'name' => 'Admin',
            ],
        );
        User::create([
            'name' => 'Admin',
            'username' => 'admin', // Add this line
            'password' => bcrypt('admin'),
            'email' => 'admin@gmail.com',
            'role_id' => 2,
        ]);
        $this->call([
            KondisiBarang::class,
            UnitKerja::class,
            JenisBarang::class,
            MerkBarang::class,
        ]);
    }
}
