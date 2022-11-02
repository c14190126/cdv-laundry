<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;
    protected $fillable=['id_transaksi','layanan_id','promo','quantity','subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(layanan::class);
    }
}
