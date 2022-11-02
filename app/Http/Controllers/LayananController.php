<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use App\Http\Requests\StorelayananRequest;
use App\Http\Requests\UpdatelayananRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("layanan", 
        ["layanan" => layanan::all(),
        "title"=>"Layanan"]);
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
     * @param  \App\Http\Requests\StorelayananRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelayananRequest $request)
    {
        $id = IdGenerator::generate(['table' => 'layanans','field'=>'id_layanan', 'length' => 8, 'prefix' =>'PRO-']);
        $validatedData = $request->validate([
            'nama' => 'required',
            'id_layanan'=>'',
            'harga' => 'required',
        ]);
        $validatedData['id_layanan'] = $id;
        layanan::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/layanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit($layanan)
    {
        $layanan= layanan::where('id','=',$layanan )->first();

        return view("editlayanan", 
        ["layanan" => $layanan,
        "title"=>"Layanan"]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelayananRequest  $request
     * @param  \App\Models\layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelayananRequest $request, layanan $layanan)
    {
        layanan::where('id', $request->id)
        ->update(['nama' => $request->nama,
             'harga' => $request->harga,
             'diskon' => $request->diskon,
     ]);
     return redirect('/layanan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(layanan $layanan)
    {
        //
    }
}
