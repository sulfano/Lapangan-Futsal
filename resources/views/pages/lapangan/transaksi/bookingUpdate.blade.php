@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
          <h1>
              Booking
          </h1>
          <ol class="breadcrumb">
              <li>Beranda</li>
              <li class="active">Booking</li>
          </ol>     
    </section>
    <section class="content">
	      <div class="row">
	      <div class="col-md-6">
	      <div class="box-body">
	        <div class="alert alert-warning alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <h4><i class="icon fa fa-warning"></i> Warning!</h4>
	          <p>Jika data Total dan Piutang tidak muncul, silahkan ubah isi Lama atau Uang Muka !!</p>
	        </div>
	      </div>
	      </div>
	      </div>    
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Booking</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" role="form" action="{{route('ml.booking.save',[$booking->id])}}">
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-10">
                    <input type="text" name="nama" class="form-control" value="{{$booking->pembooking}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Tanggal</label>
                  <div class="col-md-10">
                    <input type="date" name="tanggal" class="form-control" value="{{$booking->tanggal}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Jam</label>
                  <div class="col-md-10">
                    <input type="time" name="jam" class="form-control" value="{{$booking->jam}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Lama</label>
                  <div class="col-md-10">
                    <input type="text" name="lama" id="lama" class="form-control" oninput="tampil()" value="{{$booking->lama}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Uang Muka</label>
                  <div class="col-md-10">
                    <input type="text" name="nominal" id="nominal" class="form-control" oninput="tampil()" value="{{$booking->nominal}}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Total</label>
                  <div class="col-md-10">
                    <input type="text" name="total" id="total" class="form-control" readonly="">
                  </div>
                </div>                
                <div class="form-group">
                  <label class="control-label col-md-2">Piutang</label>
                  <div class="col-md-10">
                    <input type="text" name="piutang" id="piutang" class="form-control" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-10">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
<script type="text/javascript">
  function tampil(){
  var $harga = {{$harga}};
  var $lama = document.getElementById("lama").value;
  var $tot = document.getElementById("total");
  $tot.value = Number($harga)*Number($lama);
  var $nominal = document.getElementById("nominal").value;
  var $total = document.getElementById("total").value;
  var $piutang = document.getElementById("piutang");
  $piutang.value = Number($total)-Number($nominal);
  }
</script>