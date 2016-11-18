@extends('shop.index')
@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Shop: <b>{{$orders->shop}}</b></div> 
		<div class="panel-body">
			<div class="row">
				<form class="form-horizontal" role="form" method="POST" action="{{route('order_price')}}">
					{{ csrf_field() }}
					<div class="col-md-10"> 
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
									<td>
										<input type="hidden" name="user_id" value="{{$orders->id}}" id="price">
										<input type="number" placeholder="Price $" class='' name="price[]" id="price" required="">
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<p>Grand Total:<p>
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
