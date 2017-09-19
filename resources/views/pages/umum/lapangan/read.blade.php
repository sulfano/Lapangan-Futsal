@extends('layout.umum')
@section('content')
@foreach($lapangan as $lapangan)
  <div class="content-wrapper">
<div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$lapangan->nama}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Lapangan</a></li>
          <li class="active">Rincian</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-info">  
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Foto</span></h4>
                </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{Storage::url('upload/'.$lapangan->foto1)}}" alt="img" style="width: 100%" alt="Foto 1">
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{Storage::url('upload/'.$lapangan->foto2)}}" alt="img" style="width: 100%">
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{Storage::url('upload/'.$lapangan->foto3)}}" alt="img" style="width: 100%">
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{Storage::url('upload/'.$lapangan->foto4)}}" alt="img" style="width: 100%">
                        </div>
                    </div>
                  </div>
              </div>
              <div class="box-footer"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="box box-solid">
              <div class="box-body">
                <div id="map">
  <script type="text/javascript">
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat:{{$lapangan->latitude}}, lng: {{$lapangan->longitude}}},
    zoom: 15,
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
  google.maps.event.addDomListener(window, 'load', initMap);
  addMarker({{$lapangan->latitude}},{{$lapangan->longitude}},'{{$lapangan->nama}}');
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-rC19kVhLyovpMskctJ2kcSIO5rx972Y&callback=initMap">
</script>                
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="box box-danger">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Informasi</span></h4>
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped table-hover">
                      <tr>
                        <td>Nama</td>
                        <td>{{$lapangan->nama}}</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>{{$lapangan->alamat}}</td>
                      </tr>
                      <tr>
                        <td>Kelurahan</td>
                        <td>{{$lapangan->kelurahan}}</td>
                      </tr>
                      <tr>
                        <td>Harga Siang</td>
                        <td>{{$lapangan->hargasiang}}</td>
                      </tr>
                      <tr>
                        <td>Harga Malam</td>
                        <td>{{$lapangan->hargamalam}}</td>
                      </tr>
                      <tr>
                        <td>Harga Sewa</td>
                        <td>{{$lapangan->hargasewa}}</td>
                      </tr>
                      <tr>
                        <td>Lantai</td>
                        <td>{{$lapangan->lantai}}</td>
                      </tr>
                      <tr>
                        <td>Nama Pemilik</td>
                        <td>{{$lapangan->namapemilik}}</td>
                      </tr>
                      <tr>
                        <td>Nama Petugas</td>
                        <td>{{$lapangan->namapetugas}}</td>
                      </tr>
                      <tr>
                        <td>Panjang Lapangan</td>
                        <td>{{$lapangan->panjang}} M</td>
                      </tr>
                      <tr>
                        <td>Lebar Lapangan</td>
                        <td>{{$lapangan->lebar}} M</td>
                      </tr>
                      <tr>
                        <td>Rating</td>
                        <td><?php echo number_format($rating,2) ?></td>
                      </tr>
                      <tr>

                      <form class="form-horizontal" role="form" method="POST" action="{{route('rate')}}">
                      {{ csrf_field() }}
                      <td>
                        <input type="hidden" name="kodelapangan" value="{{$id}}">
                        <table class="table">
                          <tr>
                            <td><input type="radio" name="rating" value="1" required></input></td>
                            <td>1</td>
                            <td><input type="radio" name="rating" value="2" required></input></td>
                            <td>2</td>
                            <td><input type="radio" name="rating" value="3" required></input></td>
                            <td>3</td>
                            <td><input type="radio" name="rating" value="4" required></input></td>
                            <td>4</td>
                            <td><input type="radio" name="rating" value="5" required></input></td>
                            <td>5</td>
                          </tr>
                        </table>
                       <!--  <select id="example-square" name="rating">
                          <option value=""></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                       </select>  -->              
                      </td>
                      <td>
                      <a title="Rate" href="#" data-toggle="modal" data-target="#myModal{{$id}}" class="btn btn-flat bg-navy">Rate</a>
                      <div class="modal fade" id="myModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel"><font color="#000000">Rate</font></h4>
                            </div>

                            <div class="modal-body">
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cancel</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button type="submit" class="btn btn-flat btn-primary" name="rate">Confirm</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      </td>
                      </form>
                        
                      </tr>
                    </table>
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

@endforeach
@endsection