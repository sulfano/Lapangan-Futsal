@extends('layout.admin')
@section('content')
@foreach($lapangan as $lapangan)
  <div class="content-wrapper">
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
          <div class="col-lg-6">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Lapangan</span></h4>
                </div>
                <!-- /.start -->
                <div class="col-lg-12">
                  <table class="table table-hover table-striped">
                    <tr>
                      <td>Akun</td>
                      <td><a href="{{route('admin.member.read',[$lapangan->idpeople])}}">{{$lapangan->idpeople}}</a></td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td>{{$lapangan->kodelapangan}}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{$lapangan->alamat}}</td>
                    </tr>
                    <tr>
                      <td>Kelurahan</td>
                      <td>{{$lapangan->kelurahan}}</td>
                    </tr>
                    <tr>
                      <td>Harga Siang</td>
                      <td>{{$lapangan->hargasiang}}</td>
                    </tr>
                    <tr>
                      <td>Harga Malam</td>
                      <td>{{$lapangan->hargamalam}}</td>
                    </tr>
                    <tr>
                      <td>Harga Sewa</td>
                      <td>{{$lapangan->hargasewa}}</td>
                    </tr>
                    <tr>
                      <td>Lantai</td>
                      <td>{{$lapangan->lantai}}</td>
                    </tr>
                    <tr>
                      <td>Panjang</td>
                      <td>{{$lapangan->panjang}}</td>
                    </tr>
                    <tr>
                      <td>Lebar</td>
                      <td>{{$lapangan->lebar}}</td>
                    </tr>
                    <tr>
                      <td>Latitude</td>
                      <td>{{$lapangan->latitude}}</td>
                    </tr>
                    <tr>
                      <td>Longitude</td>
                      <td>{{$lapangan->longitude}}</td>
                    </tr>  
                    <tr>
                      <td>Pemilik</td>
                      <td>{{$lapangan->namapemilik}}</td>
                    </tr>
                    <tr>
                      <td>Petugas</td>
                      <td>{{$lapangan->namapetugas}}</td>
                    </tr>                     
                  </table>
                </div>
                <!-- /.end -->
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Foto</span></h4>
                </div>
                <div class="col-lg-12">
                  <img src="{{Storage::url('upload/'.$lapangan->foto1)}}" style="width: 100%; margin-bottom: 20px">
                  <img src="{{Storage::url('upload/'.$lapangan->foto2)}}" style="width: 100%; margin-bottom: 20px">
                  <img src="{{Storage::url('upload/'.$lapangan->foto3)}}" style="width: 100%; margin-bottom: 20px">
                  <img src="{{Storage::url('upload/'.$lapangan->foto4)}}" style="width: 100%; margin-bottom: 20px">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->

    </div>
    <!-- /.container -->
@endforeach
@endsection