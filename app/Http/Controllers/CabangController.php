<?php

namespace App\Http\Controllers;

use App\Models\cabang;
use App\Http\Requests\StorecabangRequest;
use App\Http\Requests\UpdatecabangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view("cabang", 
        ["cabang" => cabang::all(),
        "title"=>"Cabang"]);
    }
    public function index()
    {
        return view("addpegawai", 
        ["cabang" => cabang::all(),
        "title"=>"pegawai"]);
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
        $cabang = DB::table('cabangs as c')
                    ->where('c.id',$request->cabang)
                    ->select('c.*')
                    ->first();
        $jumlah = DB::table('cabangs as c')
                    ->where('c.id',$request->cabang)
                    ->select('c.*')
                    ->count('id');              

        $data['id'] =$cabang->id;
        $data['nama'] =$cabang->nama;
        $data['alamat'] =$cabang->alamat;
        $data['no_telepon'] =$cabang->no_telepon;
        $data['jumpegawai'] =$jumlah;
        $data['latitude'] =$cabang->latitude;
        $data['longtitude'] =$cabang->longtitude;
        return response()->json($data);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecabangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecabangRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required'
        ]);
        cabang::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/cabang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function show(cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function edit(cabang $cabang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecabangRequest  $request
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecabangRequest $request, cabang $cabang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(cabang $cabang)
    {
        //
    }
}
