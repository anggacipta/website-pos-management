<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $fillable = ['unit_kerja'];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'unit_kerja_id');
    }
}
