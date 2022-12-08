@extends('layouts.main')
<div class="main">
        <div class="text-center" style="margin: 20px;">
            <button type="button" class="btn btn-success" onclick="printDiv('printnota')"><i class="mdi mdi-printer"></i>Cetak Nota</button>
        </div>
        
        <div id="printnota">
            <div class="card border-dark mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nota-logo text-center">
                                <img src="{{ asset('/images/logolaundryCDV.png') }}" alt="..." width="60%" >
                            </div>
                        </div>
                        <div class="col text-center">
                            <p class="nota-namaperusahaan">
                                LAUNDRY CASSA DE VERDE
                            </p>
                            <p class="nota-alamatperusahaan">
                                Pergudangan Sinar Buduran 3 Blok F8, Jl. Lingkar Timur<br>
                                Ds. Siwalanpanji Kec. Buduran Kab. Sidoarjo- Jawa Timur<br>
                                Email : cdvlaundry@gmail.com
                            </p>
                        </div>
                    </div>
                    <hr style="width:100%; border: 0.2px solid black">
                    <div class="text-center">
                        <p><strong><h5>Nota</h5></strong></p>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="noPO" class="col-4 col-form-label">No Transaksi</label>
                                <div class="col">
                                    <input type="text" class="form-control-plaintext" id="noPO" value="{{ $transaksi->id_transaksi }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noSupplier" class="col-4 col-form-label">Nama Pelanggan</label>
                                <div class="col">
                                    <input type="text" class="form-control-plaintext" id="noSupplier" value="{{ $pelanggan->nama }}" readonly>
                                </div>
                            </div>
         
                        </div>
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="created_at" class="col-4 col-form-label">Created at</label>
                                <div class="col">
                                    <input type="text" class="form-control-plaintext" id="created_at" value="{{ date('d F Y', strtotime($transaksi->tanggal)) }}" readonly>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-akun">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Jumlah Item</th>
                                            <th>Harga Satuan</th>
                                            <th>Diskon (%)</th>
                                            <th>Diskon(@)</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $i = 0 ?>

                                            @foreach($detail as $details )
                                            <?php $i++ ?>
                                            <td>{{$i}}</td>                                            <td>{{ $details->layanan->nama }}</td>
                                            <td>{{ $details->quantity }}</td>
                                            <td>Rp.{{ number_format($details->layanan->harga )}}</td>
                                            <td>{{ $details->layanan->diskon }}</td>
                                            <td>Rp.{{ number_format($details->layanan->harga * $details->layanan->diskon/100) }}</td>
                                            <td>Rp.{{ number_format($details->subtotal) }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container row justify-content-end" style="padding:10px;">
                        <div class="col-1">
                            <strong><h4>Total</h4></strong>
                        </div>
                        <div class="col-2">
                            <strong><h4>Rp {{ number_format($transaksi->total) }}</h4></strong>
                        </div>
                    </div>
                    {{-- <div id="editor"></div> --}}
                </div>
            </div>
        </div>
</div>
   
    
@section('script')
<script src="{{ asset('js/manage_customer/customer/script.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
{{-- <script type="text/javascript">
    import {jsPDF} from "jspdf";
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#nota-bahanbaku').click(function () {
        doc.fromHTML($('#nota-bahanbaku-main').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('nota-bahanbaku.pdf');
    });
</script> --}}
<script>
function printDiv(cetaknota){
			var printContents = document.getElementById(cetaknota).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
		}
    
</script>
@endsection