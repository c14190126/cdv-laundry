<?php

namespace App\Http\Controllers;

use App\Models\gaji;
use App\Http\Requests\StoregajiRequest;
use App\Http\Requests\UpdategajiRequest;
use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DetailGajis;

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
    public function indexlist()
    {
        
        return view("listgaji", 
        ["gaji" => gaji::all(),
        "title"=>"Gaji",
        "pegawai" => pegawai::all()],);
    }
    public function indexdetailgaji($id)
    {
        $detail = DB::table('detail_gajis as d')
        ->join('pegawais as p','p.id','=','d.id_pegawai')
        ->where('d.gaji_id',$id)
        ->select('d.*','p.nama')
        ->get();       

        return view("detailgaji", 
        ["detail" => $detail,
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
        // $validatedData = $request->validate([
        //     'tanggal_cetak' => 'required',
        //     'id_pegawai' => 'required',
        //     'gaji_pokok' => 'required',
        //     'potongan'=>'',
        //     'bonus'=>'',
        //     'total_gaji'=>'',
        // ]);

        // $validatedData['total_gaji']=$request->gaji_pokok*$request->presensi-$request->potongan+$request->bonus;

        // gaji::create($validatedData);

        // $request->session()->flash('success','Penyimpanan Berhasil');
        // return redirect('/gaji');
        // dd($request);
        DB::beginTransaction();
        try{
            // PO Bahan Baku
            DB::table('gajis')->insert([
                "tanggal_cetak" => $request->tanggal_cetak,              
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
            
            DB::commit();
            
            // Purchase Order Bahan Baku
            $gaji_id = DB::table('gajis')
                               ->max('id');
            $count_detail_bahan_baku = count($request->input('id_pegawai'));
            for($i = 0; $i < $count_detail_bahan_baku; $i++)
            {
            $total_gaji= $request->gaji_pokok[$i]*$request->presensi[$i]+$request->bonus[$i]-$request->cut[$i];
            if($request->bonus[$i] ==null)
            {
                $bonus=0;
            }
            else{
                $bonus=$request->bonus[$i];
            }
            
                DB::table('detail_gajis')->insert([                                   
                    "id_pegawai" => $request->id_pegawai[$i],  
                    "gaji_id"=> $gaji_id,             
                    "gaji_pokok" => $request->gaji_pokok[$i],
                    "bonus" => $bonus,
                    "potongan" => $request->cut[$i],
                    "total_gaji"=> $total_gaji,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),             
                ]);
                
            }

        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $e->getMessage();
            return redirect('/gaji')->with("error", "Gaji Tidak Berhasil Di Input");
        }      
        return redirect('/gaji')->with("create_success", "Gaji Berhasil Di Input");

        
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
