<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah_barang',
        'harga_barang',
        'potongan',
        'satuan',
        'nama_toko',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengeluaran::class);
    }
}
