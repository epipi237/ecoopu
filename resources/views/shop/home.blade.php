@extends('shop.index')

@section('content')

@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
@endif

<div id="hot">

	<div class="box">
		<div class="container">
			<div class="col-md-12">
				<h2>Current Orderlists for your shop</h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8"> 
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Orderlist/shop</th>
									<th>No. of Items</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td>{{$order->shop}}</td>
									<td>{{count($order->orderItems)}}</td>
									<td>
										<a href="/shop/clients/{{$order->id}}"><button type="button" class="btn btn-info"> View More</button>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-4"> 
				<div class="panel panel-default">
					<div class="panel-body">

						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center">Your Shops</th>
								</tr>
							</thead>
							<tbody>

								@foreach($shops as $shop)
								<tr>
									<td>{{$shop->name}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="container center" >
		<span align="center">{{$orders->links()}}</span>

	</div>
</div>

@endsection