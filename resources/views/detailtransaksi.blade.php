@extends('layouts.main')
<div class="header">
    <p class="p-text">Transaksi / Detail Transaksi</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2" style="width:100%">
            <form>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="ID Transaksi" class="col-sm-4 col-form-label" >ID Transaksi</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="transaksiid" value="{{ $detail->id_transaksi }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="ID Pelanggan" class="col-sm-4 col-form-label">ID Pelanggan</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="pelangganid" value="{{ $detail->pelanggan->id_pelanggan }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="Tanggal Transaksi" class="col-sm-4 col-form-label" >Tanggal Transaksi</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="transaksiid" value="{{ $detail->tanggal }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="Nama Pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="namapelanggan" value="{{ $detail->pelanggan->nama }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="Nama Pegawai" class="col-sm-4 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="namapelanggan" value="{{ $detail->pegawai->nama }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="No Whatsapp" class="col-sm-4 col-form-label">Nomor WhatsApp</label>
                            <div class="col-sm-5">
                            <input type="text"class="form-control-plaintext" id="namapelanggan" value="{{ $detail->pelanggan->no_wa }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <livewire:detail/>
    </div>
    <div class="container" id="container-table">
        <h4>List Transaksi</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-hover datatab" style="width: 100%">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Jumlah Item</th>
                        <th>Harga Satuan</th>
                        <th>Diskon (%)</th>
                        <th>Diskon(@)</th>
                        <th>Sub Total</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail_transaksi as $details)
                    <tr>
                        <td>1</td>
                        <td>{{ $details->layanan->nama }}</td>
                        <td>{{ $details->quantity }}</td>
                        <td>Rp.{{ number_format($details->layanan->harga )}}</td>
                        <td>{{ $details->layanan->diskon }}</td>
                        <td>Rp.{{ number_format($details->layanan->harga * $details->layanan->diskon/100) }}</td>
                        <td>Rp.{{ number_format($details->subtotal) }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary">Edit Item</button>
                            <form action="{{ url('/detail_transaksi/'.$details->id) }}" method="post" class="d-inline">
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
    <div class="container">
        <form action="{{ url('/save_transaksi/'.$detail->id_transaksi) }}" method="POST">
            @method('put')
            @csrf            <div class="row">
                <div class="col">
                    <div class="form-group row" >
                        <label for="sub_total" class="col-sm-4 col-form-label" style="font-weight: bold;">Sub Total</label>
                        <div class="col-sm-8">
                            <input type="text"class="form-control-plaintext" id="subtotal" value="Rp.{{number_format($subtotal)}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            @isset($detail->id_promo)
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="Diskon" class="col-sm-4 col-form-label" style="font-weight: bold">Promo</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="id_promo" id="promo" data-live-search="true" data-width="100%">
                                <option value="{{ $detail->id_promo}}" disabled selected hidden>{{ $nama_promo->nama_promo }}</option>
                                @foreach ($promo as $promos)
                                <option value="{{ $promos->id }}">{{ $promos->nama_promo }}</option>
                                @endforeach
                            </select>          
                        </div>
                        <label for="Diskon" class="col-sm-4 col-form-label" style="font-weight: bold">Diskon</label>
                        <div class="col-sm-8" id="diskon">
                            <input type="text"class="form-control-plaintext"  value="Rp{{ number_format($diskon) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="Total" class="col-sm-4 col-form-label" style="font-weight: bold;">Total</label>
                        <div class="col-sm-8" id="total">
                            <input type="text" class="form-control-plaintext" name="total"  value="Rp{{ number_format($detail->total) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>     
            @else
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="Diskon" class="col-sm-4 col-form-label" style="font-weight: bold">Promo</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="id_promo" id="promo" data-live-search="true" data-width="100%">
                                <option value="" disabled selected hidden>Promo</option>
                                @foreach ($promo as $promos)
                                <option value="{{ $promos->id }}">{{ $promos->nama_promo }}</option>
                                @endforeach
                            </select>          
                        </div>
                        <label for="Diskon" class="col-sm-4 col-form-label" style="font-weight: bold">Diskon</label>
                        <div class="col-sm-8" id="diskon">
                            {{-- <input type="text"class="form-control-plaintext"  value="Rp 280.000" readonly> --}}
                        </div>
                    </div>
                </div>
            </div>     
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="Total" class="col-sm-4 col-form-label" style="font-weight: bold;">Total</label>
                        <div class="col-sm-8" id="total">
                            <input type="text" class="form-control-plaintext" name="total"  value="Rp{{ number_format($total) }}" readonly>
                        </div>
                    </div>
                </div>
            </div>            
            @endisset
            <div class="row">
                <div class="col text-right" style="margin:10px">
                    <button type="submit" class="btn btn-success">Save </button>
                    <button type="button" class="btn btn-primary" onclick="window.open('struktransaksi.php','Print QR','width=500,height=500,toolbar=no,location=no,directories=no,status=no, menubar=no, scrollbars=no,resizable=no,copyhistory=no')">Print Pembayaran</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#promo').change(function () {
            var promo = $('#promo').val();
            var transaksiid = $('#transaksiid').val();
            // alert(transaksiid);
            $.ajax({
                url: "{{url('/detail/fetchdiskon')}}",
                type: 'get',
                data: {
                    transaksiid:transaksiid,
                    promo:promo,
                    _token:'{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#diskon").html('<input type="Number" class="form-control-plaintext" id="diskon" name="diskon" value="' + result.diskon + '"readonly>');
                    $("#total").html('<input type="text" class="form-control-plaintext" id="total" name="total" value="' + result.total + '"readonly>');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
});
</script>