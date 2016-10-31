@extends('layouts.app')

@section('content')

<div id="hot">

	<div class="box">
		<div class="container">
			<div class="col-md-12">
				<h2>Current Orderlists in <b>{{$country->name}}</b></h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">
			@foreach($orders as $order)

			@if(count($order) > 0)
			<div class="col-sm-3">
				<div class="box same-height clickable">
					<h3><a href="#">{{count($order->orderItems)}} items (<a href="/pages/create/orderlist/{{$order->id}}">add items</a>)</a></h3>
					<p>{{$order->shop}}
					</p>
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
					</p>
				</div>
			</div>
			@elseif(count($order) === 0)
			<div class="col-sm-3">
				<div class="box same-height clickable">
					<h1>Nothing here ooooohhhhhhh</h1>
				</div>
			</div>
			@endif
			@endforeach

			<!-- /.row -->

		</div>

	</div>

	<div class="container center" >
		<span align="center">{{$orders->links()}}</span>

	</div>
</div>

@endsection
