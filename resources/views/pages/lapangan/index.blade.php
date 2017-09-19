@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Beranda
        </h1>
        <ol class="breadcrumb">
          <li class="active"></li>
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
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{Storage::url('upload/a.jpg')}}" alt="First slide">

                    <div class="carousel-caption">
                      First Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{Storage::url('upload/b.jpg')}}" alt="Second slide">

                    <div class="carousel-caption">
                      Second Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{Storage::url('upload/c.jpg')}}" alt="Third slide">

                    <div class="carousel-caption">
                      Third Slide
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
          </div>      
        <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            @foreach($lapangan as $lapangan)
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{$lapangan->nama}}</h3>
                <h3><?php echo number_format($lapangan->rating,2) ?></h3>

                <p>{{$lapangan->voter}} Voter</p>
              </div>
              <div class="icon">
                <i class="fa fa-futbol-o"></i>
              </div>
              <a href="{{route('ml.lapangan.update',[$lapangan->kodelapangan])}}" class="small-box-footer">Perbarui Informasi Lapangan <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            @endforeach
          </div>

          <div class="col-lg-6">
            <!-- small box -->

            <div class="small-box bg-red">
              <div class="inner">
                <h3>Pengunjung</h3>
                <h3>{{$pengunjung}}</h3>

                <p>Dihitung berdasarkan pembookingan dan penyewaan</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('ml.lapangan.update',[$lapangan->kodelapangan])}}" class="small-box-footer">Perbarui Informasi Lapangan <i class="fa fa-arrow-circle-right"></i></a>
            </div>
           
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  @endsection