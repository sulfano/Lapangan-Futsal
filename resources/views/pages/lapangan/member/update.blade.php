@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
      <h1>
        Member
      </h1>
      <ol class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Member</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Member</h3>
            </div>
            <div class="box-body">
              <form class="form form-horizontal" method="POST" action="{{route('ml.member.save',[$member->id])}}">
              <!-- {{ csrf_field() }} -->
                <div class="form-group" hidden>
                   <label class="control-label col-md-3">Kode Lapangan</label>
                   <div class="col-md-9">
                      <input type="text" name="kodelapangan" class="form-control" value="{{$lapangan->kodelapangan}}">
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Nama</label>
                   <div class="col-md-9">
                      <input type="text" name="nama" class="form-control" required="" value="{{$member->nama}}">
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Hari</label>
                   <div class="col-md-9">
                      <select name="hari" class="form-control">
                      	@foreach($hari as $value)
                      		<option value="{{$value}}">{{$value}}</option>
                      	@endforeach
                      </select>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Jam</label>
                   <div class="col-md-9">
                      <input type="time" name="jam" class="form-control" required="" value="{{$member->jam}}">
                   </div>
                </div>
               
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">  
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
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
</div>
@endsection
