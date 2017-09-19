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
			<div class="col-md-2">
				<div class="box box-primary">
					<div class="box-body">
						<a href="{{route('ml.booking.create')}}" class="btn btn-primary btn-flat" style="width: 100%; margin-bottom: 10px;"><i class="fa fa-plus"></i> Booking</a>
						<!-- <a href="#" class="btn btn-danger btn-flat" style="width: 100%; margin-bottom: 10px;"><i class="fa fa-calendar-check-o"></i> Periksa Jadwal</a> -->
					</div>
				</div>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Keterangan Button</h3>
            </div>
            <div class="box-body">
            <table class="table table-striped table-responsive">
              <tr>
                <td><i class="btn btn-info btn-flat"><i class="fa fa-pencil"></i></i></td>
                <td>Ubah</td>
              </tr>
<!--               <tr>
                <td><i class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></i></td>
                <td>Hapus</td>
              </tr> -->
              <tr>
                <td><i class="btn btn-success btn-flat"><i class="fa fa-times"></i></i></td>
                <td>Batal Transaksi</td>
              </tr>
              <tr>
                <td><i class="btn bg-navy btn-flat"><i class="fa fa-save"></i></i></td>
                <td>Simpan</td>
              </tr>
              <tr>
                <td><i class="btn btn-flat bg-maroon"><i class="fa fa-money"></i></i></td>
                <td>Bayar</td>
              </tr>
            </table>
            </div>
          </div>				
			</div>
			<div class="col-md-10">

				<div class="row">	
				<div class="col-md-12">					
					<div class="box box-primary">
						<div class="box-header with-border">
			              	<i class="fa fa-money"></i>
			              	<h3 class="box-title">Booking Hari Ini</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Pembooking</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Total</th>
									<th>Uang Muka</th>
									<th>Piutang</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								@foreach($bookingtoday as $c)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$c->pembooking}}</td>		
									<td>{{$c->tanggal}}</td>		
									<td>{{$c->jam}}</td>						
									<td>{{$c->total}}</td>						
									<td>{{$c->nominal}}</td>						
									<td>{{$c->piutang}}</td>						
									<td>
									@if($c->status==1)
										Prosesing
									@elseif($c->status==2)
										Done
									@elseif($c->status==3)
										Dibatalkan
									@elseif($c->status==4)
										Berhutang
									@endif	
									</td>		
									<td>
									@if($c->status==1 or $c->status==4)
										<a href="{{route('ml.booking.proses',[$c->id])}}" class="btn btn-flat bg-maroon"><i class="fa fa-money"></i></a>
										<a href="{{route('ml.booking.cancel',[$c->id])}}" class="btn btn-flat btn-success"><i class="fa fa-times"></i></a>
										<a href="{{route('ml.booking.update',[$c->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>
<!--                     <a title="Delete" href="#" data-toggle="modal" data-target="#myModal{{$c->id}}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                      <div class="modal fade" id="myModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel"><font color="#000000">Delete</font></h4>
                            </div>

                            <div class="modal-body">
                                <p>Are You Sure ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">No</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <a href="{{route('ml.booking.delete',[$c->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>	
                        </div> -->
									@endif
									</td>
								</tr>
								@endforeach								
							</table>
							{{$bookingtoday->links()}}
							
						</div>
					</div>
				</div>
				</div>
				<div class="row">	
				<div class="col-md-12">					
					<div class="box box-primary">
						<div class="box-header with-border">
			              	<i class="fa fa-money"></i>
			              	<h3 class="box-title">Transaksi yang belum sesesai</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Pembooking</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								@foreach($transaksi as $c)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$c->pembooking}}</td>		
									<td>{{$c->tanggal}}</td>		
									<td>{{$c->jam}}</td>						
									<td>
									@if($c->status==1)
										Prosesing
									@elseif($c->status==2)
										Done
									@elseif($c->status==3)
										Dibatalkan
									@elseif($c->status==4)
										Berhutang
									@endif			
									<td>
										<a href="{{route('ml.booking.proses',[$c->id])}}" class="btn btn-flat bg-maroon"><i class="fa fa-money"></i></a>
										<a href="{{route('ml.booking.cancel',[$c->id])}}" class="btn btn-flat btn-success"><i class="fa fa-times"></i></a>
										<a href="{{route('ml.booking.update',[$c->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>
<!--                     <a title="Delete" href="#" data-toggle="modal" data-target="#myModal{{$c->id}}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                      <div class="modal fade" id="myModal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel"><font color="#000000">Delete</font></h4>
                            </div>

                            <div class="modal-body">
                                <p>Are You Sure ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">No</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <a href="{{route('ml.booking.delete',[$c->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>	
                        </div> -->
									</td>
								</tr>
								@endforeach								
							</table>
							
						</div>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">						
					<div class="box box-primary">
						<div class="box-header with-border">
			              	<i class="fa fa-money"></i>
			              	<h3 class="box-title">Booking Mendatang</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Pembooking</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								@foreach($tomorrow as $a)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$a->pembooking}}</td>		
									<td>{{$a->tanggal}}</td>		
									<td>{{$a->jam}}</td>						
									<td>{{$a->status}}</td>		
									<td>
										<a href="{{route('ml.booking.cancel',[$a->id])}}" class="btn btn-flat btn-success"><i class="fa fa-times"></i></a>
										<a href="{{route('ml.booking.update',[$a->id])}}" class="btn btn-flat btn-warning"><i class="fa fa-pencil"></i></a>
                    <a title="Delete" href="#" data-toggle="modal" data-target="#myModal{{$a->id}}" class="btn btn-flat bg-navy"><i class="fa fa-trash"></i></a>
                      <div class="modal fade" id="myModal{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel"><font color="#000000">Delete</font></h4>
                            </div>

                            <div class="modal-body">
                                <p>Are You Sure ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">No</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <a href="{{route('ml.booking.delete',[$a->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>	
                        </div>
									</td>
								</tr>
								@endforeach								
							</table>
							{{$tomorrow->links()}}
						</div>
					</div>
				</div>
				</div>				
				<div class="row">
				<div class="col-md-12">						
					<div class="box box-primary">
						<div class="box-header with-border">
			              	<i class="fa fa-money"></i>
			              	<h3 class="box-title">Booking</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Pembooking</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Status</th>
								</tr>
								@foreach($booking as $b)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$b->pembooking}}</td>		
									<td>{{$b->tanggal}}</td>		
									<td>{{$b->jam}}</td>		
									<td>	
									@if($b->status==1)
										Prosesing
									@elseif($b->status==2)
										Done
									@elseif($b->status==3)
										Dibatalkan
									@elseif($b->status==4)
										Berhutang
									@endif	
									</td>						
								</tr>
								@endforeach
							</table>
							{{$booking->links()}}							
						</div>
					</div>
				</div>
				</div>
			</div>
			</div>
		</section>
	</div>
</div>
@endsection