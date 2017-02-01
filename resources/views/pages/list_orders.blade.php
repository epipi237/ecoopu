@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	{{ session('status') }}
</div>
@endif

<div id="hot">

	<div class="box text-center" style="margin-left: 9%! important; margin-right: 9%! important;">
		<div class="container">
			<div class="col-md-12">
				<h2>Current Orderlists for <b>{{$shop->name}}</b></h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">

			@if(count($orders) > 0)

			@foreach($orders as $order)
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="box same-height clickable">
					<h3><a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} items (<a 
						@if(Auth::check())
						@if($order->user->id==Auth::user()->id)
						href="/pages/create/orderlist/{{$order->id}}">
						Add items
						@else
						href="/pages/create/orderlist/{{$order->id}}">
						Join List 
						@endif         
						@else
						href="/login">
						Join List 
						@endif


					</a>)</a></h3>
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
					</p>
				</div>
			</div>
			@endforeach

			@elseif(count($orders) == 0)
			<div class="col-sm-12 text-center">
				<div class="box same-height clickable">
					<h1>No orders made here</h1>
				</div>
			</div>
			@endif

			<!-- /.row -->

		</div>

	</div>

	<div class="container center" >
		<span align="center">{{$orders->links()}}</span>

	</div>
</div>

@endsection
