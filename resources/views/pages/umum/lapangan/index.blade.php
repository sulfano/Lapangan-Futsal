@extends('layout.umum')
@section('content')
<div class="content-wrapper">
<div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Lapangan
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Lapangan</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-danger">
              <div class="box-body">
                <div class="col-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="dividerHeading">
                        <h4><span>Kecamatan</span></h4>
                      </div>
                      @foreach($kecamatan as $kecamatan)
                      <div class="col-lg-12" style="margin-bottom: 10px;">
                        <!-- <a href="/lapangan/kecamatan/{{$kecamatan->id}}" class="btn btn-info btn-flat" style="width: 100%"> {{$kecamatan->nama}}</a> -->
                        <button class="btn btn-info btn-flat" style="width: 100%" value="{{$kecamatan->id}}" onclick="show(this.value)"> {{$kecamatan->nama}}</button>
                      </div>
                      @endforeach  
                      <div class="col-lg-12"><hr></div>
                    </div>                  
                  </div>                  
                </div>
                <div class="col-lg-8">
                  <div class="dividerHeading">
                    <h4><span>Lapangan</span></h4>
                  </div>
                  <div id="filter">
                    @foreach($lapanganbaru as $new)
                    <div class="col-lg-12 no-padding" style="background-color: #f7f7f7; margin-bottom: 20px">
                      <div class="col-lg-3 no-padding">
                        <a href="{{route('lapangan.read',[$new->kodelapangan])}}">
                        <div class="product_img">
                          <img src="{{Storage::url('upload/'.$new->foto1)}}"  style="width: 100%">
                        </div>
                        </a>
                      </div>
                      <div class="col-lg-9" style="">
                        <h4>{{$new->nama}}<span class="label label-warning pull-right">{{$new->created_at}}</span></h4>
                        <strong><i class="fa fa-user"></i> Di Upload Oleh</strong> : {{$new->uploader}}<br>
                        <strong><i class="fa fa-clock-o"></i> Di Upload Pada</strong> : {{$new->created_at}}<br>
                      </div>
                    </div>
                    @endforeach  

                    {{$lapanganbaru->links()}}  
                  </div>              
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

<script>
function show(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("filter").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("filter").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/lapangan/kecamatan/"+str, true);
  xhttp.send();
}
</script>