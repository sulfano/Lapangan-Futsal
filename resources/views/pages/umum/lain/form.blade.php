@extends('layout.umum')
@section('content')
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Masuk
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Masuk</li>
        </ol>
      </section>
 
      <!-- Main content -->
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
          <div class="col-lg-4">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Masuk</span></h4>
                </div>
                <div class="col-lg-12">
<form role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  has-feedback">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Email" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif     
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  has-feedback">
            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
    </div>

    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">
            Login
            </button>
        </div>
            <!-- /.col -->
    </div>

<!--     <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
    </div> -->                        
</form>                
<!--                   <form role="form" method="POST" class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Username</label>
                      <div class="col-md-9">
                        <input type="username" class="form-control" placeholder="Username" name="username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Password</label>
                      <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-flat bg-navy pull-right" name="masuk">Masuk</button>
                    </div>
                  </form> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Daftar</span></h4>
                </div>
                <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('registrasi') }}">
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label class="col-md-3 control-label">Nama</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nama" name="name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Email</label>
                      <div class="col-md-9">
                        <input type="email" class="form-control" placeholder="Email" name="email">
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
                        <input type="date" class="form-control" name="tanggallahir">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Nomor HP</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nomor HP" name="nomorhp">
                      </div>
                    </div>
                      <div class="form-group">
                          <label class="control-label col-md-3">Alamat</label>
                          <div class="col-md-9">
                              <textarea name="alamat" class="form-control" rows="3"></textarea>
                          </div>
                      </div>                    
                   <!--  <div class="form-group">
                      <label class="col-md-3 control-label">Pilihan</label>
                      <div class="col-md-9">
                        <div class="col-md-6"><input type="radio" name="level" value="2">Acara </div>
                        <div class="col-md-6"><input type="radio" name="level" value="1">Lapangan </div>
                      </div>
                    </div> -->
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
                    <div class="col-md-12"><button class="btn btn-flat bg-navy pull-right" name="daftar" type="submit">Daftar</button></div>
                      
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