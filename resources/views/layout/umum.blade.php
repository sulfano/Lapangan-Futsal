<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Futsal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="/assets/dist/img/football-soccer-ball-48-183228.png">
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
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/assets/plugins/iCheck/square/blue.css">  

  <link rel="stylesheet" href="/assets/dist/themes/bars-square.css">
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
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}">Beranda</a></li>
            <li><a href="{{route('acara')}}">Acara</a></li>
            <li><a href="{{route('lapangan')}}">Lapangan </a></li>
            <li><a href="{{route('peta')}}">Peta </a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
      <!-- User Account Menu -->
            <li><a href="/login">Masuk</a></li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  @yield('content');
  <!-- /.content-wrapper -->
  <!--start footer-->
    
  <!--end footer-->
  
  <section class="footer_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 ">
          <p class="copyright">&copy; Politeknik Negeri Padang |  <a href="http://ti.polinpdg.ac.id">Teknologi Informasi</a></p>        
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
<!-- Velocity -->
<script src="/assets/plugins/velocity/jquery.fractionslider.js"></script>
<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="/assets/dist/js/jquery.barrating.js"></script>
<script src="/assets/dist/js/examples.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  </script>

</body>
</html>
