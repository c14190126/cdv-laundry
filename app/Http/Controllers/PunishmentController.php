<?php

namespace App\Http\Controllers;

use App\Models\punishment;
use App\Models\pegawai;
use App\Http\Requests\StorepunishmentRequest;
use App\Http\Requests\UpdatepunishmentRequest;

class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("punishment", 
        ["punishment" => punishment::all(),
        "title"=>"Punishment",
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
     * @param  \App\Http\Requests\StorepunishmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepunishmentRequest $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'pegawai_id' => 'required',
            'jumlah_barang' => 'required',
            'potongan' => 'required',
            'keterangan' => 'required'
        ]);
        // dd($validatedData['potongan']);
        punishment::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/punishment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function show(punishment $punishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function edit(punishment $punishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepunishmentRequest  $request
     * @param  \App\Models\punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepunishmentRequest $request, punishment $punishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\punishment  $punishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(punishment $punishment)
    {
        //
    }
}
