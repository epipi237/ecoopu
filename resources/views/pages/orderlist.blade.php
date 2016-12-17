@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
	{{ session('status') || $status }}
</div>
@endif

<div class="container">

	<div class="panel panel-default col-md-6" style="height: 100%;">
		<div class="panel-heading"><h3>Name of Shop: <b>{{$order->shop}}</b></h3>  
		</div> 

		<div class="panel-body">
			<div class="row">

				<?php 
				$mytime1=date_create($order->duration);
				$mytime2=date_create(date('Y-m-d H:i:s'));
				if ($mytime2 < $mytime1) {
					echo '<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Add item(s)</button>';
				} else {

					//
				}

				?>

				<div class="col-md-12" style="margin-top: 0px;"> 

					<table class="table table-striped" style="margin-top: -5%;">
						<thead>
							<td>Product name</td>
							<!-- <td>Shop</td> -->
							<td>Quantity</td>

							<?php 
							$mytime1=date_create($order->duration);
							$mytime2=date_create(date('Y-m-d H:i:s'));
							if ($mytime2 < $mytime1) {
								echo '<td>Action</td>';
							} 
							?>
							
						</thead>
						<tbody>
							@foreach($orderItems as $orderItem)
							<tr>
								<td>{{ $orderItem->product }}</td>
								<!-- <td>{{ $orderItem->shop }}</td> -->
								<td>{{ $orderItem->quantity }}</td>

								<?php 
								$mytime1=date_create($order->duration);
								$mytime2=date_create(date('Y-m-d H:i:s'));
								if ($mytime2 < $mytime1) {
									echo "<td><a href=/itemremove/$orderItem->id>  <button class='btn btn-danger'>Remove</button></a></td>";
								} elseif ($mytime2 > $mytime1) {

								} 
								?>

							</tr>
							@endforeach
							<br>
							<p><?php 
								$date1=date_create($order->duration);
								$date2=date_create(date('Y-m-d H:i:s'));
								if ($mytime2 < $mytime1) {
									$DateInterval=date_diff($date2, $date1);
									echo '<b>OrderList count down: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s) left';
								}
								?>
							</p>
						</tbody>
					</table>

					<div class="pull-right">
						Total price: <span class="badge">${{$price->price}}</span>

					</div>

				</div>
			</div>
		</div>
	</div>
	
	@if ($price->price > 0) 
	<div class="panel panel-default col-md-6" style="height: 100%;">
		<div class="panel-heading text-center"><h3><b>Processing Fee Payment</b></h3>  
		</div> 

		<div class="panel-body">
			<div class="row">

				<div class="col-md-12"> 

					<div class="">
						<h4 class="text-center">
							Processing Fee: <span class="label label-danger">${{$processingFee}} (1% of Total Cost)</span>
							<br><br><br>

							<a href="/payment_paypal?order_id={{$order->id}}&user_id={{$user_id}}">
								Pay now with PayPal or Credit Card
								<br><br>
								<img src="{{URL::to('images')}}/paypal.gif">
							</a>

						</h4>		
					</div>

				</div>
			</div>
		</div>
	</div>
	@endif
</div>

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Add items to Orderlist</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" method="POST" action="{{route('create_order')}}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
						<label for="product" class="col-md-4 control-label">Product Name:</label>

						<div class="col-md-6">
							<input id="product" type="text" class="form-control" name="product" value="{{ old('product') }}">
							@if ($errors->has('product'))
							<span class="help-block">
								<strong>{{ $errors->first('product') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
						<label for="quantity" class="col-md-4 control-label">Quantity</label>

						<div class="col-md-6">
							<input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
							<input type="hidden" name="orderid" value="{{$order->id}}">
							@if ($errors->has('quantity'))
							<span class="help-block">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-btn fa-add"></i> Add
							</button>
						</div>
					</div>
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

@endsection
