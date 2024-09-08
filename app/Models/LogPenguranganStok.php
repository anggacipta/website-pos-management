<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPenguranganStok extends Model
{
    use HasFactory;

    protected $table = 'log_pengurangan_products';
    protected $fillable = ['product_id', 'stok', 'keterangan'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
