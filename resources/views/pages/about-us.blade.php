@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	{{ session('status') }}
</div>
@endif

<div id="hot">

	<div class="box text-center" style="margin-left: 9%! important; margin-right: 9%! important;">
		<div class="container">
			<div class="col-md-12">
				<h2>About Us</b></h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">
			
		</div>
	</div>

	<div class="container center" >
		<span align="center"></span>

	</div>
</div>

@endsection
