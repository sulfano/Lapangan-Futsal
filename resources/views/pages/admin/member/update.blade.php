@extends('layout.admin')
@section('content')
<div class="content-wrapper">
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
              <form class="form-horizontal" role="form" method="POST" action="{{route('admin.member.update',[$user->id])}}">
                  {{ csrf_field() }}
                    <div class="form-group">
                      <label class="col-md-3 control-label">Nama</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{$user->nama}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-9">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Password</label>
                      <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                         @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Ulang Password</label>
                      <div class="col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Jenis Kelamin</label>
                      <div class="col-md-9">
                        <div class="col-md-6"><input type="radio" name="jk" value="1">Laki-laki </div>
                        <div class="col-md-6"><input type="radio" name="jk" value="2">Perempuan </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Tanggal Lahir</label>
                      <div class="col-md-9">
                        <input type="date" class="form-control" name="tanggallahir"  value="{{$user->tanggallahir}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Nomor HP</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nomor HP" name="nomorhp" value="{{$user->nomorhp}}">
                      </div>
                    </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">Alamat</label>
                          <div class="col-md-9">
                              <textarea name="alamat" class="form-control" rows="3">{{$user->alamat}}</textarea>
                          </div>
                      </div>                    
                    <div class="form-group">
                      <label class="col-md-3 control-label">Pilihan</label>
                      <div class="col-md-9">
                        @foreach($role as $roles)
                        <div class="col-md-6">
                        <input type="radio" name="level" value="{{$roles->id}}">
                          @if($roles->id==5)
                            Member Lapangan
                          @elseif($roles->id==6)
                            Member Acara
                          @endif 
                        </div>
                        @endforeach
                      </div>
                    </div>
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">  
                  <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                  <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
                  <a href="{{route('admin.member')}}" class="btn btn-flat btn-warning"><i class="fa fa-ban"></i></a>
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
