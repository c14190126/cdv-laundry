@extends('layouts.main')

<div class="header">
    <p class="p-text">Gaji</p>
</div>
<div class="main">
    <div class="container">
        <div id="rcorners2"></div>
    </div>
    <div class="container" id="container-table">
        <h4>List Gaji</h4>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-hover datatab" style="width: 100%">
                <thead class="custom-thead-bg">
                    <tr>
                        <th>ID</th>
                        <th>Nama Pegawai</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $gajis)
                    <tr>
                        <td>{{ $gajis->id }}</td>
                        <td>{{ $gajis->nama }}</td>
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
</body>
</html>
