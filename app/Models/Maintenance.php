<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'alasan_rusak',
        'catatan',
        'harga',
        'kondisi_barang_id',
        'barang_id'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function kondisiBarang()
    {
        return $this->belongsTo(KondisiBarang::class, 'kondisi_barang_id');
    }
}
