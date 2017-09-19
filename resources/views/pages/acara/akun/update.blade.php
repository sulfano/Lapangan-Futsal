@extends('layout.acara')
@section('content')
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Akun
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Akun</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-12">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Update Akun</span></h4>
                </div>
                <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="POST" action="{{route('memberacara.update',[$user->id])}}">
                  <!-- {{ csrf_field() }} -->
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label class="col-md-3 control-label">Nama</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nama" name="name" value="{{$user->nama}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-9">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}">
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                        <input type="date" class="form-control" name="tanggallahir" value="{{$user->tanggallahir}}">
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
                              <textarea name="alamat" class="form-control" rows="3">{{$user->alamat}}
                              </textarea>
                          </div>
                      </div>                    
                    <div class="form-group">
                    <div class="col-md-12">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                      <button class="btn btn-flat bg-navy pull-right" name="update" type="submit"><i class="fa fa-save"></i></button>
                    </div>
                    </div>
                  </form>
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