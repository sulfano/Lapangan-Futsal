@extends('layout.admin')
@section('content')
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Acara {{$acara->id}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Acara</a></li>
          <li class="active">Rincian</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-6">
            <div class="box box-solid">
              <div class="box-body">
                <div class="hoverlay">
                  <img src="{{Storage::url('upload/'.$acara->brosur)}}" alt="" />
                  <div class="hoverlay-box">
                      <div class="hoverlay-data ">
                          <h5></h5>
                          <span></span>
                          <a class="hover-zoom mfp-image" href="{{route('image',[$acara->brosur])}}" target="_blank">
                              <i class="fa fa-search"></i>
                          </a>
                      </div>
                  </div>
              </div>
              </div>
            </div>      
          </div>
          <div class="col-lg-6">
            <div class="box box-info">
              <div class="box-body">
                <div class="dividerHeading">
                  <h4><span>Acara</span></h4>
                </div>
                <!-- /.start -->
                <div class="col-lg-12">
                  <table class="table table-hover table-striped">
                    <tr>
                      <td>Nama Acara</td>
                      <td>{{$acara->namaacara}}</td>
                    </tr>
                    <tr>
                      <td>Pelaksana</td>
                      <td>{{$acara->pelaksana}}</td>
                    </tr>
                    <tr>
                      <td>Pendaftaran</td>
                      <td>{{$acara->jadwalpendaftaran}}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Mulai</td>
                      <td>{{$acara->tanggalmulai}}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Akhir</td>
                      <td>{{$acara->tanggalakhir}}</td>
                    </tr>
                    <tr>
                      <td>Jam</td>
                      <td>{{$acara->jammulai}} Sampai {{$acara->jamakhir}}</td>
                    </tr>
                    <tr>
                      <td>Kontak</td>
                      <td>{{$acara->namakontak1}}({{$acara->kontak1}})<br>{{$acara->namakontak2}}({{$acara->kontak2}})</td>
                    </tr>
                    <tr>
                      <td>Biaya</td>
                      <td>{{$acara->biaya}}/{{$acara->satuan}}</td>
                    </tr>
                    <tr>
                      <td>Target</td>
                      <td>{{$acara->target}}</td>
                    </tr> 
                    <tr>
                      <td>Total Hadiah</td>
                      <td>{{$acara->totalhadiah}}</td>
                    </tr>
                    <tr>
                      <td>Hadiah Utama</td>
                      <td>{{$acara->hadiahutama}}</td>
                    </tr>
                    <tr>
                      <td>Kuota</td>
                      <td>{{$acara->kuota}} Tim</td>
                    </tr> 
                    <tr>
                      <td>Memperebutkan</td>
                      <td>{{$acara->memperebutkan}}</td>
                    </tr>
                    <tr>
                      <td>Tempat</td>
                      <td>{{$acara->tempat}}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{$acara->alamat}}</td>
                    </tr>
                    <tr>
                      <td>Detail</td>
                      <td><?php echo $acara->detail?> </td>
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