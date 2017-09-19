@extends('layout.umum')
@section('content')
  <div class="content-wrapper">
<div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Top Navigation
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Peta</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-3">
            <div class="box box-danger">
              <div class="box-body">
                    <div class="dividerHeading">
                      <h4><span>Kecamatan</span></h4>
                    </div>
                    @foreach($kecamatan as $kecamatan)
                    <div class="col-lg-12">
                      <a href="/peta/kecamatan/{{$kecamatan->id}}" class="btn btn-info btn-flat" style="width: 100%; margin-bottom: 10px"> {{$kecamatan->nama}}</a>
                    </div>
                    @endforeach
                    <div class="col-lg-12"><hr></div>  
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="box box-solid">
              <div class="box-body">
                <div id="map">

<script type="text/javascript">
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat:-0.897125, lng: 100.375354},
    zoom: 13,
    scrollwheel:  false
    });
  var infoWindow = new google.maps.InfoWindow;            
  function bindInfoWindow(marker, map, infoWindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
    });
  }         
  function addMarker(lat, lng, info) {
    var pt = new google.maps.LatLng(lat, lng);
    var marker = new google.maps.Marker({
      map: map,
      position: pt
    });         
    bindInfoWindow(marker, map, infoWindow, info);
    }
  @foreach($lapangan as $lapangan)
  addMarker({{$lapangan->latitude}},{{$lapangan->longitude}},'{{$lapangan->nama}}');
  @endforeach 
  google.maps.event.addDomListener(window, 'load', initMap);                   
  }
  
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-rC19kVhLyovpMskctJ2kcSIO5rx972Y&callback=initMap">
</script>
               
                </div>
              </div>
            </div>
          </div>

          </div>
      </section>
      <!-- /.content -->

    <!-- /.container -->
  </div>
  </div>


@endsection
