<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranItems extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_items';

    protected $fillable = [
        'pembayaran_id',
        'product_id',
        'jumlah',
        'harga',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
