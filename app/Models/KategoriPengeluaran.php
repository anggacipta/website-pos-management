<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KategoriPengeluaran extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori'];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('kategori_pengeluarans')->where('id', 1)->exists()) {
            DB::table('kategori_pengeluarans')->insert([
                'id' => 1,
                'nama_kategori' => 'Default Kategori'
            ]);
        }
    }

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
