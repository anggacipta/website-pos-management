<?php

namespace Database\Seeders;

use App\Models\KategoriPengeluaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Belanja',
            'Tagihan',
            'Gaji',
            'Piutang Karyawan'
        ];

        foreach ($categories as $category) {
            KategoriPengeluaran::create(['nama_kategori' => $category]);
        }
    }
}
