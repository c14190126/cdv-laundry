@extends('layouts.main')

<div class="header">
    <p class="p-text">Gaji</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2"></div>
    </div>
    <div class="container" id="container-table">
        <a class="nav-link btn btn-success text-center" href="{{ url('/gaji') }}" style="width: 12% ", >Tambah Gaji</a>      

        <h4>List Gaji</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-hover datatab" style="width: 100%">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal_Cetak</th>
                        <th style="width: 25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gaji as $gajis)
                    <tr>
                        <td>{{ $gajis->id }}</td>
                        <td>{{ $gajis->tanggal_cetak }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary" onclick="location.href='{{ url('/detailgaji/'.$gajis->id)}}'">Detail Gaji</button>
                            <form action="{{ url('/gaji/'.$gajis->id) }}" method="post" class="d-inline">
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
