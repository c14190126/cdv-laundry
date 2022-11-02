<div class="sidebar">
    <div class="logo-header">
        <img src="{{ asset('/images/logolaundryCDV.png') }}" width="200" height="100" style="object-fit: scale-down;">
    </div>
    <div class="profile">
        <span class="logo">
            <i class="fa fa-dropbox"></i>
        </span>
        <div class="profile-text">
            <p class="nama">{{ auth()->user()->nama }}</p>
            <p class="cabang">Surabaya</p>
            <p class="role">{{ auth()->user()->user_role }}</p>
        </div>
    </div>
    <a href="{{url('/cabang')}}">Cabang</a>
    <button class="dropdown-btn">Kelola Pegawai
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a class=nav-link href="{{ url('/pegawai') }}">Pegawai</a>      
        <a class=nav-link href="{{ url('/absen') }}">Presensi</a>      
        <a class= nav-link href="{{url('/punishment')}}">Pelanggaran</a>      
        <a class= nav-link href="{{url('/gaji')}}">Gaji</a>      
    </div>
    <button class="dropdown-btn">Transaksi
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a class= nav-link href="{{url('/transaksi')}}">Transaksi</a>      
        <a class= nav-link href="{{url('/promo')}}">Promo</a>      
        <a href="{{url('/layanan')}}">Layanan</a>

    </div>
    <a class=nav-link href="{{url('/pelanggan')}}">Kelola Pelanggan</a>

    <div class="vertical-center">
        <form action="{{url('/logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger nav-link">Logout</button>
        </form>
    </div>
</div>
