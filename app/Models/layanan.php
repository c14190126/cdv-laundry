<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class layanan extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function detail()
    {
        return $this->hasMany(detail_transaksi::class);

    }
}
