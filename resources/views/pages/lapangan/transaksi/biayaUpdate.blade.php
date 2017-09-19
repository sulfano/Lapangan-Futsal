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
							<h3 class="box-title">{{$biaya->keterangan}}</h3>
						</div>
						<div class="box-body">
							<form class="form-horizontal" method="post" role="form" action="{{route('ml.biaya.save',[$biaya->id])}}">
								<div class="form-group">
									<div class="col-md-10">
										<input type="hidden" name="keterangan" value="{{$biaya->keterangan}}">
										<input type="hidden" name="kodelapangan" value="{{$biaya->kodelapangan}}">
										<input type="text" name="nominal" class="form-control" value="{{$biaya->nominal}}">
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