@extends('layouts.main')


<div class="header">
    <p class="p-text">Pegawai / Tambah Pegawai</p>
</div>
<div class="main">
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
        <form action="{{ url('/addpegawai') }}" method="POST">
        <div id="rcorners2">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Nama" required autofocus value="{{ old('nama') }}" >
                    @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat" required value="{{ old('alamat') }}">
                    @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" placeholder="Nomor Telepon" required value="{{ old('no_telp') }}">
                    @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                    @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passwors" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required value="{{ old('password') }}">
                    @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="user_role"  class="col-sm-2 col-form-label">Role Pegawai</label>
                    <div class="col-sm-10">
                        <select class="selectpicker @error('user_role') is-invalid @enderror" name="user_role" data-live-search="true" data-width="100%" required value="{{ old('user_role') }}">
                            @error('user_role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                    @enderror
                            <option value="" disabled selected hidden>Pilih Role Pegawai</option>
                            <option>Kasir</option>
                            <option>Tukang Cuci</option>
                            <option>Tukang Setrika</option>
                            <option>Tukang Antar</option>

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Cabang" class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                        <select class="selectpicker @error('id-cabang') is-invalid @enderror" name="id_cabang" data-live-search="true" data-width="100%" required value="{{ old('id_cabang') }}">
                            @error('id_cabang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <option value="" disabled selected hidden>Pilih  Cabang</option>
                            @foreach ($cabang as $cabangs)
                                <option value="{{ $cabangs->id }}">{{ $cabangs->nama }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
            </form>
            <div class="text-right">
                <button type="submit" class="btn btn-success" >Simpan dan Tambah</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>