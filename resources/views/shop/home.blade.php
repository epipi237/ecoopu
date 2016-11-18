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
		<div class="same-height-row">
			@foreach($orders as $order)
			<div class="col-sm-3">
				<div class="box same-height">
					<p>Client: {{$order->user->name}}
						<p>No. of Items: {{count($order->orderItems)}}
						</p>

						<p>
							<a href="/shop/add/price/{{$order->id}}"><button type="button" class="btn btn-info"> View More</button></a>
						</p>

						<p class="social text-center">
							<a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
							<a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>                            
						</p>
					</div>
				</div>
				@endforeach
				<!-- /.row -->
			</div>

		</div>

		<div class="container center" >
			<span align="center">{{$orders->links()}}</span>

		</div>
	</div>

	@endsection