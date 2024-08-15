<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'bulan',
        'tahun',
        'jumlah',
        'status',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
