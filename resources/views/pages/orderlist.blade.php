@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<a href="#"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Product</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<table class="table table-striped">
				<thead>
					<td>Name</td>
					<td>Shop</td>
					<td>Quantity</td>
					<td>Action</td>
				</thead>
				<tbody>
					<tr>
						<td>Shoes</td>
						<td>Supermarket 1</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Bags</td>
						<td>Supermarket 2</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Clothes</td>
						<td>Supermarket 3</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Books</td>
						<td>Supermarket 4</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Jeweries</td>
						<td>Supermarket 5</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<br>
					<p>Orderlist Duraton: 2 days : 5hrs : 2s remaining  <button class="btn btn-info">Edit time</button> <button class="btn btn-danger">Close</button></p>
				</tbody>
			</table>
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


				<form class="form-horizontal" role="form" method="POST" action="#">
					{{ csrf_field() }}

					<div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
						<label for="product" class="col-md-4 control-label">Product Name:</label>

						<div class="col-md-6">
							<input id="product" type="text" class="form-control" name="name" value="{{ old('product') }}">

							@if ($errors->has('product'))
							<span class="help-block">
								<strong>{{ $errors->first('product') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('shop') ? ' has-error' : '' }}">
						<label for="name" class="col-md-4 control-label">Shop Name:</label>

						<div class="col-md-6">
							<input id="shop" type="text" class="form-control" name="shop" value="{{ old('shop') }}">

							@if ($errors->has('shop'))
							<span class="help-block">
								<strong>{{ $errors->first('shop') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
						<label for="quantity" class="col-md-4 control-label">Quantity</label>

						<div class="col-md-6">
							<input id="quantity" type="number" class="form-control" name="email" value="{{ old('quantity') }}">

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
