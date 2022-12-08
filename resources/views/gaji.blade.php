@extends('layouts.main')
<div class="header">
    <p class="p-text">Gaji</p>
</div>
<div class="main">
    <div class="container">
    <form action="{{ url('/addgaji') }}" method="POST">
    @csrf
    <div class="row page-title-header">
            </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    {{-- <label for="id_po_bahan_baku" class="text">ID Purchase Bahan Baku Gudang</label> --}}
                </div>
                <div class="col-10">
                    {{-- <input readonly="readonly" type="text" class="form-control textField" id="id_po_bahan_baku" name="id_po_bahan_baku" value="{{ $id_po_bahan_baku }}"> --}}
                </div>                
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="tanggal_cetak" class="text">Tanggal Cetak At</label>
                </div>
                <div class="col-10">
                <input type="date" class="form-control textField" id="tanggal_cetak" value="{{ date('Y-m-d') }}"
                    placeholder="Masukkan Tanggal" name="tanggal_cetak">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="nama_supplier" class="text">Nama Pegawai</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="id_pegawai" name="id_pegawai">   
                        <option value="" disabled selected hidden>Pilih Nama Pegawai</option>                 
                        @foreach ($pegawai as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>                      
            </div>
        </div>  
                <div class="form-group">
                    <div class="row">
                        <div class="col-10">
                            {{-- <input hidden type="text" class="form-control textField" id="id_po_bahan_baku" name="id_po_bahan_baku" value="{{ $id_po_bahan_baku }}"> --}}
                        </div>                
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                        <label for="berat" class="text">Gaji Pokok</label>
                        </div>
                        <div class="col-10" id="gajipokok">
                        <input type="Number" class="form-control textField" readonly id="gaji_pokok"
                            placeholder="Gaji Pokok" name="gajipokok">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                        <label for="Nominal" class="text">Potongan</label>
                        </div>
                        <div class="col-10" id="potongan">
                        <input type="Number" class="form-control textField" readonly id="cut"
                            placeholder="Potongan" name="potongan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                        <label for="Nominal" class="text">Jumlah Presensi</label>
                        </div>
                        <div class="col-10" id="absen">
                        <input type="Number" class="form-control textField" readonly id="absen"
                            placeholder="absen" name="absen">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                        <label for="Nominal" class="text">Bonus</label>
                        </div>
                        <div class="col-10">
                        <input type="Number" class="form-control textField" id="bonus"
                            placeholder="Masukkan Bonus" name="bonus">
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                        <label for="harga_per_kg" class="text">Harga Per kg</label>
                        </div>
                        <div class="col-10">
                        <input type="Number" class="form-control textField" id="harga_per_kg"
                            name="harga_per_kg" value="" placeholder="Rp 1.000" readonly>
                        </div>
                    </div>
                </div> --}}
               
                <div class="col text-right" style="margin: 10px;">
                    <input type="button" class="btn btn-danger" value="Hapus" id="kurang_del_addr">
                    <input type="button" class="btn btn-primary" value="Tambah" id="tambah_del_addr">                            
                </div>
                <div class="form-group mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>                                
                                <th>Nama Pegawai</th>                                    
                                <th>Gaji Pokok</th>
                                <th>Jumlah Masuk</th>
                                <th>Potongan</th>
                                <th>Bonus</th>
                            </tr>
                        </thead>
                        <tbody id="table_del_addr">
                            
                        </tbody>                                                                  
                    </table>
                </div>          
       
        <div class="col text-right">
            <input type="submit" class="btn btn-primary" value="Submit" id="halamanSubmit" data-toggle="modal" data-target="#myModal">
        </div> 
    </form>

</div>

@section('script')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript">
    
   
    $('#tambah_del_addr').click(function(){
        var inserted = `<tr>                            
            <td><input  class='form-control form-control-sm' type='text' name='id_pegawai[]' value="`+$('#id_pegawai').val()+`" readonly/></td>            
            <td><input class='form-control form-control-sm' type='text' name='gaji_pokok[]' value="`+$('#gaji_pokok').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='presensi[]' value="`+$('#presensi').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='cut[]' value="`+$('#cut').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='bonus[]' value="`+$('#bonus').val()+`" readonly/></td>
        </tr>`

        $('#table_del_addr').append(inserted)
    })
    

    $('#kurang_del_addr').click(function(){
        $('#table_del_addr').children().last().remove();
    })

    

    
</script>
@endsection
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
                    $("#gajipokok").html('<input type="Number" class="form-control" id="gaji_pokok" name="gaji_pokok" value="' + result.gaji_pokok + '"readonly>');
                    $("#potongan").html('<input type="number" class="form-control" id="cut" name="potongan" value="' + result.potongan + '"readonly>');
                    $("#absen").html('<input type="number" class="form-control" id="presensi" name="presensi" value="' + result.absen + '"readonly>');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
});
</script>
