@extends('layouts.app')
@section('content')

<div class="container">
	<div class="same-height-row">
		<div class="same-height-row">

			@foreach($orders as $order)
			<div class="col-sm-3">
				<div class="box same-height clickable">
					<h3><a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} item(s) (<a href="/pages/create/orderlist/{{$order->id}}">add items</a>)</a></h3>
					<p>Shop: {{$order->shop}}</p>
					<p>Country: <b>{{$order->country->name}}</b></p>
					<p>
						<?php 
						$date1=date_create($order->duration);
						$date2=date_create(date('Y-m-d H:i:s'));
						$DateInterval=date_diff($date1,$date2);
						echo '<b>Time Left: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s)';
						?>
					</p>
					<p class="social text-center">
						<a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
						<a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a> 
						<a href="/removeorder/{{$order->id}}" class="btn btn-danger btn-sm pull-right">Delete</a>                         
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