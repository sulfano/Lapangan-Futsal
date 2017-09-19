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
              <form class="form-horizontal" method="post" role="form" action="{{route('ml.sewa.change',[$sewa->id])}}">
                <div class="form-group">
                  <label class="control-label col-md-2">Total</label>
                  <div class="col-md-10">
                    <input type="text" name="total" id="total" class="form-control" value="{{$total}}" readonly="">
                     <input type="hidden" name="nama" class="form-control" value="{{$sewa->penyewa}}" readonly="">                    
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Telah Dibayar</label>
                  <div class="col-md-10">
                    <input type="text" name="nominal" id="nominal" class="form-control" value="{{$dibayar}}" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Piutang</label>
                  <div class="col-md-10">
                    <input type="hidden" name="piutangb" class="form-control" value="{{$piutang}}">
                    <input type="text" name="piutang" id="piutang" class="form-control" value="{{$piutang}}" oninput="hitung()">
                  </div>
                </div>                
                <div class="form-group">
                  <label class="control-label col-md-2">Hutang</label>
                  <div class="col-md-10">
                    <input type="hidden" name="hutangb" class="form-control" value="{{$hutang}}">
                    <input type="text" name="hutang" id="hutang" class="form-control" value="{{$hutang}}">
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
	function hitung(){
		var $hutang;
		var $piutang = {{$sewa->piutang}};
		var $bayar = document.getElementById("piutang").value;
		if(Number($bayar)>Number($piutang))
			$hutang=Number($bayar)-Number($piutang);
		else
			$hutang=0;
		var $output = document.getElementById("hutang");
		$output.value=$hutang;
	}
</script>
