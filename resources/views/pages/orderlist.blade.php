@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<a href="#"><button class="btn btn-success">New Product</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<table class="table table-striped">
				<thead>
					<td>Name</td>
					<td>Price</td>
					<td>Remaing time:</td>
					<td>Quantity</td>
					<td>Action</td>
				</thead>
				<tbody>
					<tr>
						<td>Shoes</td>
						<td>24$</td>
						<td>2 days : 5Hrs</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Bags</td>
						<td>24$</td>
						<td>2 days : 5Hrs</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Clothes</td>
						<td>24$</td>
						<td>2 days : 5Hrs</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Books</td>
						<td>24$</td>
						<td>2 days : 5Hrs</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
					<tr>
						<td>Jeweries</td>
						<td>24$</td>
						<td>2 days : 5Hrs</td>
						<td>2</td>
						<td><a href="#"><button class="btn btn-danger">Remove</button></a> </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection
