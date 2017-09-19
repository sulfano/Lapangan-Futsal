@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
          <h1>
              Booking
          </h1>
          <ol class="breadcrumb">
              <li>Beranda</li>
              <li class="active">Booking</li>
          </ol>     
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Booking</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" role="form" action="{{route('ml.booking.store')}}">
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-10">
                    <input type="text" name="nama" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Tanggal</label>
                  <div class="col-md-10">
                    <input type="date" name="tanggal" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Jam</label>
                  <div class="col-md-10">
                    <input type="time" name="jam" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Lama</label>
                  <div class="col-md-10">
                    <input type="text" name="lama" id="lama" class="form-control" oninput="tampil()">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Uang Muka</label>
                  <div class="col-md-10">
                    <input type="text" name="nominal" id="nominal" class="form-control" oninput="tampil()">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-10">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
