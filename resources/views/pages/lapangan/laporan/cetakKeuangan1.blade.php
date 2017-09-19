<?php 
	$bulan = date("F", mktime(0, 0, 0, $month, 10));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
</head>
<style>
.laporan {
	margin:auto;
	width: 545px;
}

.page-break {
    page-break-after: always;
}

</style>
<body>
<div class="laporan">
	<div style="border: solid 1px #000;  padding:10px 10px 10px 10px;">
	<table width="525px">
		<tr>
			<td colspan="3"><center>{{$nama}}</center></td>
		</tr>
		<tr>
			<td colspan="3"><center>Laporan Laba Rugi</center></td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: solid 1px #000;"><center>Untuk Periode Yang Berakhir {{$bulan}} {{$year}}</center></td>
		</tr>
		<tr>
			<td>Pendapatan Sewa</td>
			<td></td>
			<td>Rp {{$labarugi['pendapatan']}}</td>
		</tr>
		<tr>
			<td>Beban Usaha</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Gaji</td>
			<td>Rp {{$labarugi['gaji']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Listrik</td>
			<td>Rp {{$labarugi['listrik']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Air</td>
			<td>Rp {{$labarugi['air']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Perawatan</td>
			<td>Rp {{$labarugi['perawatan']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pajak</td>
			<td>Rp {{$labarugi['pajak']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Akum.peny.peralatan</td>
			<td><u>Rp {{$labarugi['akumulasi']}}</u></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Beban</td>
			<td></td>
			<td><u>(Rp {{$labarugi['totalbeban']}})</u></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Laba Bersih</strong></td>
			<td></td>
			<td>Rp {{$labarugi['lababersih']}}</td>
		</tr>
	</table>
	</div>
	<br><br>


	<div style="border: solid 1px #000; padding:10px 10px 10px 10px;">
	<table width="525px">
		<tr>
			<td colspan="3"><center>{{$nama}}</center></td>
		</tr>
		<tr>
			<td colspan="3"><center>Laporan Arus Kas</center></td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: solid 1px #000;"><center>Untuk Periode Yang Berakhir {{$bulan}} {{$year}}</center></td>
		</tr>
		<tr>
			<td><strong>Arus Kas dari Aktivitas Operasi</strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Penerimaan kas dari pelanggan</td>
			<td></td>
			<td>Rp {{$aruskas['penerimaankas']}}</td>
		</tr>
		<tr>
			<td>Pembayaran kas dari pemasok dan karyawan:</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Listrik</td>
			<td>Rp {{$labarugi['listrik']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Air</td>
			<td>Rp {{$labarugi['air']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Gaji</td>
			<td>Rp {{$labarugi['gaji']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beban Perawatan</td>
			<td><u>Rp {{$labarugi['perawatan']}}</u></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><u>(Rp {{$aruskas['beban']-$aruskas['pajak']}})</u></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kas yang dihasilkan dari aktivitas operasi</td>
			<td></td>
			<td>Rp {{$aruskas['kashasiloperasi']}}</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembayaran Pajak</td>
			<td></td>
			<td><u>(Rp {{$aruskas['pajak']}})</u></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Arus kas bersih dari aktivitas operasi</td>
			<td></td>
			<td>Rp {{$aruskas['kasbersihoperasi']}}</td>
		</tr>
		<tr>
			<td><strong>Arus Kas dari Aktivitas Investasi</strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembelian Perlengkapan</td>
			<td></td>
			<td><u>(Rp {{$aruskas['perlengkapan']}})</u></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Arus kas bersih dari aktivitas investasi</td>
			<td></td>
			<td>Rp {{$aruskas['kasbersihinvestasi']}}</td>
		</tr>
		<tr>
			<td><strong>Arus Kas dari Aktivitas Pendanaan</strong></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Investasi Awal</td>
			<td>Rp {{$aruskas['investasi']}}</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prive Pemilik</td>
			<td><u>(Rp {{$aruskas['prive']}})</u></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><u>Rp {{$aruskas['sisainvestasi']}}</u></td>
		</tr>
		<tr>
			<td>Kenaikan bersih kas dan setara kas</td>
			<td></td>
			<td>Rp {{$aruskas['kenaikankas']}}</td>
		</tr>
		<tr>
			<td>Kas dan setara kas pada awal periode</td>
			<td></td>
			<td>Rp {{$aruskas['kas']}}</td>
		</tr>
		<tr>
			<td>Kas dan setara kas akhir periode</td>
			<td></td>
			<td>Rp {{$aruskas['kasakhirperiode']}}</td>
		</tr>
	</table>
	</div>
	<br><br>
	<div class="page-break"></div>
	<div style="border: solid 1px #000; padding:10px 10px 10px 10px;">
	<table width="525px">
		<tr>
			<td colspan="3"><center>{{$nama}}</center></td>
		</tr>
		<tr>
			<td colspan="3"><center>Laporan Perubahan Modal</center></td>
		</tr>
		<tr>
			<td colspan="3" style="border-bottom: solid 1px #000;"><center>Untuk Periode Yang Berakhir  {{$bulan}} {{$year}}</center></td>
		</tr>
		<tr>
			<td>Modal Awal</td>
			<td></td>
			<td>Rp {{$perubahanmodal['modalawal']}}</td>
		</tr>
		<tr>
			<td>Laba Bersih</td>
			<td></td>
			<td>Rp {{$labarugi['lababersih']}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Rp {{$perubahanmodal['modalsebelumprive']}}</td>
		</tr>
		<tr>
			<td>Prive</td>
			<td></td>
			<td><u>(Rp {{$aruskas['prive']}})</u></td>
		</tr>
		<tr>
			<td>Modal Akhir</td>
			<td></td>
			<td>Rp {{$perubahanmodal['modalakhir']}}</td>
		</tr>
	</table>
	</div>
	<br><br>
	<div style="border: solid 1px #000; padding:10px 10px 10px 10px;">
	<table width="525px">
		<tr>
			<td colspan="4"><center>Lapangan Futsal</center></td>
		</tr>
		<tr>
			<td colspan="4"><center>Neraca</center></td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: solid 1px #000;"><center>Untuk Periode Yang Berakhir {{$bulan}} {{$year}}</center></td>
		</tr>
		<tr>
			<td colspan="2" style="border-right: solid 1px #000;"><center>Aktiva</center></td>
			<td colspan="2"><center>Passiva</center></td>
		</tr>
		<tr>
			<td>Kas</td>
			<td style="border-right: solid 1px #000;">Rp {{$neraca['kas']}}</td>
			<td>Hutang</td>
			<td>Rp {{$neraca['hutang']}}</td>
		</tr>
		<tr>
			<td>Piutang</td>
			<td style="border-right: solid 1px #000;">Rp {{$neraca['piutang']}}</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Perlengkapan</td>
			<td style="border-right: solid 1px #000;">Rp {{$neraca['perlengkapan']}}</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Peralatan</td>
			<td style="border-right: solid 1px #000;">Rp {{$neraca['peralatan']}}</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Akum.peny.peralatan</td>
			<td style="border-right: solid 1px #000;"><u>(Rp {{$neraca['akumulasi']}})</u></td>
			<td>Modal</td>
			<td><u>Rp {{$neraca['modal']}}</u></td>
		</tr>
		<tr>
			<td>Jumlah Aktiva</td>
			<td style="border-right: solid 1px #000;">Rp {{$neraca['aktiva']}}</td>
			<td>Jumlah Passiva</td>
			<td>Rp {{$neraca['passiva']}}</td>
		</tr>
		</table>
	</div>
	<br><br>
</div>


<!-- jQuery 2.2.3 -->
<script src="/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>