@extends('layout.admin')
@section('content')
@foreach($kelurahan as $kelurahan)
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$kelurahan->nama}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Kelurahan</a></li>
          <li class="active">Rincian</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-6">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Kelurahan</span></h4>
                </div>
                <!-- /.start -->
                <div class="col-lg-12">
                  <table class="table table-hover table-striped">
                    <tr>
                      <td>Nama Kelurahan</td>
                      <td>{{$kelurahan->nama}}</td>
                    </tr>
                    <tr>
                      <td>Kecamatan</td>
                      <td>{{$kelurahan->kecamatan}}</td>
                    </tr>                    
                  </table>
                </div>
                <!-- /.end -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    <!-- /.container -->
  </div>
@endforeach
@endsection