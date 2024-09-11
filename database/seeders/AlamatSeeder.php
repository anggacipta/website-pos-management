<?php

namespace Database\Seeders;

use App\Models\Alamat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alamat::create([
            'alamat' => 'Rest Area KM 626 B Ngawi - Kertosono',
            'no_telp' => '081234567890',
            'kota' => 'Madiun'
        ]);
    }
}
