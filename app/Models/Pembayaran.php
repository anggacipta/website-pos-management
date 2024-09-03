<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_harga',
        'uang_diterima',
        'kembalian',
        'metode_pembayaran',
        'status',
        'catatan',
        'diskon',
        'pajak',
        'user_id'
    ];

    public function pemasukan()
    {
        return $this->hasOne(Pemasukan::class, 'pembayaran_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PembayaranItems::class);
    }
}
