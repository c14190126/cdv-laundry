@extends('layouts.main')
<div class="header">
    <p class="p-text">Gaji</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2"></div>
        <div id="rcorners1">
            <form action="{{ url('/addgaji') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nama Pegawai">Nama Pegawai</label>
                            <select class="form-control" name="id_pegawai" id="id_pegawai" data-width="100%">
                                <option value="" disabled selected hidden>Pilih Nama Pegawai</option>
                                    @foreach ($pegawai as $pegawaisg)
                                    <option value="{{ $pegawaisg->id }}">{{ $pegawaisg->nama }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class ="form-group">
                            <label for="Tanggal">Tanggal Cetak:</label>
                            <input type="date" name="tanggal_cetak" class="form-control" id="tanggal" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group" id="gajipokok">
                            <label for="Gaji Pokok">Gaji Pokok</label>
                            <input type="number" class="form-control"  readonly>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <div class ="form-group">
                            <label for="Bonus">Bonus</label>
                            <input type="number" class="form-control" id="bonus">
                        </div>
                    </div>
                    <div class="col">
                        <div class ="form-group" id="potongan">
                            <label for="potongan">Potongan</label>
                            <input type="number" class="form-control"  value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-3" id="absen">
                        <div class ="form-group">
                            <label for="Tanggal">Jumlah Masuk</label>
                            <input type="number" class="form-control" readonly>
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
                        <th>Pegawai ID</th>
                        <th>Nama</th>
                        <th>Tanggal Cetak</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus</th>
                        <th>Potongan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gaji as $gajis)
                    <tr> 
                        <td>{{ $gajis->id }}</td>
                        <td>{{ $gajis->id_pegawai }}</td>
                        <td>{{ $gajis->pegawai->nama}}</td>
                        <td>{{ $gajis->tanggal_cetak }}</td>
                        <td>{{ $gajis->gaji_pokok }}</td>
                        <td>{{ $gajis->bonus }}</td>
                        <td>{{ $gajis->potongan }}</td>
                        <td>{{ $gajis->total_gaji }}</td>
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
        $('#id_pegawai').change(function () {
            var id_pegawai = $('#id_pegawai').val();
            $.ajax({
                url: "{{url('/gaji/fetchgaji')}}",
                type: 'get',
                data: {
                    id_pegawai:id_pegawai,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#gajipokok").html('<label for="Gaji Pokok">Gaji Pokok</label><input type="Number" class="form-control" id="gaji_pokok" name="gaji_pokok" value="' + result.gaji_pokok + '"readonly>');
                    $("#potongan").html('<label for="Potongan">Potongan</label><input type="number" class="form-control" id="potongan" name="potongan" value="' + result.potongan + '"readonly>');
                    $("#absen").html('<label for="jumlah_presensi">Jumlah Masuk</label><input type="number" class="form-control" id="presensi" name="presensi" value="' + result.absen + '"readonly>');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
});
</script>