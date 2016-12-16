@extends('shop.index')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8"> 
			<div class="panel panel-default">
				<div class="panel-heading text-center"><b>Clients for this orderlist</b></div> 
				<div class="panel-body">
					{{ csrf_field() }}
					<table class="table table-striped">
						<thead>
							<td>Clients</td>
							<td>Action</td>
						</thead>
						<tbody>
							@foreach($clients as $client)
							<tr>
								<td>{{ $client->name}}</td>
								<td>
									<a href="/shop/orderitems/user/{{$client->id}}/order/{{$order_id}}"><button type="button" class="btn btn-info">Details</button>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
