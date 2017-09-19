@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
          <h1>
              Sewa
          </h1>
          <ol class="breadcrumb">
              <li>Beranda</li>
              <li class="active">Sewa</li>
          </ol>     
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sewa</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" role="form" action="{{route('ml.sewa.store')}}">
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-10">
                    <input type="text" name="nama" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Dari Tanggal</label>
                  <div class="col-md-10">
                    <input type="date" name="tanggalawal" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Lama</label>
                  <div class="col-md-10">
                    <input type="number" name="lama" id="lama" class="form-control" oninput="hitung()">
                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Dari Jam</label>
                  <div class="col-md-10">
                    <input type="time" name="jamawal" id="jamawal"class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Sampai Jam</label>
                  <div class="col-md-10">
                    <input type="time" name="jamakhir" id="jamakhir" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Uang Muka</label>
                  <div class="col-md-10">
                    <input type="text" name="nominal" id="nominal" class="form-control" oninput="tampil()">
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
  var $nominal = document.getElementById("nominal").value;
  var $total = document.getElementById("total").value;
  var $piutang = document.getElementById("piutang");
  $piutang.value = Number($total)-Number($nominal);
  }
function hitung(){
	var lama=document.getElementById("lama").value;
	var harga={{$harga}};
	var total=harga*lama;
	$('#total').val(total)
}

</script>
