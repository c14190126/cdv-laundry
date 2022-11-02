<body onload="startTime()">
    @extends('layouts.main')
    <div class="header" >
        <p class="p-text">Presensi</p>
    </div>
    <div class="main">
        <div class="container">
            <div id="rcorners2"></div>
            <div id="rcorners1">
                @if(session()->has('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
                <form action="{{ url('/absen') }}" method="post">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Nama Pegawai">Nama Pegawai</label>
                            <select class="selectpicker" name="id_pegawai" data-live-search="true" data-width="100%" id="id_pegawai">
                                <<option value="{{ auth()->user()->id }}">{{  auth()->user()->nama  }}</option>
                            </select>
                        </div>
                    </div>
                        <div class="col">
                            <div class ="form-group">
                                {{-- <input type="time" name="jam_masuk" class="form-control" id="masuk"> --}}
                                <div style="font-size: 60px" id="masuk" ></div>
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class ="form-group">
                                <label for="Tanggal">Tanggal</label>
                                <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" class="form-control" id="tanggal" readonly >
                            </div>
                        </div>
                        <div class="col">
                            <div class ="form-group">
                                <label for="Longitude">Longitude</label>
                                <input type="text" class="form-control" placeholder="" name="longtitude" id="lng" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class ="form-group">
                                <label for="Latitude">Latitude</label>
                                <input type="text" class="form-control" placeholder="" name="latitude" id="lat" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Presensi</button>
                    </div>
                </form>
                <form action="/checkout" method="post" class="d-inline">
                    @csrf
                    <div class="row" hidden>
                        <div class="col">
                            <div class="form-group">
                                <label for="Nama Pegawai">Nama Pegawai</label>
                                <select class="selectpicker" name="id_pegawai" data-live-search="true" data-width="100%" id="id_pegawai">
                                    <<option value="{{ auth()->user()->id }}">{{  auth()->user()->nama  }}</option>
                                </select>
                            </div>
                        </div>                      
                        </div>
                        <div class="row" hidden>
                            <div class="col">
                                <div class ="form-group">
                                    <label for="Tanggal">Tanggal</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" name="tanggal" class="form-control" id="tanggal" >
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button style="" class="btn btn-danger" >Keluar</button>
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
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Longitude</th>
                            <th>Langitude</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absen as $absens)
                        <tr>
                         <td>{{ $absens->id }}</td>
                            <td>{{ $absens->id_pegawai }}</td>
                            <td>{{ $absens->pegawai->nama }}</td>
                            <td>{{ $absens->tanggal }}</td>
                            <td>{{ $absens->jam_masuk }}</td>
                            <td>{{ $absens->jam_keluar }}</td>
                            <td>{{ $absens->latitude }}</td>
                            <td>{{ $absens->longtitude}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="map" style="height:200px; width: 400px;" class="my-3"></div>
    
            </div>
        </div>
    </div>
    
    <script>
    let map, infoWindow;
    
    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: {  lat: 7.2813819, lng: 112.7052772 },
        zoom: 14,
      });
      infoWindow = new google.maps.InfoWindow();
    
      const locationButton = document.createElement("button");
    
      locationButton.textContent = "Pan to Current Location";
      locationButton.classList.add("custom-map-control-button");
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
      locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };
                    $('#lat').val(position.coords.latitude)
                    $('#lng').val(position.coords.longitude)
              infoWindow.setPosition(pos);
              infoWindow.setContent("Location found.");
              infoWindow.open(map);
              map.setCenter(pos);
            },
            () => {
              handleLocationError(true, infoWindow, map.getCenter());
            }
          );
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      });
    }
            
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(
        browserHasGeolocation
          ? "Error: The Geolocation service failed."
          : "Error: Your browser doesn't support geolocation."
      );
      infoWindow.open(map);
    }
    
    window.initMap = initMap;
    </script>
    <script>
        function startTime() {
          const today = new Date();
          let h = today.getHours();
          let m = today.getMinutes();
          let s = today.getSeconds();
          m = checkTime(m);
          s = checkTime(s);
          document.getElementById('masuk').innerHTML =  h + ":" + m + ":" + s;
          setTimeout(startTime, 1000);
        }
        
        function checkTime(i) {
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
        }
        </script>
    {{-- <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTi7JmVrUMst2AgtmO2qXOao0t-fNYvM&libraries=places&callback=initMap">
    </script> --}}
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                            type="text/javascript"></script>