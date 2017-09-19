<?php

Route::get ('/', 															 'HomeController@home');
Route::get ('/home', 					['as'=>'home',				'uses'=> 'HomeController@index']);
Route::get ('/peta', 					['as'=>'peta',				'uses'=> 'HomeController@peta']);
Route::get ('/acara', 					['as'=>'acara',				'uses'=> 'HomeController@acara']);
Route::get ('/lapangan', 				['as'=>'lapangan',			'uses'=> 'HomeController@lapangan']);
Route::post('/rate', 					['as'=>'rate',				'uses'=> 'HomeController@rating']);
Route::get ('/redirecting', 			['as'=>'redirecting',		'uses'=> 'HomeController@alihkan']);
Route::get ('/acara/{id}', 				['as'=>'acara.read',		'uses'=> 'HomeController@acaraRead']);
Route::get ('/acara/bulan/{id}',		['as'=>'acara.filter',		'uses'=> 'HomeController@acaraFilter']);
Route::get ('/lapangan/{id}', 			['as'=>'lapangan.read',		'uses'=> 'HomeController@lapanganRead']);
Route::get ('/lapangan/kecamatan/{id}', ['as'=>'lapangan.filter',	'uses'=> 'HomeController@lapanganFilter']);
Route::get ('/peta/kecamatan/{id}',		['as'=>'peta.filter',		'uses'=> 'HomeController@petaFilter']);
Route::get ('/image/{id}',				['as'=>'image',				'uses'=> 'HomeController@image1']);
Route::post('/registrasi',				['as'=>'registrasi',		'uses'=> 'HomeController@register']);

Auth::routes();

