@extends('layout.umum')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
      </h1>
      <ol class="breadcrumb">
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
              <div class="box-body">
                <div class="col-md-8">
                  <div class="row">
                  <div class="col-md-12">
                    <div class="dividerHeading">
                      <h4><span>Lapangan</span></h4>
                    </div>                
                
                    @foreach($lapangan as $lapangan)
                    <a href="lapangan/{{$lapangan->kodelapangan}}">
                    <div class="col-md-3 col-md-3 col-sm-6" style="margin-bottom: 20px">
                      <div class="our-team">
                          <div class="pic">
                              <img src="{{Storage::url('upload/'.$lapangan->foto1)}}" alt="profile img" style="width: 100%">
                          </div>
                          <div class="team_prof">
                              <h3 class="names">{{$lapangan->nama}}</h3>
                          </div>
                      </div>
                    </div>
                    </a>                  
                    @endforeach   
                  </div>
                  </div>
                  <div class="row">             
                  <div class="col-md-12">             
                    <div class="dividerHeading">
                      <h4><span>Acara</span></h4>
                    </div>
                    @foreach($acara as $acaras)
                    <div class="col-md-12 no-padding" style="background-color: #f7f7f7; margin-bottom: 20px">
                      <div class="col-md-3 no-padding">
                        <a href="/acara/{{$acaras->id}}">
                        <div class="product_img">
                          <img src="{{Storage::url('upload/'.$acaras->brosur)}}" style="width: 100%;" alt="Brosur" />
                        </div>
                        </a>
                      </div>
                      <div class="col-md-9" style="">
                        <h4>{{$acaras->namaacara}}</h4>
                        <strong><i class="fa fa-user"></i> Di Upload Oleh</strong> : {{$acaras->nama}}<br>
                        <strong><i class="fa fa-clock-o"></i> Di Upload Pada</strong> : {{$acaras->created_at}}<br>
                        <strong><i class="fa fa-pencil-square"></i> Pendafataran</strong> : {{$acaras->awal_daftar}} Sampai {{$acaras->akhir_daftar}}<br>
                        <strong><i class="fa fa-pencil-square-o"></i> Pelaksanaan</strong>  : {{$acaras->tanggalmulai}} Sampai {{$acaras->tanggalakhir}}<br>
                      </div>
                    </div>               
                    @endforeach
                    {{$acara->links()}}
                  </div>
                  </div>
                  
                </div>
                <div class="col-md-4">
                  <div class="row">  
                    <div class="col-md-12">        
                      <div class="dividerHeading">
                        <h4><span>Acara Terdekat</span></h4>
                      </div>
                      @foreach($terdekat as $a)
                      <div class="col-md-12 no-padding"  style="background-color: #f7f7f7;margin-bottom: 20px">
                        <div class="col-md-2 no-padding">
                          <a href="/acara/{{$a->id}}">
                          <div class="product_img">
                            <img src="{{Storage::url('upload/'.$a->brosur)}}"  style="width: 100%">
                          </div>
                          </a>
                        </div>
                        <div class="col-md-10">
                          <h4>{{$a->namaacara}}</h4>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <div class="row">  
                    <div class="col-md-12">        
                      <div class="dividerHeading">
                        <h4><span>Top Lapangan</span></h4>
                      </div>
                      @foreach($top as $top)
                      <div class="col-md-12 no-padding"  style="background-color: #f7f7f7;margin-bottom: 20px">
                        <div class="col-md-2 no-padding">
                          <a href="/lapangan/{{$top->kodelapangan}}">
                          <div class="product_img">
                            <img src="{{Storage::url('upload/'.$top->foto1)}}"  style="width: 100%">
                          </div>
                          </a>
                        </div>
                        <div class="col-md-10">
                          <h4>{{$top->nama}}</h4>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
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