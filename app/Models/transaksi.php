<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function pelanggan()
{
    return $this->belongsTo(pelanggan::class, 'id_pelanggan');

    // return $this->hasMany(Pelanggan::class);
}
    public function pegawai()
{
    return $this->belongsTo(pegawai::class, 'id_pegawai');

    // return $this->hasMany(Pelanggan::class);
}  
    public function detail()
{
    return $this->hasMany(detail_transaksi::class);
}     
}
