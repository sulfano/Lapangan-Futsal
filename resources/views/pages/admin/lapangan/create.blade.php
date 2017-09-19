@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Lapangan
      </h1>
      <ol class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Lapangan</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <div class="box-body">
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          <p>Ukuran maksimal untuk 1 foto adalah 2 MB</p>
        </div>
      </div>
      </div>
      </div>    
      <form class="form form-horizontal" method="POST" action="{{route('admin.lapangan.store')}}" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Lapangan</h3>
              </div>
              <div class="box-body">
                
                <!-- {{ csrf_field() }} -->

                  <div class="  form-group">
                    <label class="control-label col-md-3">Kode Lapangan</label>
                    <div class="col-md-9">
                      <input type="text" name="kodelapangan" class="form-control" readonly value="LAP<?php echo sprintf("%04s",$kode) ?>">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama</label>
                    <div class="col-md-9">
                      <input type="text" name="nama" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-9">
                      <textarea class="form-control" name="alamat" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="col-md-9">
                      <select name="kelurahan" class="form-control">
                      @foreach($kelurahan as $kel)
                        <option value="{{$kel->id}}">{{$kel->nama}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 1</label>
                    <div class="col-md-9">
                      <input type="file" name="foto1" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 2</label>
                    <div class="col-md-9">
                      <input type="file" name="foto2" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 3</label>
                    <div class="col-md-9">
                      <input type="file" name="foto3" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 4</label>
                    <div class="col-md-9">
                      <input type="file" name="foto4" class="form-control">
                    </div>
                  </div>

                  <div class="  form-group">
                    <div class="col-md-9">
                      <input type="hidden" name="idpeople" class="form-control" readonly value="{{Auth::user()->id}}">
                    </div>
                  </div>                  
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Lapangan</h3>
              </div>
              <div class="box-body">
                  
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Siang</label>
                    <div class="col-md-9">
                      <input type="text" name="hargasiang" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Malam</label>
                    <div class="col-md-9">
                      <input type="text" name="hargamalam" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Sewa</label>
                    <div class="col-md-9">
                      <input type="text" name="hargasewa" class="form-control">
                    </div>
                  </div>

                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama Pemilik</label>
                    <div class="col-md-9">
                      <input type="text" name="namapemilik" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama Petugas</label>
                    <div class="col-md-9">
                      <input type="text" name="namapetugas" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Latitude</label>
                    <div class="col-md-9">
                      <input type="text" name="latitude" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Longitude</label>
                    <div class="col-md-9">
                      <input type="text" name="longitude" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Panjang</label>
                    <div class="col-md-9">
                      <input type="text" name="panjang" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
        						<label class="control-label col-md-3">Lebar</label>
        						<div class="col-md-9">
        							<input type="text" name="lebar" class="form-control">
        						</div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Lantai</label>
                    <div class="col-md-9">
                      <input type="text" name="lantai" class="form-control">
                    </div>
                  </div>                   
                  
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <div class="box box-danger">
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Perkiraan Umur</label>
                  <div class="col-md-1">
                    <input type="number" class="form-control" name="masa" id="masa">
                  </div>
                  <label class="control-label col-md-2">Modal Pembangunan</label>
                  <div class="col-md-2">
                    <input class="form-control" name="peralatan" id="peralatan" oninput="tampil()" placeholder="Pembangunan">
                  </div>
                  <label class="control-label col-md-1">Kas</label>
                  <div class="col-md-2">
                    <input class="form-control" name="kas" id="kas" oninput="tampil()" placeholder="Kas Awal">
                  </div>
                  <div class="col-md-2">
                    <input class="form-control" name="modal" id="modal" readonly="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="box box-danger">
              <div class="box-body"> 
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
</div>
@endsection
<script type="text/javascript">
  function tampil(){
  var $peralatan = document.getElementById("peralatan").value;
  var $kas = document.getElementById("kas").value;
  var $modal = document.getElementById("modal");
  $modal.value = Number($peralatan)+Number($kas);
  }
</script>