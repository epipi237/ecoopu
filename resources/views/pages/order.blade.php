@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create new Orderlist</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{route('order')}}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('shop') ? ' has-error' : '' }}">
							<label for="shop" class="col-md-4 control-label">Shop Name</label>
							<div class="col-md-6">
								<input id="shop" type="text" class="form-control" name="shop" value="{{ old('shop') }}">
								@if ($errors->has('shop'))
								<span class="help-block">
									<strong>{{ $errors->first('shop') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
							<label for="location" class="col-md-4 control-label">Location</label>
							<div class="col-md-6">
								<input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">
								@if ($errors->has('location'))
								<span class="help-block">
									<strong>{{ $errors->first('location') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
							<label for="duration" class="col-md-4 control-label">Orderlist Duration</label>
							<div class="col-md-6">
								<input id="duration" type="duration" class="form-control" name="duration" value="{{ old('duration') }}">
								@if ($errors->has('duration'))
								<span class="help-block">
									<strong>{{ $errors->first('duration') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-add"></i> Create Order
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
