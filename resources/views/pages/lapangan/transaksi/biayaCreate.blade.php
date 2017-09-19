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
			<div class="row">
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Gaji</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Gaji">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Listrik</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Listrik">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Air</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Air">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Perawatan</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Pembelian Perlengkapan</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Perlengkapan">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Pajak</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.create')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Pajak">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<button type="submit" class="btn btn-flat bg-navy"><i class="fa fa-save"></i></button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>				
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Prive</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.prive')}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="Prive">
										<input type="text" name="nominal" class="form-control">
									</div>
									<div class="col-md-2">
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