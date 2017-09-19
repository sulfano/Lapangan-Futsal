@extends('layout.admin')
@section('content')
@foreach($member as $member)
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$member->nama}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Member</a></li>
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
                  <h4><span>Member</span></h4>
                </div>
                <!-- /.start -->
                <div class="col-lg-12">
                  <table class="table table-hover table-striped">
                    <tr>
                      <td>Nama</td>
                      <td>{{$member->nama}}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{$member->alamat}}</td>
                    </tr>
                    <tr>
                      <td>Nomor HP</td>
                      <td>{{$member->nomorhp}}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$member->email}}</td>
                    </tr>
                    <tr>
                      <td>Jenis Kelamin</td>
                      <td>
                        <?php if($member->jk=1) echo 'Laki-laki'; else echo 'Perempuan'; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Lahir</td>
                      <td>{{$member->tanggallahir}}</td>
                    </tr>
                    <tr>
                      <td>Level</td>
                      <td>
                      <?php 
                        if ($member->level=5)
                          echo 'Member Lapangan';
                        else if ($member->level=6)
                          echo 'Member Acara';
                      ?>
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