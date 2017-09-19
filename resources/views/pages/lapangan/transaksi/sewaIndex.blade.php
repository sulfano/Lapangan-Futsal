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
						<a href="{{route('ml.sewa.create')}}" class="btn btn-primary btn-flat" style="width: 100%; margin-bottom: 10px;"><i class="fa fa-plus"></i> Sewa</a>
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
			              	<h3 class="box-title">Sewa Bulan Ini</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive table-bordered">
								<tr>
									<th>No</th>
									<th>Penyewa</th>
									<th>Tanggal</th>
									<th>Lama</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								@foreach($thismonth as $a)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$a->penyewa}}</td>		
									<td>{{$a->tanggalawal}}</td>		
									<td>{{$a->lama}} Hari</td>							
									<td>@if($a->status==1)
										Prosesing
									@elseif($a->status==2)
										Done
									@elseif($a->status==3)
										Dibatalkan
									@elseif($a->status==4)
										Berhutang
									@endif</td>							
									
									<td>
									@if($a->status==1 or $a->status==4)
										<a href="{{route('ml.sewa.proses',[$a->id])}}" class="btn btn-flat bg-maroon"><i class="fa fa-money"></i></a>
										<a href="{{route('ml.sewa.cancel',[$a->id])}}" class="btn btn-flat btn-success"><i class="fa fa-times"></i></a>
										<a href="{{route('ml.sewa.update',[$a->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>
<!--                     <a title="Delete" href="#" data-toggle="modal" data-target="#myModal{{$a->id}}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
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
                                <a href="{{route('ml.sewa.delete',[$a->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>	
                        </div> -->
									@endif
									</td>
								</tr>
								@endforeach								
							</table>
							{{$thismonth->links()}}
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
									<th>Penyewa</th>
									<th>Tanggal</th>
									<th>Lama</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								@foreach($transaksi as $c)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$c->penyewa}}</td>		
									<td>{{$c->tanggalawal}}</td>		
									<td>{{$c->lama}}</td>						
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
										<a href="{{route('ml.sewa.proses',[$c->id])}}" class="btn btn-flat bg-maroon"><i class="fa fa-money"></i></a>
										<a href="{{route('ml.sewa.cancel',[$c->id])}}" class="btn btn-flat btn-success"><i class="fa fa-times"></i></a>
										<a href="{{route('ml.sewa.update',[$c->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>
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
			              	<h3 class="box-title">Sewa</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Penyewa</th>
									<th>Tanggal</th>
									<th>Lama</th>
									<td>Status</td>	
								</tr>
								@foreach($transaksi as $c)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$c->penyewa}}</td>		
									<td>{{$c->tanggalawal}}</td>		
									<td>{{$c->lama}} Hari</td>
									<td>@if($c->status==1)
										Prosesing
									@elseif($c->status==2)
										Done
									@elseif($c->status==3)
										Dibatalkan
									@elseif($c->status==4)
										Berhutang
									@endif</td>								
								</tr>
								@endforeach								
							</table>
							{{$transaksi->links()}}
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