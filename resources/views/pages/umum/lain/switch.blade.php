<?php 
$a='';
if(!Auth::user())
  echo '<meta http-equiv="refresh" content="0; url=/">';
else
  $a = Auth::user()->level ;

if ($a==2)
  echo '<meta http-equiv="refresh" content="0; url=/administrator">';
else if ($a==5 )
  echo '<meta http-equiv="refresh" content="0; url=/memberlapangan/check">';
else if ($a==6)
  echo '<meta http-equiv="refresh" content="0; url=/memberacara">';

?>
@extends('layout.redirect')
@section('content')
    <!-- Main content -->
    <section class="content">

          <div class="row">
          <div class="col-md-12 text-center">
          <button type="button" class="btn btn-default btn-lrg ajax btn-app btn-lg" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>
          </button>
          </div>
          </div>
            <div class="ajax-content">
            </div>
      <!-- /.box -->

    </section> 
@endsection