@extends('layouts.main')

<div class="header">
    <p class="p-text">Layanan</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners1">
            <form action="{{ url('/layanan') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="row">
                    <div class="col">
                        <div class ="form-group">
                            <label for="Nama-Layanan">Nama Layanan</label>
                            <input type="text" class="form-control" name="nama" id="namalayanan">
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group">
                            <label for="Harga">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                        <th>Layanan ID</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Diskon(%)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($layanan as $layanan)
                        <tr>
                            <td>1</td>
                            <td>{{ $layanan->id_layanan }}</td>
                            <td>{{ $layanan->nama }}</td>
                            <td>{{ $layanan->harga }}</td>
                            <td>{{ $layanan->diskon }}</td>

                        <td>
                            <button type="submit" class="btn btn-primary" onclick="location.href='{{ url('/editlayanan/'.$layanan->id)}}'">Edit</button>
                        </td>
                        @endforeach

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>