<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $fillable = ['pembayaran_id', 'jumlah'];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, "pembayaran_id");
    }
}
