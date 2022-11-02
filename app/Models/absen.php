<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;
    protected $fillable=['id_pegawai','tanggal','jam_masuk','jam_keluar','latitude','longtitude'];

    public function pegawai()
    {
        return $this->belongsTo(pegawai::class,'id_pegawai');
    }
}
