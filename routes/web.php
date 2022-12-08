<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\TransaksiController;
use App\Models\detail_transaksi;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//cabang
Route::get('/cabang', [CabangController::class,'home'])->middleware(('auth'));
Route::post('/cabang', [CabangController::class,'store']);
Route::get('/cabang/fetchcabang', [CabangController::class,'fetch']);

//pegawai
Route::get('/pegawai', [PegawaiController::class,'index'])->middleware(('auth'));
Route::get('/addpegawai', [CabangController::class,'index'])->middleware(('auth'));
Route::post('/addpegawai', [PegawaiController::class,'store']);
//pelanggan
Route::get('/pelanggan', [PelangganController::class,'index'])->middleware(('auth'));
Route::get('/addpelanggan', [PelangganController::class,'create'])->middleware(('auth'));
Route::post('/addpelanggan', [PelangganController::class,'store']);

//transaksi
Route::get('/transaksi', [TransaksiController::class,'index'])->middleware(('auth'));
Route::get('/nota/{id}', [TransaksiController::class,'nota'])->middleware(('auth'));
Route::post('/transaksi', [TransaksiController::class,'store']);
Route::put('/save_transaksi/{transaksi:id_transaksi}', [TransaksiController::class,'update']);

//detail
Route::get('/transaksi/{transaksi:id_transaksi}', [DetailTransaksiController::class,'index']);
Route::post('/detail', [DetailTransaksiController::class,'store']);
Route::get('/detail/fetchdiskon', [DetailTransaksiController::class,'fetch']);
Route::delete('/transaksi/{transaksi:id_transaksi}', [TransaksiController::class,'destroy']);
Route::delete('/detail_transaksi/{detail_transaksi:id}', [DetailTransaksiController::class,'destroy']);

//promo
Route::post('/promo', [PromoController::class,'store']);
Route::get('/promo', [PromoController::class,'index'])->middleware(('auth'));
Route::delete('/promo/{promo:nama_promo}', [PromoController::class,'destroy']);

//gaji
Route::get('/listgaji', [GajiController::class,'indexlist'])->middleware(('auth'));
Route::get('/gaji', [GajiController::class,'index'])->middleware(('auth'));
Route::get('/detailgaji/{gaji::id}', [GajiController::class,'indexdetailgaji'])->middleware(('auth'));
Route::get('/gaji/fetchgaji', [GajiController::class,'fetch']);
Route::post('/addgaji', [GajiController::class,'store']);

//pelanggaran
Route::get('/punishment', [PunishmentController::class,'index'])->middleware(('auth'));
Route::post('/punishment', [PunishmentController::class,'store']);

//absen
Route::get('/absen', [AbsenController::class,'index'])->middleware(('auth'));
Route::post('/absen', [AbsenController::class,'store']);
Route::post('/checkout', [AbsenController::class,'checkout']);

//layanan
Route::get('/layanan', [LayananController::class,'index'])->middleware(('auth'));
Route::get('/editlayanan/{id}', [LayananController::class,'edit']);
Route::post('/layanan', [LayananController::class,'store']);
Route::post('/editlayanan/{id}', [LayananController::class,'update']);

//login
Route::get('/login', [LoginController::class,'index'])->name('login')->middleware(('guest'));
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);

