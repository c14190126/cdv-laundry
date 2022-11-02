@extends('layouts.main')       
<div class="header">
    <p class="p-text">Pelanggan / Tambah Pelanggan</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2">
            <form action="{{ url('/addpelanggan') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group row">
                    <label for="Nama"  class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Nomor WhatsApp" class="col-sm-2 col-form-label">Nomor WhatsApp</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_wa" id="no_wa" placeholder="Nomor WhatsApp" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Simpan dan Tambah</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
