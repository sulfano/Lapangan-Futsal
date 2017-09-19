@extends('layout.admin')
@section('content')
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$kecamatan->nama}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Kecamatan</a></li>
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
                  <h4><span>Kecamatan</span></h4>
                </div>
                <!-- /.start -->
                <div class="col-lg-12">
                  <table class="table table-hover table-striped">
                    <tr>
                      <td>Nama Kecamatan</td>
                      <td>{{$kecamatan->nama}}</td>
                    </tr>
                    <tr>
                      <td>Latitude</td>
                      <td>{{$kecamatan->latitude}}</td>
                    </tr>
                    <tr>
                      <td>Longitude</td>
                      <td>{{$kecamatan->longitude}}</td>
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
@endsection