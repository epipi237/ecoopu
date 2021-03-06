@extends('shop.index')

@section('title', 'Order eCoopu')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	{{ session('status') }}
</div>
@endif

<style type="text/css">
	.blur {
		border-style: inset;    
		cursor: not-allowed;
		background-color: #eee;
		opacity: 1;
	}
	.form-control{
		width: 50%;
		display: inline-block;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-md-8"> 

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-center">{{ucfirst($user->name)}}'s Items for Order List</h4>
				</div>
				<div class="panel-body">
					@if(!$price->paidStatus)

					<form class="form-horizontal" role="form" method="POST" action="{{route('order_price')}}">
						<table class="table table-striped">
							<thead>
								<td>Product name</td>
								<td>Details</td>
								<td>Quantity</td>
								<td>Price</td>
							</thead>
							<tbody>

								@foreach($orderItems as $orderItem)
								<tr>
									<td>{{ ucfirst($orderItem->product) }}</td>
									<td>
										<a href="#" title="Full details" data-toggle="popover" data-trigger="hover" data-content="{{$orderItem->description}}" data-placement="top">{{ str_limit($orderItem->description, 50) }}</a>
									</td>
									<td>{{ $orderItem->quantity }}</td>
									<td><input type="number" placeholder="{{$order->country->currency_symbol}}" class='form-control sub_price' name="{{$orderItem->id}}" id="{{$orderItem->id}}" value="{{$orderItem->price}}" required="required">	</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						{{ csrf_field() }}

						<input type="hidden" name="order_id" value="{{$order_id}}" id="order_id">
						<input type="hidden" name="user_id" value="{{$user->id}}" id="user_id">

						<div class="col-sm-6 pull-right"> 
							Total Price: <input type="number" placeholder="{{$order->country->currency_symbol}}" class='form-control blur' name="total_price" id="total_price" value="{{$price->price}}" required="required">
							<button type="submit" class="btn btn-primary pull-right">
								<i class="fa fa-btn fa-add"></i> Save
							</button>
						</div>
					</form>

					@else

					<table class="table table-striped">
						<thead>
							<td>Product name</td>
							<td>Details</td>
							<td>Quantity</td>
							<td>Price</td>
						</thead>
						<tbody>

							@foreach($orderItems as $orderItem)
							<tr>
								<td>{{ ucfirst($orderItem->product) }}</td>
								<td>
									<a href="#" title="Full details" data-toggle="popover" data-trigger="hover" data-content="{{$orderItem->description}}" data-placement="top">{{ str_limit($orderItem->description, 50) }}</a>
								</td>
								<td>{{ $orderItem->quantity }}</td>
								<td>{{$order->country->currency_symbol}} {{ $orderItem->price }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						Total price: <span class="badge">{{$order->country->currency_symbol}} {{$price->price}}</span>
						Processing Fee: <span class="label label-danger">{{$order->country->currency_symbol}} {{$processingFee}} (1% of Total Cost)</span>
					</div>

					@endif
				</div>
			</div>
		</div>

		@if($price->paidStatus)
		<div class="col-md-4"> 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-center">{{ucfirst($user->name)}}'s Contact Information</h4>
				</div>
				<div class="panel-body">
					<div class="">
						Client's Phone: <input type="text" class="form-control blur" value="{{$user->phone}}" style="display: inline-block; width: 70%;" /> <br><br>
						Client's Email: <input type="text" class="form-control blur" value="{{$user->email}}" style="display: inline-block; width: 70%;" /> <br><br>
						Shipping Address: 
						@if($orderlist_address != null)
						<input type="text" class="form-control blur" value="{{$orderlist_address->description}}" style="width: 60%;" />
						@else
						<input type="text" class="form-control blur" value="" style="width: 60%;" />
						@endif
						<br>
					</div>

				</div>
			</div>
		</div>
		@endif
	</div>
</div>

@endsection
