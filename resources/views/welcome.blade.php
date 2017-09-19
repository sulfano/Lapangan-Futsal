@extends('layout.landing')
@section('content')
<div class="preloader">
		<img src="/assets/landing/img/loader.gif" alt="Preloader image">
	</div>

	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3 class="light white">Let's Play Futsal.</h3>
							<h1 class="white typed">Find nice events and fields here.</h1>
							<span class="typed-cursor">|</span>
							<br><a href="/home" class="btn btn-blue">Start</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
				<div class="col-md-4">
					<div class="intro-table intro-table-hover1">
						<h5 class="white heading hide-hover">Lapangan</h5>
						<div class="bottom">
							<h4 class="white heading small-heading no-margin regular">Temukan tempat bermain futsal terbaik disini.
							</h4>
							<!-- <h4 class="white heading small-pt">20% Discount</h4> -->
							<a href="/lapangan" class="btn btn-white-fill expand">Open</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-table intro-table-hover3">
						<h5 class="white heading hide-hover">Event</h5>
						<div class="bottom">
							<h4 class="white heading small-heading no-margin regular">Temukan dan bergabunglah dalam event event futsal menarik disini.</h4>
							<!-- <h4 class="white heading small-pt">20% Discount</h4> -->
							<a href="/acara" class="btn btn-white-fill expand">Open</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-table intro-table-hover2">
						<h5 class="white heading hide-hover">Peta</h5>
						<div class="bottom">
							<h4 class="white heading small-heading no-margin regular">Temukan lapangan futsal favorit anda di dalam peta</h4>
							<!-- <h4 class="white heading small-pt">20% Discount</h4> -->
							<a href="/peta" class="btn btn-white-fill expand">Open</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection