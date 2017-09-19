@extends('layout.umum')
@section('content')
<div class="content-wrapper">
  <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Acara
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Acara</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-danger">
              <div class="box-body">
                <div class="col-md-4">
                  <div class="dividerHeading">
                    <h4><span>Bulan</span></h4>
                  </div>
                  <div class="col-md-12">
                    <button value="1" class="btn btn-flat btn-danger col-md-4"  onclick="show(this.value)">Januari</button>
                    <button value="2" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Februari</button>
                    <button value="3" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Maret</button>
                    <button value="4" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">April</button>
                    <button value="5" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Mei</button>
                    <button value="6" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Juni</button>
                    <button value="7" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Juli</button>
                    <button value="8" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Agustus</button>
                    <button value="9" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">September</button>
                    <button value="10" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Oktober</button>
                    <button value="11" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">November</button>
                    <button value="12" class="btn btn-flat btn-danger col-md-4" onclick="show(this.value)">Desember</button>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="dividerHeading">
                    <h4><span>Terbaru</span></h4>
                  </div>
                  <div id="filter">
                  @foreach($acara as $acaras)
                  <div class="col-md-12 no-padding" style="background-color: #f7f7f7; margin-bottom: 20px">
                    <div class="col-md-3 no-padding">
                      <a href="{{route('acara.read',[$acaras->id])}}">
                      <div class="product_img">
                        <img src="{{Storage::url('upload/'.$acaras->brosur)}}" style="width: 100%;" alt="Brosur" />
                      </div>
                      </a>
                    </div>
                      <div class="col-md-9" style="">
                        <h4>{{$acaras->namaacara}}</h4>
                        <strong><i class="fa fa-user"></i> Di Upload Oleh</strong> : {{$acaras->nama}}<br>
                        <strong><i class="fa fa-clock-o"></i> Di Upload Pada</strong> : {{$acaras->created_at}}<br>
                        <strong><i class="fa fa-pencil-square"></i> Pendafataran</strong> : {{$acaras->awal_daftar}} Sampai {{$acaras->akhir_daftar}}<br>
                        <strong><i class="fa fa-pencil-square-o"></i> Pelaksanaan</strong>  : {{$acaras->tanggalmulai}} Sampai {{$acaras->tanggalakhir}}<br>
                      </div>
                  </div>
                  @endforeach  
                  {{$acara->links()}}  
                  </div>             
                </div>
              </div>
            </div>
          </div>
        </div>          
      </section>
      <!-- /.content -->
      </div>
    <!-- /.container -->
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
  xhttp.open("GET", "/acara/bulan/"+str, true);
  xhttp.send();
}
</script>