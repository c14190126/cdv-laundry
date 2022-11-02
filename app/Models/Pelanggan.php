<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $guarded=['id','total_poin'];
    public function transaksi()
    {
        return $this->hasMany(transaksi::class);

    }

}

