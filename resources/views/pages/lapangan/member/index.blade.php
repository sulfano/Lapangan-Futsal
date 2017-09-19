@extends('layout.lapangan')
@section('content')
<div class="content-wrapper">
  <div class="container">
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
        <div class="col-md-4">
        	<div class="box box-primary">
        		<div class="box-header">
	              <i class="fa fa-clock-o"></i>
	              <h3 class="box-title">Waktu Digunakan</h3>
          		</div>
          		<div class="box-body">
          			<div class="form-group">
          				<select name="day" class="form-control"  onchange="showTime(this.value)">
          					<option>- Hari -</option>
                      	@foreach($hari as $value)
                      		<option value="{{$value}}">{{$value}}</option>
                      	@endforeach
          				</select>
          			</div>
          			<div id="jadwal"></div>
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
              <tr>
                <td><i class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></i></td>
                <td>Hapus</td>
              </tr>
            </table>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <!-- AREA CHART -->
          <div class="box box-primary">
          <div class="box-header">
              <i class="fa fa-users"></i>
              <h3 class="box-title">Member</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <a href="{{ route('ml.member.create') }}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah</a>  
              </div>
              <!-- /. tools -->
          </div>
            <div class="box-body">
            <table class="table table-striped table-responsive">
            	<tr>
            		<th>No</th>
            		<th>Nama</th>
            		<th>Hari</th>
            		<th>Jam</th>
            		<th>Aksi</th>
            	</tr>
            
            	<?php $no=0; ?>
                @foreach ($member as $members)
                <tr>
                	<td>{{++$i}}</td>
                	<td>{{$members->nama}}</td>
                	<td>{{$members->hari}}</td>
                	<td>{{$members->jam}}</td>
                	<td>

                		<a href="{{route('ml.member.update',[$members->id])}}" class="btn btn-flat btn-info"><i class="fa fa-pencil"></i></a>
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
                                <a href="{{route('ml.member.delete',[$members->id])}}" class="btn btn-flat btn-danger">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>                        
                	</td>
                </tr>
				@endforeach
			</table>
      		{{$member->links()}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
    </div>
        
      </section>
      <!-- /.content -->
</div>
    <!-- /.container -->
  </div>
  @endsection

<script>
function showTime(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("jadwal").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("jadwal").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "/memberlapangan/jadwal/"+str, true);
  xhttp.send();
}
</script>