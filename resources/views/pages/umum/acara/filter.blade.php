@foreach($acara as $acaras)
    <div class="col-md-12 no-padding" style="background-color: #f7f7f7; margin-bottom: 20px">
      <div class="col-md-3 no-padding">
        <a href="{{route('acara.read',[$acaras->id])}}">
        <div class="product_img">
          <img src="{{Storage::url('upload/'.$acaras->brosur)}}" style="width: 100%;" alt="Brosur" />
        </div>
        </a>
      </div>
        <div class="col-md-9" style="">
          <h4>{{$acaras->namaacara}}</h4>
          <strong><i class="fa fa-user"></i> Di Upload Oleh</strong> : {{$acaras->nama}}<br>
          <strong><i class="fa fa-clock-o"></i> Di Upload Pada</strong> : {{$acaras->created_at}}<br>
          <strong><i class="fa fa-pencil-square"></i> Pendafataran</strong> : {{$acaras->awal_daftar}} Sampai {{$acaras->akhir_daftar}}<br>
          <strong><i class="fa fa-pencil-square-o"></i> Pelaksanaan</strong>  : {{$acaras->tanggalmulai}} Sampai {{$acaras->tanggalakhir}}<br>
        </div>
    </div>
    @endforeach   