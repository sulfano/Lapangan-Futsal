<?php 
	$bulan = date("F", mktime(0, 0, 0, $month, 10));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail</title>
	  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">	
</head>
<body>
	<div>
	<table class="table table-striped table-hover table-responsive table-bordered" border="2">
		<tr>
			<td colspan="9"><center>{{$nama}}</center></td>
		</tr>
		<tr>
			<td colspan="9"><center>Transaksi di Lapangan</center></td>
		</tr>
		<tr>
			<td colspan="9" style="border-bottom: solid 1px #000;"><center>Untuk Periode Yang Berakhir {{$bulan}} {{$year}}</center></td>
		</tr>	
		<tr>
			<th>No</th>
			<th>Waktu</th>
			<th>Keterangan</th>
			<th>Debit</th>
			<th>Kredit</th>
			<th>Hutang</th>
			<th>Pelunasan Hutang</th>
			<th>Piutang</th>
			<th>Pelunasan Piutang</th>
		</tr>
		<?php $i=0; ?>
		@foreach($laporan as $laporan)
		<tr>
			<td>{{$i=$i+1}}</td>
			<td>{{$laporan->created_at}}</td>
			<td>{{$laporan->perkiraan}}</td>
			<td>{{$laporan->debit}}</td>
			<td>{{$laporan->kredit}}</td>
			<td>{{$laporan->hutang}}</td>
			<td>{{$laporan->bayar_hutang}}</td>
			<td>{{$laporan->piutang}}</td>
			<td>{{$laporan->bayar_piutang}}</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="3">Total</td>
			<td>{{$sum['1']}}</td>
			<td>{{$sum['2']}}</td>
			<td>{{$sum['3']}}</td>
			<td>{{$sum['4']}}</td>
			<td>{{$sum['5']}}</td>
			<td>{{$sum['6']}}</td>
		</tr>		
		<tr>
			<td colspan="3">Kas awal</td>
			<td>{{$sum['7']}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3">Prive</td>
			<td></td>
			<td>{{$sum['8']}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td colspan="3">Perhitungan</td>
			<td colspan="2">Kas : {{$sum['9']}}</td>
			<td colspan="2">Hutang : {{$sum['10']}}</td>
			<td colspan="2">Piutang : {{$sum['11']}}</td>
		</tr>

	</table>		
	</div>	
	<!-- jQuery 2.2.3 -->
<script src="/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>