Route::group(['middleware' => ['auth']],function(){

Route::get ('/administrator', 						['as'=>'administrator',			'uses'=> 'AdminController@index',		'middleware' => ['role:administrator']]);

Route::get ('/administrator/kecamatan', 			['as'=>'admin.kecamatan',		'uses'=> 'KecamatanController@index',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kecamatan/create', 		['as'=>'admin.kecamatan.create','uses'=> 'KecamatanController@create',	'middleware' => ['role:administrator']]);
Route::post('/administrator/kecamatan/create', 		['as'=>'admin.kecamatan.store',	'uses'=> 'KecamatanController@store',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kecamatan/{id}', 		['as'=>'admin.kecamatan.read',	'uses'=> 'KecamatanController@read',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kecamatan/delete/{id}', ['as'=>'admin.kecamatan.delete','uses'=> 'KecamatanController@destroy',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kecamatan/update/{id}',	['as'=>'admin.kecamatan.update','uses'=> 'KecamatanController@update',	'middleware' => ['role:administrator']]);
Route::post('/administrator/kecamatan/update/{id}',	['as'=>'admin.kecamatan.save',	'uses'=> 'KecamatanController@save',	'middleware' => ['role:administrator']]);

Route::get ('/administrator/kelurahan', 			['as'=>'admin.kelurahan',		'uses'=> 'KelurahanController@index',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kelurahan/create', 		['as'=>'admin.kelurahan.create','uses'=> 'KelurahanController@create',	'middleware' => ['role:administrator']]);
Route::post('/administrator/kelurahan/create', 		['as'=>'admin.kelurahan.store',	'uses'=> 'KelurahanController@store',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kelurahan/{id}', 		['as'=>'admin.kelurahan.read',	'uses'=> 'KelurahanController@read',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kelurahan/delete/{id}', ['as'=>'admin.kelurahan.delete','uses'=> 'KelurahanController@destroy',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/kelurahan/update/{id}',	['as'=>'admin.kelurahan.update','uses'=> 'KelurahanController@update',	'middleware' => ['role:administrator']]);
Route::post('/administrator/kelurahan/update/{id}',	['as'=>'admin.kelurahan.save',	'uses'=> 'KelurahanController@save',	'middleware' => ['role:administrator']]);

Route::get ('/administrator/lapangan', 				['as'=>'admin.lapangan',		'uses'=> 'LapanganController@index',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/lapangan/create', 		['as'=>'admin.lapangan.create',	'uses'=> 'LapanganController@create',	'middleware' => ['role:administrator']]);
Route::post('/administrator/lapangan/create', 		['as'=>'admin.lapangan.store',	'uses'=> 'LapanganController@store',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/lapangan/{id}', 		['as'=>'admin.lapangan.read',	'uses'=> 'LapanganController@read',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/lapangan/delete/{id}', 	['as'=>'admin.lapangan.delete',	'uses'=> 'LapanganController@destroy',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/lapangan/update/{id}',	['as'=>'admin.lapangan.update',	'uses'=> 'LapanganController@update',	'middleware' => ['role:administrator']]);
Route::post('/administrator/lapangan/update/{id}',	['as'=>'admin.lapangan.save',	'uses'=> 'LapanganController@save',		'middleware' => ['role:administrator']]);

Route::get ('/administrator/acara',					['as'=>'admin.acara',			'uses'=> 'AcaraController@index',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/create/acara',			['as'=>'admin.acara.create',	'uses'=> 'AcaraController@create',		'middleware' => ['role:administrator']]);
Route::post('/administrator/create/acara',			['as'=>'admin.acara.store',		'uses'=> 'AcaraController@store',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/acara/{id}',			['as'=>'admin.acara.read',		'uses'=> 'AcaraController@read',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/acara/delete/{id}',		['as'=>'admin.acara.delete',	'uses'=> 'AcaraController@destroy',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/acara/update/{id}',		['as'=>'admin.acara.update',	'uses'=> 'AcaraController@update',		'middleware' => ['role:administrator']]);
Route::post('/administrator/acara/update/{id}',		['as'=>'admin.acara.save',		'uses'=> 'AcaraController@save',		'middleware' => ['role:administrator']]);

Route::get ('/administrator/member',				['as'=>'admin.member',			'uses'=> 'MemberController@index',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/create/member',			['as'=>'admin.member.create',	'uses'=> 'MemberController@create',		'middleware' => ['role:administrator']]);
Route::post('/administrator/create/member',			['as'=>'admin.member.store',	'uses'=> 'MemberController@store',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/member/{id}',			['as'=>'admin.member.read',		'uses'=> 'MemberController@read',		'middleware' => ['role:administrator']]);
Route::get ('/administrator/member/delete/{id}',	['as'=>'admin.member.delete',	'uses'=> 'MemberController@destroy',	'middleware' => ['role:administrator']]);
Route::get ('/administrator/member/update/{id}',	['as'=>'admin.member.update',	'uses'=> 'MemberController@update',		'middleware' => ['role:administrator']]);
Route::post('/administrator/member/update/{id}',	['as'=>'admin.member.save',		'uses'=> 'MemberController@save',		'middleware' => ['role:administrator']]);

Route::get ('/memberacara', 						['as'=>'memberacara',			'uses'=> 'MacaraController@index',		'middleware' => ['role:member-acara']]);
Route::get ('/memberacara/akun/{id}',				['as'=>'memberacara.akun',		'uses'=> 'MacaraController@akun',		'middleware' => ['role:member-acara']]);
Route::post('/memberacara/akun/{id}',				['as'=>'memberacara.update',	'uses'=> 'MacaraController@update',		'middleware' => ['role:member-acara']]);

Route::get ('/memberacara/acara',					['as'=>'ma.acara',				'uses'=> 'AcaraController@indexMA',		'middleware' => ['role:member-acara']]);
Route::get ('/memberacara/create/acara',			['as'=>'ma.acara.create',		'uses'=> 'AcaraController@createMA',	'middleware' => ['role:member-acara']]);
Route::post('/memberacara/create/acara',			['as'=>'ma.acara.store',		'uses'=> 'AcaraController@storeMA',		'middleware' => ['role:member-acara']]);
Route::get ('/memberacara/acara/{id}',				['as'=>'ma.acara.read',			'uses'=> 'AcaraController@readMA',		'middleware' => ['role:member-acara']]);
Route::get ('/memberacara/acara/delete/{id}',		['as'=>'ma.acara.delete',		'uses'=> 'AcaraController@destroyMA',	'middleware' => ['role:member-acara']]);
Route::get ('/memberacara/acara/update/{id}',		['as'=>'ma.acara.update',		'uses'=> 'AcaraController@updateMA',	'middleware' => ['role:member-acara']]);
Route::post('/memberacara/acara/update/{id}',		['as'=>'ma.acara.save',			'uses'=> 'AcaraController@saveMA',		'middleware' => ['role:member-acara']]);

Route::get ('/memberlapangan/check', 				['as'=>'memberlapangan',		'uses'=> 'MlapanganController@index',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/akun/{id}', 			['as'=>'memberlapangan.akun',	'uses'=> 'MlapanganController@akun',	'middleware' => ['role:member-lapangan']]);
Route::post ('/memberlapangan/akun/{id}', 			['as'=>'memberlapangan.update',	'uses'=> 'MlapanganController@update',	'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan', 						['as'=>'ml.lapangan',			'uses'=> 'LapanganController@indexML',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/lapangan', 		['as'=>'ml.lapangan.create',	'uses'=> 'LapanganController@createML',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/lapangan', 		['as'=>'ml.lapangan.store',		'uses'=> 'LapanganController@storeML',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/lapangan/update/{id}',	['as'=>'ml.lapangan.update',	'uses'=> 'LapanganController@updateML',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/lapangan/update/{id}',	['as'=>'ml.lapangan.save',		'uses'=> 'LapanganController@saveML',	'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/acara',				['as'=>'ml.acara',				'uses'=> 'AcaraController@indexML',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/acara',			['as'=>'ml.acara.create',		'uses'=> 'AcaraController@createML',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/acara',			['as'=>'ml.acara.store',		'uses'=> 'AcaraController@storeML',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/acara/{id}',			['as'=>'ml.acara.read',			'uses'=> 'AcaraController@readML',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/acara/delete/{id}',	['as'=>'ml.acara.delete',		'uses'=> 'AcaraController@destroyML',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/acara/update/{id}',	['as'=>'ml.acara.update',		'uses'=> 'AcaraController@updateML',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/acara/update/{id}',	['as'=>'ml.acara.save',			'uses'=> 'AcaraController@saveML',		'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/member',				['as'=>'ml.member',				'uses'=> 'LapmemberController@index',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/member',		['as'=>'ml.member.create',		'uses'=> 'LapmemberController@create',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/member',		['as'=>'ml.member.store',		'uses'=> 'LapmemberController@store',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/member/delete/{id}',	['as'=>'ml.member.delete',		'uses'=> 'LapmemberController@destroy',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/member/update/{id}',	['as'=>'ml.member.update',		'uses'=> 'LapmemberController@update',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/member/update/{id}',	['as'=>'ml.member.save',		'uses'=> 'LapmemberController@save',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/jadwal/{id}',			['as'=>'ml.member.jadwal',		'uses'=> 'LapmemberController@jadwal',	'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/booking',				['as'=>'ml.booking',			'uses'=> 'TransaksiController@bookingIndex',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/booking',		['as'=>'ml.booking.create',		'uses'=> 'TransaksiController@bookingCreate',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/booking',		['as'=>'ml.booking.store',		'uses'=> 'TransaksiController@bookingStore',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/booking/{id}',			['as'=>'ml.booking.read',		'uses'=> 'TransaksiController@bookingRead',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/booking/delete/{id}',	['as'=>'ml.booking.delete',		'uses'=> 'TransaksiController@bookingDestroy',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/booking/update/{id}',	['as'=>'ml.booking.update',		'uses'=> 'TransaksiController@bookingUpdate',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/booking/update/{id}',	['as'=>'ml.booking.save',		'uses'=> 'TransaksiController@bookingSave',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/booking/proses/{id}',	['as'=>'ml.booking.proses',		'uses'=> 'TransaksiController@bookingProses',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/booking/proses/{id}',	['as'=>'ml.booking.change',		'uses'=> 'TransaksiController@bookingChange',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/booking/batalkan/{id}',['as'=>'ml.booking.cancel',		'uses'=> 'TransaksiController@bookingBatal',	'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/sewa',					['as'=>'ml.sewa',				'uses'=> 'TransaksiController@sewaIndex',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/sewa',			['as'=>'ml.sewa.create',		'uses'=> 'TransaksiController@sewaCreate',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/sewa',			['as'=>'ml.sewa.store',			'uses'=> 'TransaksiController@sewaStore',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/sewa/{id}',			['as'=>'ml.sewa.read',			'uses'=> 'TransaksiController@sewaRead',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/sewa/delete/{id}',		['as'=>'ml.sewa.delete',		'uses'=> 'TransaksiController@sewaDestroy',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/sewa/update/{id}',		['as'=>'ml.sewa.update',		'uses'=> 'TransaksiController@sewaUpdate',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/sewa/update/{id}',		['as'=>'ml.sewa.save',			'uses'=> 'TransaksiController@sewaSave',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/sewa/proses/{id}',		['as'=>'ml.sewa.proses',		'uses'=> 'TransaksiController@sewaProses',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/sewa/proses/{id}',		['as'=>'ml.sewa.change',		'uses'=> 'TransaksiController@sewaChange',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/sewa/batalkan/{id}',	['as'=>'ml.sewa.cancel',		'uses'=> 'TransaksiController@sewaBatal',		'middleware' => ['role:member-lapangan']]);

Route::post('/memberlapangan/prive',				['as'=>'ml.prive',				'uses'=> 'TransaksiController@prive',			'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/biaya',				['as'=>'ml.biaya',				'uses'=> 'TransaksiController@biayaIndex',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/create/biaya',			['as'=>'ml.biaya.create',		'uses'=> 'TransaksiController@biayaCreate',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/create/biaya',			['as'=>'ml.biaya.store',		'uses'=> 'TransaksiController@biayaStore',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/biaya/{id}',			['as'=>'ml.biaya.read',			'uses'=> 'TransaksiController@biayaRead',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/biaya/delete/{id}',	['as'=>'ml.biaya.delete',		'uses'=> 'TransaksiController@biayaDestroy',	'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/biaya/update/{id}',	['as'=>'ml.biaya.update',		'uses'=> 'TransaksiController@biayaUpdate',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/biaya/update/{id}',	['as'=>'ml.biaya.save',			'uses'=> 'TransaksiController@biayaSave',		'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/laporan',				['as'=>'ml.laporan',			'uses'=> 'TransaksiController@laporanIndex',	'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/laporan/keuangan',			['as'=>'ml.laporan.keuangan',		'uses'=> 'TransaksiController@laporanKeuangan',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/laporan/detail',			['as'=>'ml.laporan.detail',			'uses'=> 'TransaksiController@laporanDetail',		'middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/laporan/keuangan/cetak',	['as'=>'ml.laporan.cetak_keuangan',	'uses'=> 'TransaksiController@laporanCetakKeuangan','middleware' => ['role:member-lapangan']]);
Route::get ('/memberlapangan/laporan/detail/cetak',		['as'=>'ml.laporan.cetak_detail',	'uses'=> 'TransaksiController@laporanCetakDetail',	'middleware' => ['role:member-lapangan']]);

Route::post('/memberlapangan/laporan/keuangan',			['as'=>'ml.laporan.getkeuangan',	'uses'=> 'TransaksiController@laporanKeuanganS',		'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/laporan/detail',			['as'=>'ml.laporan.getdetail',		'uses'=> 'TransaksiController@laporanDetailS',			'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/laporan/keuangan1/cetak',	['as'=>'ml.laporan.cetak_keuangan1','uses'=> 'TransaksiController@laporanCetakKeuanganS',	'middleware' => ['role:member-lapangan']]);
Route::post('/memberlapangan/laporan/detail1/cetak',	['as'=>'ml.laporan.cetak_detail1',	'uses'=> 'TransaksiController@laporanCetakDetailS',		'middleware' => ['role:member-lapangan']]);

Route::get ('/memberlapangan/laporan/save',				['as'=>'ml.laporan.save',			'uses'=> 'TransaksiController@laporanSave',	'middleware' => ['role:member-lapangan']]);
});
