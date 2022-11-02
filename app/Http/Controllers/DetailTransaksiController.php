<?php

namespace App\Http\Controllers;

use App\Models\detail_transaksi;
use App\Models\transaksi;
use App\Http\Requests\Storedetail_transaksiRequest;
use App\Http\Requests\Updatedetail_transaksiRequest;
use App\Models\layanan;
use App\Models\promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DetailTransaksiController extends Controller
{
    public $detail=null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($transaksi)
    {
        // return view("detailtransaksi", 
        // ["detail_transaksi" => detail_transaksi::all(),
        // "transaksi"=>transaksi::all(),
        // "layanan"=>layanan::all(),
        // "title"=>"Detail Transaksi"]);
        $detail= transaksi::where('id_transaksi','=',$transaksi)->first();
        $temp= transaksi::where('id_transaksi','=',$transaksi)->value('id');
        $subtotal= detail_transaksi::where('id_transaksi',$temp)->sum('subtotal');
        $layanan= detail_transaksi::where('id_transaksi','=',$temp)->get();
        $promo = promo::where('id','=',$detail->id_promo)->first();
        $diskon = $subtotal-$detail->total;
        $jdiskon =$detail->harga;
        
        
        // $dlayanan = $layanan->harga layanan->diskon;
        // dd($promo);
        session(['key' => $detail['id']]);
        return view('detailtransaksi', ['detail' => $detail,
        "layanan" => layanan::all(),
        "detail_transaksi"=>$layanan,
        'subtotal' => $subtotal,
        'total' => $subtotal,
        "promo"=> promo::all(),
        'nama_promo'=>$promo,
        'diskon'=>$diskon,
        'jdiskon'=>$jdiskon
]);
    }
    public function fetch(Request $request)
    {
        // dd($request);
        $diskon = DB::table('promos as p')
                    ->where('p.id',$request->promo)
                    ->select('p.*')
                    ->first();
                    
        $value = DB::table('transaksis as t')
        ->where('t.id_transaksi',$request->transaksiid)
        ->select('t.*')
        ->first();

        $subtotal= detail_transaksi::where('id_transaksi',$value->id)->sum('subtotal');

        $data['diskon'] =$subtotal*$diskon->jumlah_diskon/100;
        $data['total'] =$subtotal-$data['diskon'];
        return response()->json($data);

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
     * @param  \App\Http\Requests\Storedetail_transaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedetail_transaksiRequest $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => '',
            'layanan_id' => 'required',
            'promo' => '',
            'quantity' => 'required',
            'subtotal' => ''
        ]);
        $value = $request->session()->pull('key', 'default');
        // dd($value);
        $layanan=layanan::where('id_layanan',$validatedData['layanan_id'])->value('harga');
        $id_layanan=layanan::where('id_layanan',$validatedData['layanan_id'])->first();
        $transaksi=transaksi::where('id',$value)->value('id_transaksi');
        $detailt= transaksi::where('id_transaksi','=',$transaksi)->first();
        $validatedData['subtotal']= $validatedData['quantity']*($layanan-$layanan*$id_layanan->diskon/100);
        $validatedData['id_transaksi']= $detailt['id'];
        $validatedData['layanan_id']= $id_layanan->id;
        // dd($validatedData);
        detail_transaksi::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/transaksi/'.$transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(detail_transaksi $detail_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(detail_transaksi $detail_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedetail_transaksiRequest  $request
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedetail_transaksiRequest $request, detail_transaksi $detail_transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_transaksi  $detail_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(detail_transaksi $detail_transaksi)
    {
        // dd($detail_transaksi);
        detail_transaksi::destroy($detail_transaksi->id);
        $transaksi= transaksi::where('id','=',$detail_transaksi->id_transaksi)->value('id_transaksi');
        return redirect('/transaksi/'.$transaksi)->with('success','Data Berhasil Dihapus');    }
}
