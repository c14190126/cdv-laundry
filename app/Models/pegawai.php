<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    use HasFactory;
    public function cabang()
    {
        return $this->belongsTo(cabang::class, 'id_cabang');
    }
    public function punishment()
    {
        return $this->hasMany(punishment::class);
    }
    public function gaji()
    {
        return $this->hasMany(gaji::class);
    }
    public function absen()
    {
        return $this->hasMany(absen::class);
    }
    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }
    
}