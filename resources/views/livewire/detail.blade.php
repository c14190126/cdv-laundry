{{-- <div>
    <input wire:model="test" type="text">
    Hello {{ $test }}
</div> --}}

<div id="rcorners1">
    <form action="{{ url('/detail') }}" method="POST" >
        {{ csrf_field() }}
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="Nama Layanan">Nama Layanan:</label>
                    <select class="form-control" wire:model="selectedClass" id="layanan" data-live-search="true" data-width="100%" >
                            <option value=""  selected >Pilih Nama Layanan</option>
                            @foreach($layanan as $layanans)
                            <option value="{{ $layanans->id }}">{{ $layanans->nama }}</option>
                            @endforeach
                    </select>
                </div>
                {{-- <input wire:model="test" type="text">
                Hello {{ $test }} --}}
            </div>
            {{-- <div class="col">
                <div class="form-group" hidden>
                    <label for="id_transaksi">id_transaksi</label>
                    <input type="number" class="form-control" id="jumitem" name="id_transaksi" vali required>
                </div>
            </div> --}}
            <div class="col">
                <div class="form-group">
                    <label for="Jumlah Item">Jumlah Item:</label>
                    <input type="number" class="form-control" id="jumitem" name="quantity" required>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="ID Layanan">ID Layanan:</label>
                    @if (!is_null($sections))
                    <input type="text" class="form-control" id="layananid" name="layanan_id" value="{{ $sections->id_layanan}}" placeholder="Layanan ok" readonly>
                    @else
                    <input type="text" class="form-control" id="layananid" value="" placeholder="Layanan" readonly>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="Harga per Item">Harga per Item:</label>
                    @if (!is_null($sections))
                    <input type="text" class="form-control" name="harga" id="harga" value="{{ $sections->harga}}" placeholder="0" readonly>
                    @else
                    <input type="text" class="form-control" id="harga" value="" placeholder="0" readonly>
                    @endif
                </div>
            </div>
        </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Transaksi Baru</button>
            </div>
            <!-- The Modal -->
            
    </form>
    
</div>
