<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\cabang;
use App\Models\pegawai;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\cabang::factory(10)->create();

        cabang::create([
            'nama'=>'Darjo',
            'alamat'=>'sidoarjo',
            'no_telepon'=>'08956231223',
            'longtitude'=> 7.2,
            'latitude'=> 6.3
        ]);
        
        pegawai::create([
            'nama'=> 'david',
            'id_cabang'=> 1,
            'alamat'=>'dukuh kupang',
            'no_telp'=>'087456311',
            'email'=>'superadmin@example.com',
            'password'=>bcrypt('12345678'),
            'user_role'=>'superadmin',
            'gaji_pokok'=>10000
        ]);
    }
}
