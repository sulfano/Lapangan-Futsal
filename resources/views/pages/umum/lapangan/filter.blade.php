@foreach($lapanganbaru as $new)
<div class="col-lg-12 no-padding" style="background-color: #f7f7f7; margin-bottom: 20px">
  <div class="col-lg-3 no-padding">
    <a href="{{route('lapangan.read',[$new->kodelapangan])}}">
    <div class="product_img">
      <img src="{{Storage::url('upload/'.$new->foto1)}}"  style="width: 100%">
    </div>
    </a>
  </div>
  <div class="col-lg-9" style="">
    <h4>{{$new->nama}}<span class="label label-warning pull-right">{{$new->created_at}}</span></h4>
    <strong><i class="fa fa-user"></i> Di Upload Oleh</strong> : {{$new->uploader}}<br>
                        <strong><i class="fa fa-clock-o"></i> Di Upload Pada</strong> : {{$new->created_at}}<br>
  </div>
</div>
@endforeach  

