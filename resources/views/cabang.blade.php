@extends('layouts.main')       
<div class="header">
    <p class="p-text">Cabang</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2">
            <form action="{{ url('/cabang') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="nama" placeholder="Nama" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Nomor WhatsApp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_telp" name="no_telepon" placeholder="Nomor Telepon" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Jumlah-Pegawai" class="col-sm-2 col-form-label">Jumlah Pegawai</label>
                    <div class="col-sm-10">
                    <input type="number" class="form-control" id="jum_pegawai" name="jumlah_pegawai" placeholder="Jumlah Pegawai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Longitude" class="col-sm-2 col-form-label">Longitude</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="longitude" name="longtitude" placeholder="Longitude" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Langitude" class="col-sm-2 col-form-label">Langitude</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="langitude" name="latitude" placeholder="Langitude" required>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>