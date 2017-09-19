@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
	<div class="container">
		<section class="content-header">
	        <h1>
	          	Biaya
	        </h1>
	        <ol class="breadcrumb">
	          	<li>Beranda</li>
	          	<li class="active">Biaya</li>
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
						<a href="{{route('ml.biaya.create')}}" class="btn btn-info btn-flat" style="width: 100%; margin-bottom: 10px;"><i class="fa fa-plus"></i> Transaksi</a>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">	
				<div class="col-md-12">				
					<div class="box box-primary">
						<div class="box-header with-border">
			              	<i class="fa fa-money"></i>
			              	<h3 class="box-title">Biaya Bulan Ini</h3>					
						</div>
						<div class="box-body">
							<table class="table table-striped table-hover table-responsive">
								<tr>
									<th>No</th>
									<th>Keterangan</th>
									<th>Bulan</th>
									<th>Tanggal Bayar</th>
									<th>Nominal</th>
									<th>Aksi</th>
								</tr>
								@foreach($month as $c)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$c->keterangan}}</td>		
									<td>{{ date("F", mktime(0, 0, 0, $c->bulan, 10))}}</td>		
									<td>{{$c->tanggalbayar}}</td>			
									<td>{{$c->nominal}}</td>									
									<td>
										<a href="{{route('ml.biaya.update',[$c->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>	
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
                                <a href="{{route('ml.biaya.delete',[$c->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>	
                        </div>	 -->																	
									</td>	
								</tr>
								@endforeach								
							</table>
							{{$month->links()}}
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
									<th>Keterangan</th>
									<th>Bulan</th>
									<th>Tanggal Bayar</th>
									<th>Nominal</th>

								</tr>
								@foreach($biaya as $b)
								<tr>
									<td>{{++$i}}</td>		
									<td>{{$b->keterangan}}</td>		
									<td>{{ date("F", mktime(0, 0, 0, $b->bulan, 10))}}</td>		
									<td>{{$b->tanggalbayar}}</td>			
									<td>{{$b->nominal}}</td>						
					
								</tr>
								@endforeach
							</table>
							{{$biaya->links()}}							
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