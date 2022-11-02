<?php

namespace App\Http\Controllers;
Use \Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\absen;
use App\Http\Requests\StoreabsenRequest;
use App\Http\Requests\UpdateabsenRequest;
use App\Models\pegawai;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("absen", 
        ["absen" => absen::all(),
        "title"=>"Absen",
        "pegawai" => pegawai::all()]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreabsenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreabsenRequest $request)
    {
        $time = Carbon::now();
        $validatedData = $request->validate([
            'id_pegawai' => 'required',
            'tanggal' => 'required',
            'jam_keluar'=>'',
            'jam_masuk'=>'',
            'latitude'=>'required',
            'longtitude'=>'required'
        ]);
        $validatedData['jam_masuk'] = $time ;
        $presensi = absen::where([
            ['id_pegawai','=',auth()->user()->id],
            ['tanggal','=',$validatedData['tanggal']],
        ])->first();
        if ($presensi){
            return redirect('/absen')->with('danger','Data Sudah Ada');
        }else{
            absen::create($validatedData);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/absen');
    }
    
    public function checkout(Request $request)
    {
        dd($request);
        $time = Carbon::now();
        $validatedData = $request->validate([
            'id_pegawai' => 'required',
            'tanggal' => 'required',
            'jam_keluar'=>'',
        ]);
        $validatedData['jam_keluar'] = $time ;
        $presensi = absen::where([
            ['id_pegawai','=',auth()->user()->id],
            ['tanggal','=',$validatedData['tanggal']],
        ])->first();

        if ($presensi->jam_keluar == ""){
            $presensi->where('tanggal',$request->tanggal)->update($validatedData);
        }else{
            return redirect('/absen')->with('danger','Data Sudah Ada');
        }

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/absen');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function show(absen $absen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function edit(absen $absen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateabsenRequest  $request
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateabsenRequest $request, absen $absen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absen  $absen
     * @return \Illuminate\Http\Response
     */
    public function destroy(absen $absen)
    {
        //
    }
}
