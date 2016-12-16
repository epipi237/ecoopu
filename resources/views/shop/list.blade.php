@extends('shop.index')

@section('content')

@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
@endif

<div class="container">
	<div class="row">
		<div class="col-md-8"> 

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-center">{{$user->name}}'s Items for Order List</h4>
				</div>
				<div class="panel-body">

					<table class="table table-striped">
						<thead>
							<td>Product name</td>
							<td>Quantity</td>
						</thead>
						<tbody>

							@foreach($orderItems as $orderItem)
							<tr>
								<td>{{ $orderItem->product }}</td>
								<td>{{ $orderItem->quantity }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@if(!$price)
					<form class="form-horizontal" role="form" method="POST" action="{{route('order_price')}}">

						{{ csrf_field() }}

						<input type="hidden" name="order_id" value="{{$order_id}}" id="order_id">
						<input type="hidden" name="user_id" value="{{$user->id}}" id="user_id">

						Total Price: <input type="number" placeholder="Price $" class='' name="price" id="price" required="">
						<button type="submit" class="btn btn-primary pull-right">
							<i class="fa fa-btn fa-add"></i> Save
						</button>
					</form>
					@else

					<div class="pull-right">
						Total price: <span class="badge">${{$price->price}}</span>
					</div>

					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
