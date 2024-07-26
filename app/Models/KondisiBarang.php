<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBarang extends Model
{
    use HasFactory;

    protected $fillable = ['kondisi_barang'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kondisi_barang_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'kondisi_barang_id');
    }
}
