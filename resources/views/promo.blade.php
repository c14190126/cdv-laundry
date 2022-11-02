@extends('layouts.main')
<div class="header">
    <p class="p-text">Promo</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2"></div>
        <div id="rcorners1">
            @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
            <form action="/promo" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="row">
                    <div class="col-sm-3">
                        <div class ="form-group">
                            <label for="Diskon">Diskon:</label>
                            <input type="number" name="jumlah_diskon" class="form-control" id="jumlah_diskon">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class ="form-group">
                            <label for="nama_promo">Nama Promo:</label>
                            <input type="text" name="nama_promo" class="form-control" id="nama_promo">
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <div class ="form-group">
                            <label for="Tanggal Mulai">Tanggal Mulai:</label>
                            <input type="date" name="mulai" class="form-control" id="mulai">
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group">
                            <label for="Tanggal Selesai">Tanggal Selesai:</label>
                            <input type="date" name="selesai" class="form-control" id="selesai">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Buat Promo</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container" id="container-table">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatab">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>No</th>
                        <th>Promo ID</th>
                        <th>Jumlah Diskon (%)</th>
                        <th>Mulai Berlaku</th>
                        <th>Selesai Berlaku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promo as $promos)
                    <tr>
                        <td>{{ $promos->id }}</td>
                        <td>{{ $promos->nama_promo }}</td>
                        <td>{{ $promos->jumlah_diskon }}</td>
                        <td>{{ $promos->mulai }}</td>
                        <td>{{ $promos->selesai }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary" >Edit</button>
                            <form action="{{ url('/promo/ $promos->nama_promo ') }}}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data')" >Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
