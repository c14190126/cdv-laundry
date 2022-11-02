@extends('layouts.main')       
<div class="header">
    <p class="p-text">Layanan</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2">
            <form action="{{ url('/editlayanan/'.$layanan->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <input type="hidden" class="form-control" name="id" id="id" required value="{{ $layanan->id }}" >
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group row">
                    <label for="Nama"  class="col-sm-2 col-form-label">Nama Layanan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" readonly required value="{{ $layanan->nama }}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="{{ $layanan->harga }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Nomor WhatsApp" class="col-sm-2 col-form-label">Diskon</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Diskon" >
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Simpan dan Tambah</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
