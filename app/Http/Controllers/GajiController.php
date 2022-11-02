<?php

namespace App\Http\Controllers;

use App\Models\gaji;
use App\Http\Requests\StoregajiRequest;
use App\Http\Requests\UpdategajiRequest;
use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view("gaji", 
        ["gaji" => gaji::all(),
        "title"=>"Gaji",
        "pegawai" => pegawai::all()],);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function fetch(Request $request)
    {
        $diskon = DB::table('pegawais as p')
                    ->where('p.id',$request->id_pegawai)
                    ->select('p.*')
                    ->first();
                    
        $potongan = DB::table('punishments as p')
        ->where('p.pegawai_id',$request->id_pegawai)
        ->select('p.*')
        ->sum('p.potongan');

        $absen = DB::table('absens as a')
        ->where('a.id_pegawai',$request->id_pegawai)
        ->select('a.id')
        ->count('a.id');

        $data['gaji_pokok'] =$diskon->gaji_pokok;
        $data['potongan'] =$potongan;
        $data['absen'] =$absen;
        return response()->json($data);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoregajiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregajiRequest $request)
    {
        $validatedData = $request->validate([
            'tanggal_cetak' => 'required',
            'id_pegawai' => 'required',
            'gaji_pokok' => 'required',
            'potongan'=>'',
            'bonus'=>'',
            'total_gaji'=>'',
        ]);

        $validatedData['total_gaji']=$request->gaji_pokok*$request->presensi-$request->potongan+$request->bonus;

        gaji::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/gaji');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show(gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(gaji $gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategajiRequest  $request
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategajiRequest $request, gaji $gaji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(gaji $gaji)
    {
        //
    }
}
