@extends('layouts.main')

<div class="header">
    <p class="p-text">Transaksi</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2"></div>
        <div id="rcorners1">
            <form action="{{ url('/transaksi') }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Nama Pelanggan">Nama Pelanggan:</label>
                            <select class="selectpicker" name="id_pelanggan" data-live-search="true" data-width="100%" required>
                                                <option value="" disabled selected hidden>Pilih Nama Pelanggan</option>
                                                @foreach ($pelanggan as $pelangganst)
                                                <option value="{{ $pelangganst->id }}">{{ $pelangganst->nama }}</option>
                                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="Tanggal Transaksi">Tanggal Transaksi:</label>
                            <input type="date" name="tanggal" class="form-control" id="tgltransaksi" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id }}" class="form-control" id="tgltransaksi" required>
                        </div>
                    </div>
                </div>
                    <div class="text-right">
                        <button type="submit"  class="btn btn-primary">Transaksi Baru</button>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="modalconfirm">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Transaksi</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                    Apakah anda yakin ingin menyimpan?
                                </div>
                                    
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" data-dismiss="modal">Simpan</button>
                                </div>
                                    
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <div class="container" id="container-table">
        <h4>List Transaksi</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-hover datatab" style="width: 100%">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>No</th>
                        <th>Transaksi ID</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th style="width: 25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $transaksis)
                    <tr>
                        <td>1</td>
                        <td>{{ $transaksis->id_transaksi }}</td>
                        <td>{{ $transaksis->pelanggan->nama }}</td>
                        <td>{{ $transaksis->tanggal }}</td>
                        <td>{{ $transaksis->status_pembayaran }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary" onclick="location.href='{{ url('/transaksi/'.$transaksis->id_transaksi)}}'">Detail Transaksi</button>
                            <form action="{{ url('/transaksi/'.$transaksis->id_transaksi) }}" method="post" class="d-inline">
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
</body>
</html>
