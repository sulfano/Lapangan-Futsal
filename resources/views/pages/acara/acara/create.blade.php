@extends('layout.acara')
@section('content')
<div class="content-wrapper">
  <div class="container">
    <section class="content-header">
      <h1>
        Acara
      </h1>
      <ol class="breadcrumb">
        <li>Beranda</li>
        <li class="active">Acara</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Acara</h3>
            </div>
            <div class="box-body">
              <form class="form form-horizontal" method="POST" action="{{route('ma.acara.store')}}" enctype="multipart/form-data">
              <!-- {{ csrf_field() }} -->
                <div class="form-group" hidden="true">
                   <label class="control-label col-md-3">User</label>
                   <div class="col-md-9">
                      <input type="text" name="idpeople" class="form-control" value="{{Auth::user()->id}}"></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Nama Acara</label>
                   <div class="col-md-9">
                      <input type="text" name="namaacara" class="form-control" required=""></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Pelaksana</label>
                   <div class="col-md-9">
                      <input type="text" name="pelaksana" class="form-control" required=""></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Tanggal Mulai</label>
                   <div class="col-md-9">
                      <input type="date" name="tanggalmulai" class="form-control" required=""></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Tanggal Akhir</label>
                   <div class="col-md-9">
                      <input type="date" name="tanggalakhir" class="form-control" required=""></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Jam Mulai</label>
                   <div class="col-md-9">
                      <input type="time" name="jammulai" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Jam Akhir</label>
                   <div class="col-md-9">
                      <input type="time" name="jamakhir" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Nama Kontak 1</label>
                   <div class="col-md-9">
                      <input type="text" name="namakontak1" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Kontak 1</label>
                   <div class="col-md-9">
                      <input type="text" name="kontak1" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Nama Kontak 2</label>
                   <div class="col-md-9">
                      <input type="text" name="namakontak2" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Kontak 2</label>
                   <div class="col-md-9">
                      <input type="text" name="kontak2" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Biaya</label>
                   <div class="col-md-9">
                      <input type="text" name="biaya" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Satuan</label>
                   <div class="col-md-9">
                      <select name="satuan" class="form-control">
                        <option value="Tim">Tim</option>
                        <option value="Individu">Individu</option>
                      </select>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Total Hadiah</label>
                   <div class="col-md-9">
                      <input type="text" name="totalhadiah" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Hadiah Utama</label>
                   <div class="col-md-9">
                      <input type="text" name="hadiahutama" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Awal Pendaftaran</label>
                   <div class="col-md-9">
                      <input type="date" name="awaldaftar" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Akhir Pendaftaran</label>
                   <div class="col-md-9">
                      <input type="date" name="akhirdaftar" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Kuota</label>
                   <div class="col-md-9">
                      <input type="text" name="kuota" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Tempat</label>
                   <div class="col-md-9">
                      <input type="text" name="tempat" class="form-control" ></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Alamat</label>
                   <div class="col-md-9">
                      <textarea name="alamat" rows="2" class="form-control"></textarea>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Brosur</label>
                   <div class="col-md-9">
                      <input type="file" name="brosur" class="form-control"></input>
                   </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3">Detail</label>
                   <div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail
                <small>Jelaskan lebih mengenai acara</small>
              </h3>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body pad">
                <textarea class="textarea" placeholder="Place some text here" name="detail" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div> 
                   </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">  
                  <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
                  <button type="submit" class="btn bg-navy btn-flat" name="submit"><i class="fa fa-save"></i></button>
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
