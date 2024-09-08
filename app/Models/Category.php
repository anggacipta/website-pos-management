<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
      'nama_kategori'
    ];

    public static function ensureDefaultCategoryExists()
    {
        if (!DB::table('categories')->where('id', 1)->exists()) {
            DB::table('categories')->insert([
                'id' => 1,
                'nama_kategori' => 'Default Kategori'
            ]);
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }
}
