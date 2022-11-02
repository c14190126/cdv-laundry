 @extends('layouts.main')
 <div class="header">
            <p class="p-text">Pelanggaran</p>
        </div>
        <div class="main">
            <div class="container">
                <div id="rcorners2"></div>
                <div id="rcorners1">
                    <form action="{{ url('/punishment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Nama Pegawai">Nama Pegawai</label>
                                    <select class="selectpicker"name="pegawai_id" data-live-search="true" data-width="100%">
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
                                    <label for="Tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="col">
                                <div class ="form-group">
                                    <label for="Jumlah Barang">Jumlah Barang</label>
                                    <input type="number" name="jumlah_barang" class="form-control" id="jumbarang">
                                </div>
                            </div>
                            <div class="col">
                                <div class ="form-group">
                                    <label for="potongan">Pemotongan</label>
                                    <input type="number" name="potongan" class="form-control" id="potongan">
                                </div>
                            </div>
                            <div class="col">
                                <div class ="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan">
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
                                <th>Tanggal</th>
                                <th>Jumlah Barang</th>
                                <th>Pemotongan</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ($punishment as $punishments)
                    <tr>
                        <td>1</td>
                        <td>{{ $punishments->pegawai_id }}</td>
                        <td>{{ $punishments->pegawai->nama }}</td>
                        <td>{{ $punishments->tanggal }}</td>
                        <td>{{ $punishments->jumlah_barang }}</td>
                        <td>{{ $punishments->potongan }}</td>
                        
                    </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>