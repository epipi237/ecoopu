@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
	{{ session('status')  }}
</div>
@elseif($status)
<div class="container alert alert-{{$classAlert}} text-center">
	{{ $status }}
</div>
@endif

<div class="container" style="height: 150%;margin-bottom: 30px;">

	<div class="panel panel-default col-md-6" style="height: 100%;">
		<div class="panel-heading">
			<span style="font-size: 18px;">Name of Shop: <b>{{$order->shop}}</b></span>  
			<br> 
			<span style="font-size: 14px;">Market Place: {{$order->country->name}}</span> 
		</div> 

		<div class="panel-body">
			<div class="row">

				<?php 
				$mytime1=date_create($order->duration);
				$mytime2=date_create(date('Y-m-d H:i:s'));
				if ($mytime2 < $mytime1 && !($price->price > 0)) {
					echo '<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Add item(s)</button>';
				} else {

					//
				}

				?>

				<div class="col-md-12" style="margin-top: 0px;"> 
					<h4>
						<table class="table table-striped" style="margin-top: -5%; font-size: 16px;">
							<thead>
								<td>Product name</td>
								<!-- <td>Shop</td> -->
								<td>Quantity</td>

								<td>Price</td>

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

									@if($orderItem->price == '')
									<td>{{ 'Not yet set by the seller' }}</td>
									@else
									<td>{{$user_currency_symbol}} {{$orderItem->new_price}} ({{$order->country->currency_symbol}} {{ $orderItem->price }})</td>
									@endif

									<?php 
									$mytime1=date_create($order->duration);
									$mytime2=date_create(date('Y-m-d H:i:s'));
									if ($mytime2 < $mytime1 && !($price->price > 0)) {
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
										echo '<b>OrderList count down: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s) left <br><br>';
									}
									?>
								</p>
							</tbody>
						</table>

						<div class="pull-right">
							Total price: 
							@if($price->price > 0)
							<span class="badge">{{$user_currency_symbol}} {{$price->new_price}} ({{$order->country->currency_symbol}} {{$price->price}})</span>
							@else
							<span class="badge">Not yet set by the seller</span>
							@endif

						</div>
					</h4>
				</div>
			</div>
		</div>
	</div>
	
	@if ($price->price > 0 && $price->paidStatus == 0) 
	<div class="panel panel-default col-md-6" style="height: 100%;">
		<div class="panel-heading text-center">
			<span style="font-size: 18px;"><b>Processing Fee Payment</b></span>  
		</div> 

		<div class="panel-body">
			<div class="row">

				<div class="col-md-12"> 

					<div class="">
						<h4 class="text-center" style="font-size: 16px;">
							Processing Fee: <span class="label label-danger">{{$user_currency_symbol}} {{$price->new_price/10}} ({{$order->country->currency_symbol}} {{$processingFee}}) (1% of Total Cost)</span>
							<br><br><br>

							Pay now with PayPal or Credit Card
							<br><br>

							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_xclick">

								<input type="hidden" name="business" value="info@ecoopu.com">

								<input type="hidden" name="bn" value="Platform_Charges_Ecoopu_Com">

								<input type="hidden" name="currency_code" value="{{$order->country->currency_code}}">
								<!-- 
								This is the correct way to calculate the platform fee but it's commented out for testing purposes
								<input type="hidden" name="amount" value="{{$processingFee}}"> -->
								<input type="hidden" name="amount" value="{{0.1}}">

								<input type="hidden" name="item_name" value="Platform Charges (1% of total cost of your order)">

								<input type="hidden" name="quantity" value="1">

								<input type="hidden" name="return" value="{{$paypalUrl.'/success'}}">

								<input type="hidden" name="cancel_return" value="{{$paypalUrl.'/failed'}}">

								<input type="hidden" name="charset" value="utf-8">

								<input type="hidden" name="hosted_button_id" value="ACW6S87267QSG">

								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>

						</h4>		
					</div>

				</div>
			</div>
		</div>
	</div>
	@elseif($price->price > 0 && $price->paidStatus == 1)
	<div class="panel panel-default col-md-6" style="height: 100%;">
		<div class="panel-heading text-center">
			<span style="font-size: 18px;"><b>Processing Fee Payment</b></span>  
		</div> 

		<div class="panel-body">
			<div class="row">

				<div class="col-md-12"> 

					<div class="">
						<h4 class="text-center" style="font-size: 16px;">
							Processing Fee: <span class="label label-success">Paid {{$user_currency_symbol}} {{$price->new_price/10}}  ({{$order->country->currency_symbol}} {{$processingFee}}) (1% of Total Cost)</span>

							<br><br>
							<form class="form-horizontal" role="form" action="{{route('update_shipping_address')}}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$orderlist_address->id}}" />
								<input type="hidden" name="order_id" value="{{$order->id}}" />
								Shipping Address: 
								@if($orderlist_address->description == 'Not yet specified by the client')
								<input type="text" class="form-control" name="shipping_address" value="" style="display: inline-block; width: 70%;" />
								@else
								<input type="text" class="form-control" name="shipping_address" value="{{$orderlist_address->description}}" style="display: inline-block; width: 70%;" />
								@endif
								<br><br>
								<button class="btn-md btn-success pull-right">Save</button>
							</form>
							<br>
						</h4>		
						<h5>
							Thanks for paying the platform charges, your seller will contact you with more information on how to pay for the goods and other arrangements for shipping to the address shown in the field above.
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

@if(!($price->price > 0))
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
							<input id="product" type="text" class="form-control" name="product" value="{{ old('product') }}" required="required">
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
							<input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required="required">
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
@endif

@endsection
