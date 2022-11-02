@extends('layouts.main')

<div class="header">
    <p class="p-text">Pegawai</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2">
            <div class="row">
                <div class="col">
                    <select class="selectpicker" data-live-search="true" data-width="100%" id="cabang">
                                            <option  value="" disabled selected hidden>Pilih  Cabang</option>
                                            <@foreach ($cabang as $cabangs)
                                            <option  value="{{ $cabangs->id }}">{{ $cabangs->alamat }}</option>
                                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <button id="caricabang" type="button" class="btn btn-primary">Cari</button>
                </div>
                <a class="nav-link btn btn-success" href="{{ url('/addpegawai') }}">Tambah Pegawai</a>      
            </div>
        </div>
        <div id="rcorners1">
            <form action="#">
                <div class="row">
                    <div class="col">
                        <div class ="form-group" id="id">
                            <label for="ID Cabang" >ID Cabang</label>
                            <input type="text" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group" id="alamat">
                            <label for="Alamat" >Alamat</label>
                            <input type="text" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="col" id="longitude">
                        <div class ="form-group">
                            <label for="Longitude" >Longitude</label>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class ="form-group" id="jumpegawai" >
                            <label for="Jumlah Pegawai" >Jumlah Pegawai</label>
                            <input type="text" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group" id="no_telepon">
                            <label for="No Telepon" >No Telepon</label>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group" id="latitude">
                            <label for="Langitude" >Latitude</label>
                            <input type="text" class="form-control"  readonly>
                        </div>
                    </div>
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Cabang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $pegawais)
                    <tr>
                        <td>{{ $pegawais->id }}</td>
                        <td>{{ $pegawais->nama }}</td>
                        <td>{{ $pegawais->alamat }}</td>
                        <td>{{ $pegawais->no_telp }}</td>
                        <td>{{ $pegawais->email }}</td>
                        <td>{{ $pegawais->user_role }}</td>
                        <td>{{ $pegawais->cabang->alamat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#caricabang').click(function () {
            var cabang = $('#cabang').val();
            $.ajax({
                url: "{{url('/cabang/fetchcabang')}}",
                type: 'get',
                data: {
                    cabang:cabang,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#id").html('<label for="Id Cabang">ID Cabang</label><input type="Number" class="form-control" id="id" name="id" value="' + result.id + '"readonly>');
                    $("#alamat").html('<label for="Alamat">Alamat</label><input type="text" class="form-control" id="alamat" name="alamat" value="' + result.alamat + '"readonly>');
                    $("#longitude").html('<label for="Longtitude">Longtitude</label><input type="float" class="form-control" id="longtitude" name="longtitude" value="' + result.longtitude + '"readonly>');
                    $("#jumpegawai").html('<label for="Jumlah Pegawai">Jumlah Pegawai</label><input type="number" class="form-control" id="jumpegawai" name="jumpegawai" value="' + result.jumpegawai + '"readonly>');
                    $("#no_telepon").html('<label for="No Telepon">No Telepon</label><input type="text" class="form-control" id="no_telepon" name="no_telepon" value="' + result.no_telepon + '"readonly>');
                    $("#latitude").html('<label for="Latitude">Latitude </label><input type="float" class="form-control" id="latitude" name="latitude" value="' + result.latitude + '"readonly>');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
});
</script>