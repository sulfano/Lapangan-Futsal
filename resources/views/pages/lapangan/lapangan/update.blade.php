@extends('layout.lapangan')
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
      <div class="row">
      <form class="form form-horizontal" method="POST" action="{{route('ml.lapangan.save',[$lapangan->kodelapangan])}}" enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">lapangan</h3>
            </div>
            <div class="box-body">
              
              <!-- {{ csrf_field() }} -->

                <div class="  form-group">
                  <label class="control-label col-md-3">Kode Lapangan</label>
                  <div class="col-md-9">
                    <input type="text" name="kodelapangan" class="form-control" readonly value="{{$lapangan->kodelapangan}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Nama</label>
                  <div class="col-md-9">
                    <input type="text" name="nama" class="form-control" value="{{$lapangan->nama}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Alamat</label>
                  <div class="col-md-9">
                    <textarea class="form-control" name="alamat" rows="2"> {{$lapangan->alamat}}</textarea>
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
                    <input type="file" name="fotoa" class="form-control">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Foto 2</label>
                  <div class="col-md-9">
                    <input type="file" name="fotob" class="form-control">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Foto 3</label>
                  <div class="col-md-9">
                    <input type="file" name="fotoc" class="form-control">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Foto 4</label>
                  <div class="col-md-9">
                    <input type="file" name="fotod" class="form-control">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Lantai</label>
                  <div class="col-md-9">
                    <input type="text" name="lantai" class="form-control" value="{{$lapangan->lantai}}">
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
                    <input type="text" name="hargasiang" class="form-control" value="{{$lapangan->hargasiang}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Harga Malam</label>
                  <div class="col-md-9">
                    <input type="text" name="hargamalam" class="form-control" value="{{$lapangan->hargamalam}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Harga Sewa</label>
                  <div class="col-md-9">
                    <input type="text" name="hargasewa" class="form-control" value="{{$lapangan->hargasewa}}">
                  </div>
                </div>

                <div class="  form-group">
                  <label class="control-label col-md-3">Nama Pemilik</label>
                  <div class="col-md-9">
                    <input type="text" name="namapemilik" class="form-control" value="{{$lapangan->namapemilik}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Nama Petugas</label>
                  <div class="col-md-9">
                    <input type="text" name="namapetugas" class="form-control" value="{{$lapangan->namapetugas}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Latitude</label>
                  <div class="col-md-9">
                    <input type="text" name="latitude" class="form-control" value="{{$lapangan->latitude}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Longitude</label>
                  <div class="col-md-9">
                    <input type="text" name="longitude" class="form-control" value="{{$lapangan->longitude}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Panjang</label>
                  <div class="col-md-9">
                    <input type="text" name="panjang" class="form-control" value="{{$lapangan->panjang}}">
                  </div>
                </div>
                <div class="  form-group">
                  <label class="control-label col-md-3">Lebar</label>
                  <div class="col-md-9">
                    <input type="text" name="lebar" class="form-control"  value="{{$lapangan->lebar}}"lebar>
                  </div>
                </div>              
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">  
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
                  <a href="{{route('ml.lapangan')}}" class="btn btn-flat btn-warning"><i class="fa fa-ban"></i></a>
                  </div>
                </div>                
            </div>
          </div>
        </div>
              </form>
      </div>
    </section>
      <!-- /.content -->

    </div>
    </div>
    <!-- /.container -->
@endforeach
@endsection