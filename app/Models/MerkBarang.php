<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerkBarang extends Model
{
    use HasFactory;

    protected $fillable = ['merk_barang'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'merk_barang_id');
    }
}
