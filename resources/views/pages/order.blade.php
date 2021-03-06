@extends('layouts.app')

@section('title', 'Create Order Lists eCoopu')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	{{ session('status') }}
</div>
@endif

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create new Orderlist</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{route('order')}}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('shop') ? ' has-error' : '' }}">
							<label for="shop" class="col-md-4 control-label">Shop Name</label>
							<div class="col-md-6">
								<input id="shop" type="text" class="form-control" name="shop" value="{{ old('shop') }}" required='required'>
								@if ($errors->has('shop'))
								<span class="help-block">
									<strong>{{ $errors->first('shop') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="duration" class="col-md-4 control-label">Market Place</label>
							<div class="col-md-6">

								<select class="form-control" name='market' required='required'>
									@foreach($countries as $c)
									<option value="{{$c->id}}">{{$c->name}}</option>
									@endforeach
								</select>

								@if ($errors->has('duration'))
								<span class="help-block">
									<strong>{{ $errors->first('duration') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
							<label for="duration" class="col-md-4 control-label">Orderlist Duration(in days)</label>
							<div class="col-md-6">
								<input id="duration" type="number" class="form-control" name="duration" value="{{ old('duration') }}" required='required'>
								@if ($errors->has('duration'))
								<span class="help-block">
									<strong>{{ $errors->first('duration') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-add"></i> Create Order
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="hot">

	<div class="box">
		<div class="container">
			<div class="col-md-12">
				<h2>Current Orderlists you have created</h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">
			@foreach($orders as $order)
			<div class="col-sm-3">
				<div class="box same-height">
					<h3>
						<?php
						$date1=date_create($order->duration);
						$date2=date_create(date('Y-m-d H:i:s'));
						?>
						<a href="/pages/create/orderlist/{{$order->id}}">{{count($order->orderItems)}} items </a>
						@if($date2 < $date1) (<a href="/pages/create/orderlist/{{$order->id}}">add items</a>) @endif
					</h3>
					<p>Shop: {{$order->shop}}
					</p>
					<p>
						<?php 
						
						if($date2 < $date1) {
							$DateInterval=date_diff($date1, $date2);
							echo '<b>Time Left:</b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s)';
						}else{
							echo '<b>Time Left:</b> Processing Phase   ';
						}
						?>
					</p>

					<p>
						@include('share.share', [
						'url' => request()->fullUrl(),
						'description' => 'Join my orderlist to shop with me from {{$order->shop}}',
						])
					</p>

				</div>
			</div>
			@endforeach
			<!-- /.row -->
		</div>

	</div>

	<div class="container center" >
		<span align="center">{{$orders->links()}}</span>

	</div>
</div>

@endsection
