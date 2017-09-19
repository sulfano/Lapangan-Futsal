<table class="table table-striped table-hover table-responsive">
@foreach($jadwal as $jadwal)
	<tr>
		<td>{{$jadwal->jam}}</td>
	</tr>
@endforeach
</table>
