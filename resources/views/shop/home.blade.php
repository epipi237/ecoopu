@extends('shop.index')

@section('content')

<div id="hot">

	<div class="box">
		<div class="container">
			<div class="col-md-12">
				<h2>Current Orderlists for your shop</h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">
			@foreach($orders as $order)
			<div class="col-sm-3">
				<div class="box same-height">
					<p>Shop: {{$order->shop}}
						<p>Client: {{$order->user->name}}
						</p>
						<p>
							<?php 
							$date1=date_create($order->duration);
							$date2=date_create(date('Y-m-d H:i:s'));
							$DateInterval=date_diff($date1,$date2);
							echo '<b>Time Left</b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s)';
							?>
						</p>
						<form class="form-horizontal" role="form" method="POST" action="{{ url('price') }}">
							{{ csrf_field() }}

							<input type="hidden" name="order_id" value="{{$order->id}}">

							<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
								<label for="price" class="col-md-4 control-label">Price</label>
								<div class="col-md-6">
									<input id="price" type="text" placeholder="$" class="form-control" name="price" value="{{ old('price') }}">
									@if ($errors->has('price'))
									<span class="help-block">
										<strong>{{ $errors->first('price') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<button type="submit" class="btn btn-primary">
								<i class=""></i> Save
							</button>
						</form>

						<p class="social text-center">
							<a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
							<a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>                            
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