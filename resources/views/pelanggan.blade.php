@extends('layouts.main')
<div class="header">
    <p class="p-text">Pelanggan</p>
</div>
<div class="main">
    <div class="container">
    <div class="container" id="container-table">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatab">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor WhatsApp</th>
                        <th>Email</th>
                        <th>Total Poin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $pelanggans)
                    <tr>
                        <td>{{ $pelanggans->id }}</td>
                        <td>{{ $pelanggans->id_pelanggan }}</td>
                        <td>{{ $pelanggans->nama }}</td>
                        <td>{{ $pelanggans->alamat }}</td>
                        <td>{{ $pelanggans->no_wa }}</td>
                        <td>{{ $pelanggans->email }}</td>
                        <td>{{ $pelanggans->total_poin }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a class="nav-link btn btn-success" href="{{ url('/addpelanggan') }}">Tambah Pelanggan</a>  
    </div>
</div>