@extends('shop.index')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
	{{ session('status') }}
</div>
@endif

<style type="text/css">
	#total_price {
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
					<h4 class="text-center">{{$user->name}}'s Items for Order List</h4>
				</div>
				<div class="panel-body">
					@if(!($price->price > 0))

					<form class="form-horizontal" role="form" method="POST" action="{{route('order_price')}}">
						<table class="table table-striped">
							<thead>
								<td>Product name</td>
								<td>Quantity</td>
								<td>Price</td>
							</thead>
							<tbody>

								@foreach($orderItems as $orderItem)
								<tr>
									<td>{{ $orderItem->product }}</td>
									<td>{{ $orderItem->quantity }}</td>
									<td><input type="number" placeholder="$" class='form-control sub_price' name="{{$orderItem->id}}" id="{{$orderItem->id}}" required="required">	</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						{{ csrf_field() }}

						<input type="hidden" name="order_id" value="{{$order_id}}" id="order_id">
						<input type="hidden" name="user_id" value="{{$user->id}}" id="user_id">

						<div class="col-sm-6 pull-right"> 
							Total Price: <input type="number" placeholder="$" class='form-control' name="total_price" id="total_price" value="{{old('total_price')}}" required="required">
							<button type="submit" class="btn btn-primary pull-right">
								<i class="fa fa-btn fa-add"></i> Save
							</button>
						</div>
					</form>
					
					@else

					<table class="table table-striped">
						<thead>
							<td>Product name</td>
							<td>Quantity</td>
							<td>Price</td>
						</thead>
						<tbody>

							@foreach($orderItems as $orderItem)
							<tr>
								<td>{{ $orderItem->product }}</td>
								<td>{{ $orderItem->quantity }}</td>
								<td>{{ $orderItem->price }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						Total price: <span class="badge">${{$price->price}}</span>
						Processing Fee: <span class="label label-danger">${{$processingFee}} (1% of Total Cost)</span>
					</div>

					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
