@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
	{{ session('status') }}
</div>
@endif

<div class="container">
	<div class="same-height-row">
		<div class="same-height-row">

			@foreach($orders as $order)
			<div class="col-sm-3">
				<div class="box same-height clickable">
					<h3><a href="/pages/create/orderlist/{{$order->id}}">Order List {{$order->id}}</a></h3>
					<p>Shop: {{$order->shop}}</p>
					<p>Country: <b>{{$order->country->name}}</b></p>
					<p>
						<?php 
						$date1=date_create($order->duration);
						$date2=date_create(date('Y-m-d H:i:s'));
						$DateInterval=date_diff($date2, $date1);
						echo '<b>Expired: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s) ago';
						?>
					</p>
					<p class="social text-center">
						<!-- <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
						<a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>  -->
						<a href="/removeorder/{{$order->id}}" class="btn btn-danger btn-sm pull-right">Delete</a>
						<span class="clearfix">...</span>                     
					</p>

				</div>
			</div>
			@endforeach
			<!-- /.row -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.row -->

</div>

@endsection