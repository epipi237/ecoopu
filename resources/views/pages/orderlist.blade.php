@extends('layouts.app')
@section('content')

<div class="container">

	<div class="panel panel-default">
		<div class="panel-heading">Name of Shop: <b>{{$orders->shop}}</b>  
		</div> 

		<div class="panel-body">
			<div class="row">

				<?php 
				$mytime1=date_create($orders->duration);
				$mytime2=date_create(date('Y-m-d H:i:s'));
				if ($mytime2 < $mytime1) {
					echo '<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Add item(s)</button>';
				} else {

					//
				}

				?>

				<div class="col-md-8"> 

					<table class="table table-striped">
						<thead>
							<td>Product name</td>
							<!-- <td>Shop</td> -->
							<td>Quantity</td>

							<?php 
							$mytime1=date_create($orders->duration);
							$mytime2=date_create(date('Y-m-d H:i:s'));
							if ($mytime2 < $mytime1) {
								echo '<td>Action</td>';
							} 
							?>
							
						</thead>
						<tbody>
							@foreach($orderItems as $orderItem)
							<tr>
								<td>{{ $orderItem->product }}</td>
								<!-- <td>{{ $orderItem->shop }}</td> -->
								<td>{{ $orderItem->quantity }}</td>

								<?php 
								$mytime1=date_create($orders->duration);
								$mytime2=date_create(date('Y-m-d H:i:s'));
								if ($mytime2 < $mytime1) {
									echo "<td><a href=/itemremove/$orderItem->id>  <button class='btn btn-danger'>Remove</button></a></td>";
								} elseif ($mytime2 > $mytime1) {

								} 
								?>

							</tr>
							@endforeach
							<br>
							<p><?php 
								$date1=date_create($orders->duration);
								$date2=date_create(date('Y-m-d H:i:s'));
								$DateInterval=date_diff($date1,$date2);
								echo '<b>OrderList count down: </b>  ' . $DateInterval->d .' day(s)'. '  '. $DateInterval->h.' hour(s) left';
								?>
							</p>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Add items to Orderlist</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" method="POST" action="{{route('create_order')}}">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
						<label for="product" class="col-md-4 control-label">Product Name:</label>

						<div class="col-md-6">
							<input id="product" type="text" class="form-control" name="product" value="{{ old('product') }}">
							@if ($errors->has('product'))
							<span class="help-block">
								<strong>{{ $errors->first('product') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
						<label for="quantity" class="col-md-4 control-label">Quantity</label>

						<div class="col-md-6">
							<input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
							<input type="hidden" name="orderid" value="{{$orders->id}}">
							@if ($errors->has('quantity'))
							<span class="help-block">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-btn fa-add"></i> Add
							</button>
						</div>
					</div>
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

@endsection
