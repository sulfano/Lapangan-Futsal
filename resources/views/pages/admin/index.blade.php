@extends('layout.admin')

@section('content')
	<div class="content-wrapper">
	    <section class="content-header">
	     	<h1>
	        	Beranda
	      	</h1>
	      	<ol class="breadcrumb">
	        	<li><a href="#">Administrator</a></li>
	      	</ol>
	    </section>

		<section class="content">
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
    	</section>
	</div>
@endsection