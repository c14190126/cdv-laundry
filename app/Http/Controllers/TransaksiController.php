<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\detail_transaksi;
use App\Models\layanan;
use App\Models\pegawai;
use App\Models\Pelanggan;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("transaksi", 
        ["transaksi" => transaksi::all(),
        "pelanggan" => Pelanggan::all(),
        "layanan" => layanan::all(),
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
     * @param  \App\Http\Requests\StoretransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretransaksiRequest $request)
    {
        $id = IdGenerator::generate(['table' => 'transaksis','field'=>'id_transaksi', 'length' => 8, 'prefix' =>'TRA-']);
        $validatedData = $request->validate([
            'id_pelanggan' => 'required',
            'id_pegawai' => 'required',
            'tanggal'=>'required',
            'id_transaksi'=>''
        ]);
        $validatedData['id_transaksi']= $id;
        transaksi::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($transaksi)
    {
        $detail= transaksi::where('id_transaksi','=',$transaksi)->first();
        // dd($detail);
        return view('detailtransaksi', ['detail' => $detail,
        "layanan" => layanan::all()]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetransaksiRequest  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        transaksi::where('id', $transaksi->id)
        ->update(['total' => $request->total,
             'id_promo' => $request->id_promo,
     ]);
     return redirect('/transaksi/'.$transaksi->id_transaksi);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi $transaksi)
    {
        transaksi::destroy($transaksi->id);

        return redirect('/transaksi')->with('success','Data Berhasil Dihapus');
    }
}
