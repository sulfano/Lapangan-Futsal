@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
      <section class="content-header">
        <h1>
          Laporan
        </h1>
        <ol class="breadcrumb">
          <li>Beranda</li>
          <li class="active">Laporan</li>
        </ol>
      </section>

      <section class="content">
      @if (Session::has('message'))
      <div class="row">
      <div class="col-md-12">
      <div class="box-body">
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4>
          <p>{{ Session::get('message') }}</p>
        </div>
      </div>
      </div>
      </div>
      @endif      
      
      <div class="row">
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <button class="btn btn-flat bg-navy" style="width: 100%; margin-bottom: 10px;" value="keuangan" onclick="show(this.value)">Tutup Buku</button>
                  <button class="btn btn-flat bg-navy" style="width: 100%; "  value="detail" onclick="show(this.value)">Detail</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-file"></i>
                  <h3 class="box-title">Seleksi Laporan Keuangan</h3>
                </div>
                <div class="box-body">
                  <form method="post" role="form" class="form-horizontal" action="{{route('ml.laporan.getkeuangan')}}" target="_blank">
                    <div class="form-group">
                      <div class="col-md-12" style="margin-bottom: 10px;">
                        <select name="bulan" class="form-control">
                          <option> - Bulan - </option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                      </div>
                      <div class="col-md-12" style="margin-bottom: 10px;">
                        <select name="tahun" class="form-control">
                          <option> - Tahun - </option>
                          <?php $i=2000; ?>
                          @while ($i<2050)
                            <option value="{{$i=$i+1}}">{{$i}}</option>
                          @endwhile
                        </select>
                      </div>
                      <div class="col-md-12" style="margin-bottom: 10px;">
                      <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                        <button type="submit" class="btn btn-flat btn-primary" style="width: 100%;">Proses</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <i class="fa fa-file"></i>
                  <h3 class="box-title">Seleksi Laporan Detail</h3>
                </div>
                <div class="box-body">
                  <form method="post" role="form" class="form-horizontal" action="{{route('ml.laporan.getdetail')}}" target="_blank">
                    <div class="form-group">
                      <div class="col-md-12" style="margin-bottom: 10px;">
                        <select name="bulan" class="form-control">
                          <option> - Bulan - </option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                        </select>
                      </div>
                      <div class="col-md-12" style="margin-bottom: 10px;">
                        <select name="tahun" class="form-control">
                          <option> - Tahun - </option>
                          <?php $i=2000; ?>
                          @while ($i<2050)
                            <option value="{{$i=$i+1}}">{{$i}}</option>
                          @endwhile
                        </select>
                      </div>
                      <div class="col-md-12" style="margin-bottom: 10px;">
                      <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                        <button type="submit" class="btn btn-flat btn-primary" style="width: 100%;">Proses</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-file"></i>
                <h3 class="box-title">Laporan</h3>
            </div>
            <div class="box-body">
              <div id="laporan"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
  @endsection

<script>
function show(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("laporan").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("laporan").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/memberlapangan/laporan/"+str, true);
  xhttp.send();
}
</script>  
