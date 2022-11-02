<?php

namespace App\Http\Controllers;

use App\Models\promo;
use App\Http\Requests\StorepromoRequest;
use App\Http\Requests\UpdatepromoRequest;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("promo", 
        ["promo" => promo::all(),
        "title"=>"Promo"]);
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
     * @param  \App\Http\Requests\StorepromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepromoRequest $request)
    {
        $validatedData = $request->validate([
            'nama_promo' => 'required',
            'jumlah_diskon' => 'required|min:1|max:100',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai'
        ]);
        promo::create($validatedData);

        return redirect('/promo')->with('success','Data Berhasil Ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepromoRequest  $request
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepromoRequest $request, promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(promo $promo)
    {
        promo::destroy($promo->id);

        return redirect('/promo')->with('success','Data Berhasil Dihapus');

    }
}
