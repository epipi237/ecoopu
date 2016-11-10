@extends('shop.index')
@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Client: <b>{{$orders->user->name}}</b></div> 
		<div class="panel-body">
			<div class="row">
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
								<td><input type="number" placeholder="Price $" class='' name="Price" id="name" required=""></td>
								?>
							</tr>
							@endforeach
						</tbody>
					</table>
					<button type="submit" class="btn btn-primary pull-right">
					<i class="fa fa-btn fa-add"></i> Save
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
