<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Futsal | Member Lapangan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Velocity -->
  <link rel="stylesheet" href="/assets/plugins/velocity/fractionslider.css">
  <link rel="stylesheet" href="/assets/plugins/velocity/style.css">
  <link rel="stylesheet" href="/assets/plugins/velocity/style-fraction.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="/assets/plugins/morris/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav layout-boxed">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top" style="background-color: #ecf0f5 ">
      <div class="container">
        <div class="navbar-header">
          <a href="/home">
          <img src="/assets/dist/img/logo2.png"></a>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Acara</a></li>
            <li><a href="#">Lapangan </a></li>
            <li><a href="#">Member </a></li>
            <li><a href="#">Transaksi </a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
      <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/assets/dist/img/user.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{Auth::user()->nama}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/assets/dist/img/user.png" class="img-circle" alt="User Image">

                  <p>
                    {{Auth::user()->nama}} - Member Lapangan
                    <small>{{Auth::user()->created_at}}</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" 
                                 class="btn btn-flat btn-danger">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Lapangan
      </h1>
      <ol class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Lapangan</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
      <div class="col-md-12">
      <div class="box-body">
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          <p>Ukuran maksimal untuk 1 foto adalah 2 MB</p>
        </div>
      </div>
      </div>
      </div>     
      <form class="form form-horizontal" method="POST" action="{{route('ml.lapangan.store')}}"  enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Lapangan</h3>
              </div>
              <div class="box-body">
                
                <!-- {{ csrf_field() }} -->

                  <div class="  form-group">
                    <label class="control-label col-md-3">Kode Lapangan</label>
                    <div class="col-md-9">
                      <input type="text" name="kodelapangan" class="form-control" readonly value="LAP<?php echo sprintf("%04s",$kode) ?>">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama</label>
                    <div class="col-md-9">
                      <input type="text" name="nama" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-9">
                      <textarea class="form-control" name="alamat" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="col-md-9">
                      <select name="kelurahan" class="form-control">
                      @foreach($kelurahan as $kel)
                        <option value="{{$kel->id}}">{{$kel->nama}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 1</label>
                    <div class="col-md-9">
                      <input type="file" name="foto1" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 2</label>
                    <div class="col-md-9">
                      <input type="file" name="foto2" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 3</label>
                    <div class="col-md-9">
                      <input type="file" name="foto3" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Foto 4</label>
                    <div class="col-md-9">
                      <input type="file" name="foto4" class="form-control">
                    </div>
                  </div>

                  <div class="  form-group">
                    <div class="col-md-9">
                      <input type="hidden" name="idpeople" class="form-control" readonly value="{{Auth::user()->id}}">
                    </div>
                  </div>                  
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Lapangan</h3>
              </div>
              <div class="box-body">
                  
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Siang</label>
                    <div class="col-md-9">
                      <input type="text" name="hargasiang" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Malam</label>
                    <div class="col-md-9">
                      <input type="text" name="hargamalam" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Harga Sewa</label>
                    <div class="col-md-9">
                      <input type="text" name="hargasewa" class="form-control">
                    </div>
                  </div>

                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama Pemilik</label>
                    <div class="col-md-9">
                      <input type="text" name="namapemilik" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Nama Petugas</label>
                    <div class="col-md-9">
                      <input type="text" name="namapetugas" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Latitude</label>
                    <div class="col-md-9">
                      <input type="text" name="latitude" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Longitude</label>
                    <div class="col-md-9">
                      <input type="text" name="longitude" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Panjang</label>
                    <div class="col-md-9">
                      <input type="text" name="panjang" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Lebar</label>
                    <div class="col-md-9">
                      <input type="text" name="lebar" class="form-control">
                    </div>
                  </div>
                  <div class="  form-group">
                    <label class="control-label col-md-3">Lantai</label>
                    <div class="col-md-9">
                      <input type="text" name="lantai" class="form-control">
                    </div>
                  </div>                   
                  
              </div>
            </div>
          </div>
        </div>
                <div class="row">
          <div class="col-md-11">
            <div class="box box-danger">
              <div class="box-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Perkiraan Umur</label>
                  <div class="col-md-1">
                    <input type="number" class="form-control" name="masa" id="masa">
                  </div>
                  <label class="control-label col-md-2">Modal Pembangunan</label>
                  <div class="col-md-2">
                    <input class="form-control" name="peralatan" id="peralatan" oninput="tampil()" placeholder="Pembangunan">
                  </div>
                  <label class="control-label col-md-1">Kas</label>
                  <div class="col-md-2">
                    <input class="form-control" name="kas" id="kas" oninput="tampil()" placeholder="Kas Awal">
                  </div>
                  <div class="col-md-2">
                    <input class="form-control" name="modal" id="modal" readonly="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="box box-danger">
              <div class="box-body"> 
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
</div>
  <section class="footer_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 ">
                    <p class="copyright">&copy; Copyright 2014 Velocity | Powered by  <a href="http://www.jqueryrain.com/">jQuery Rain</a></p>
        </div>
        
        <div class="col-lg-6 ">
          <div class="footer_social">
            <ul class="footbot_social">
              <li><a class="fb" href="#." data-placement="top" data-toggle="tooltip" title="Facbook"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twtr" href="#." data-placement="top" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#." data-placement="top" data-toggle="tooltip" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="skype" href="#." data-placement="top" data-toggle="tooltip" title="Skype"><i class="fa fa-skype"></i></a></li>
              <li><a class="rss" href="#." data-placement="top" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Velocity -->
<script src="/assets/plugins/velocity/jquery.fractionslider.js"></script>
<script type="text/javascript">
  function tampil(){
  var $peralatan = document.getElementById("peralatan").value;
  var $kas = document.getElementById("kas").value;
  var $modal = document.getElementById("modal");
  $modal.value = Number($peralatan)+Number($kas);
  }
</script>

</body>
</html>
