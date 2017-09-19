@extends('layout.admin')
@section('content')
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Member
        </h1>
        <ol class="breadcrumb">
          <li>Beranda</li>
          <li class="active">Member</li>
        </ol>
      </section>

      <!-- Main content -->
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
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
              <i class="fa fa-users"></i>
              <h3 class="box-title">Member</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="{{ route('admin.member.create') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah</a> 
              </div>
              <!-- /. tools -->
					</div>
					<div class="box-body">
						<table class="table table-responsive table-hover table-striped">
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Alamat</th>
								<th>Nomor HP</th>
                <th>Email</th>
                <th>Level</th>
								<th>Aksi</th>
							</tr>
							@foreach($member as $members)
							<tr>
								<td>{{++$i}}</td>
								<td>{{$members->nama}}</td>
								<td>{{$members->alamat}}</td>
                <td>{{$members->nomorhp}}</td>
                <td>{{$members->email}}</td>
								<td>                      
                  <?php 
                    if ($members->level==5)
                      echo 'Member Lapangan';
                    else if ($members->level==6)
                      echo 'Member Acara';
                  ?></td>
              	<td>
          		    <a href="{{route('admin.member.read',[$members->id])}}" class="btn btn-flat bg-olive"><i class="fa fa-eye"></i></a>
              		<a href="{{route('admin.member.update',[$members->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>    		
                  <a title="Delete" href="#" data-toggle="modal" data-target="#myModal{{$members->id}}" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                      <div class="modal fade" id="myModal{{$members->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                                <a href="{{route('admin.member.delete',[$members->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>			                		
			                	</td>
							</tr>
							@endforeach
						</table>
						{!! $member->links() !!}
					</div>
				</div>
			</div>
		</div>            
      
        
      </section>
      <!-- /.content -->

    <!-- /.container -->
  </div>
  @endsection
