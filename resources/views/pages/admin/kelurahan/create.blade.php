@extends('layout.admin')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Kelurahan
      </h1>
      <ol class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Kelurahan</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Kelurahan</h3>
            </div>
            <div class="box-body">
              <form class="form form-horizontal" method="POST" action="{{route('admin.kelurahan.store')}}">
              <!-- {{ csrf_field() }} -->
                <div class="  form-group">
      						<label class="control-label col-md-3">Nama</label>
      						<div class="col-md-9">
      							<input type="text" name="nama" class="form-control"></input>
      						</div>
                </div>
                <div class="form-group">
      						<label class="control-label col-md-3">Latitude</label>
      						<div class="col-md-9">
                    <select name="idkecamatan" class="form-control">
                      @foreach($kecamatan as $kecamatan)
                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                      @endforeach
                    </select>
      						</div>
                </div>
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">  
                  <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                  <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
                  </div>
                </div>                
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
