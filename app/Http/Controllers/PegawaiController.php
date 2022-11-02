<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\cabang;
use App\Models\punishment;
use App\Http\Requests\StorepegawaiRequest;
use App\Http\Requests\UpdatepegawaiRequest;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        
        return view("pegawai", 
        ["pegawai" => pegawai::all(),
        "title"=>"Pegawai",
        "cabang" => cabang::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addpegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorepegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepegawaiRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:pegawais',
            'alamat' => 'required',
            'no_telp' => 'required|unique:pegawais|min:10|max:12',
            'email' => 'required|unique:pegawais',
            'password' => 'required|min:8',
            'user_role' => 'required',
            'id_cabang' => 'required'
        ]);
        $validatedData['password']= Hash::make($validatedData['password']);
        pegawai::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/addpegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepegawaiRequest  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepegawaiRequest $request, pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai)
    {
        //
    }
}
