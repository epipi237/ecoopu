@extends('shop.index')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8"> 

			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{route('order_price')}}">
						{{ csrf_field() }}
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

						<input type="hidden" name="order_id" value="{{$orderid}}" id="order_id">
						<input type="hidden" name="user_id" value="{{$user}}" id="user_id">

						Total Price: <input type="number" placeholder="Price $" class='' name="price" id="price" required="">
						<button type="submit" class="btn btn-primary pull-right">
							<i class="fa fa-btn fa-add"></i> Save
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
