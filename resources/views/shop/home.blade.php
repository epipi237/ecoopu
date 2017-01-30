@extends('shop.index')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
	{{ session('status') }}
</div>
@endif

<div id="hot">

	<div class="box text-center" style="margin-left: 7.8%! important; margin-right: 7.8%! important;">
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
									<th>Orderlists No</th>
									<th>Shop</th>
									<th>No. of Items</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td>{{$order->id}}</td>
									<td>{{ucfirst($order->shop)}}</td>
									<td>{{count($order->orderItems)}}</td>
									<td>
										<a href="/shop/clients/{{$order->id}}"><button type="button" class="btn btn-info"> More</button>
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
									<td>{{ucfirst($shop->name)}}</td>
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