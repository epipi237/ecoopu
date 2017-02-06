@extends('layouts.app')

@section('title', 'Contact Us eCoopu')

@section('active-contact-us', 'active')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	{{ session('status') }}
</div>
@endif

<style type="text/css">
	@import 'https://fonts.googleapis.com/css?family=Lato';

	body {
		font-family: Lato;
		font-size: 15px;
	}

	* {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	h1 {
		font-size: 1.5em;
		font-weight: 400;
		text-align: center;
	}

	#chartdiv {
		max-width: 1100px;
		height: 400px;
		border: 1px solid #ddd;
		margin: 0 auto;
	}

	#info {
		max-width: 1100px;
		border: 1px solid #ddd;
		margin: 10px auto;
		padding: 5px 8px;
	}

	.mail-grid i {
		font-size: 1.5em;
		border-radius: 60px;
		border: 2px solid #d9534f;
		padding: 1em;
		color: #fff;
		background: #d9534f;
		transition: .5s all;
		-webkit-transition: .5s all;
		-moz-transition: .5s all;
		-o-transition: .5s all;
		-ms-transition: .5s all;
	}

	@media (max-width: 480px)
	.map-w3 iframe {
		height: 210px;
	}

	@media (max-width: 991px) {
		.map-w3 iframe {
			height: 300px;
		}
	}

	.map-w3 iframe {
		width: 100%;
		height: 350px;
		border: 7px double #d9534f;
	}

	.mail-grid p {
		font-size: 1em;
		color: #777;
		margin-top: .5em;
	}

	@media (max-width: 480px) {
		.alert, p {
			font-size: 14px;
		}
	}

	p {
		padding: 0 0;
		margin: 0 0;
	}

	p {
		margin: 0 0 10px;
	}

	@media (max-width: 667px) {
		.mail-grid h5 {
			font-size: 1.5em;
		}
	}

	.mail-grid h5 {
		font-size: 1.8em;
		color: #1565c0;
		margin-top: .5em;
	}

	@media (max-width: 480px){
		.mail-grid {
			float: left;
			width: 100%;
		}
	}

	@media (max-width: 991px) {
		.mail-grid {
			float: left;
			width: 33.3%;
		}
	}

	.mail-top {
		text-align: center;
	}

	@media (max-width: 480px){
		.mail-grids {
			margin-top: 2em;
		}
	}

	@media (max-width: 480px){
		.caption, .arrivals-grids, .latest-grids, .product-w3agile, .product-agileinfo-grids, .mail-grids, .product-grids {
			margin-top: 2em;
		}
	}

	@media (max-width: 736px){
		.caption, .arrivals-grids, .latest-grids, .product-w3agile, .product-agileinfo-grids, .mail-grids, .product-grids {
			margin-top: 3em;
		}
	}

	.mail-grids {
		margin-top: 4em;
	}

	h2.tittle {
		text-align: center;
		font-size: 3em;
		color: #1565C0;
	}

</style>

<div id="hot">

	<div class="box text-center" style="margin-left: 9%! important; margin-right: 9%! important;">
		<div class="container">
			<div class="col-md-12">
				<h2>Contact Us</b></h2>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="same-height-row">
			<h2 class="tittle">Tell us how to serve you better</h2>
			<div class="mail-grids">
				<div class="mail-top">
					<div class="col-md-4 mail-grid">
						<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
						<h5>Address</h5>
						<p>Amaliegade </p> 
						<p> 16 E 3 8700 </p> 
						<p> Horsens Denmark </p>
					</div>
					<div class="col-md-4 mail-grid">
						<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
						<h5>Phone</h5>
						<p>Telephone: +45 23 92 91 59</p>
						<p> Monday to Saturday </p>
						<p> 12.00pm - 5.00pm </p>
					</div>
					<div class="col-md-4 mail-grid">
						<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
						<h5>E-mail</h5>
						<p>E-mail:<a href="mailto:info@ecoopu.com"> info@ecoopu.com</a></p>
						<p> Send us a mail anytime</p>
					</div>
					<div class="clearfix"></div>
				</div>

				<br><br><br>
				<div class="map-w3">
					<h2>Our Market Places</h2>
					<div id="chartdiv"></div>
					<!-- <div id="info">Seletced countries: <span id="selected">-</span></div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br>

<script src="{{URL::to('assets')}}/js/ammap.js"></script>
<script src="{{URL::to('assets')}}/js/worldLow.js"></script>
<script src="{{URL::to('assets')}}/js/light.js"></script>
<script type="text/javascript">

	var map = AmCharts.makeChart("chartdiv", {
		"type": "map",
		"theme": "light",
		"projection": "eckert3",
		"dataProvider": {
			"map": "worldLow",
			"getAreasFromMap": true,
			"areas": [
			{ "id": "DK", "title": "<a href='/pages/market-places/1'>Denmark</a>", "color": "#d9534f", "description":"<a href='/pages/market-places/1'>Our Market Place in Denmark</a>" },
			{ "id": "DE", "title": "<a href='/pages/market-places/2'>Germany</a>", "color": "#d9534f", "description":"<a href='/pages/market-places/2'>Our Market Place in Germany</a>" },
			{ "id": "GB", "title": "<a href='/pages/market-places/3'>United Kingdom</a>", "color": "#d9534f", "description":"<a href='/pages/market-places/3'>Our Market Place in the UK</a>" },
			{ "id": "FR", "title": "<a href='/pages/market-places/4'>France</a>", "color": "#d9534f", "description":"<a href='/pages/market-places/4'>Our Market Place in France</a>" },
			]
		},
		"balloon": {
			"horizontalPadding": 15,
			"borderAlpha": 0,
			"borderThickness": 1,
			"verticalPadding": 15
		},
		"areasSettings": {
			"rollOverBrightness": 20,
			"selectedBrightness": 20,
			"selectable": true,
			"unlistedAreasAlpha": 0,
			"unlistedAreasOutlineAlpha": 0
		},
		"imagesSettings": {
			"alpha": 1,
			"color": "rgba(129,129,129,1)",
			"outlineAlpha": 0,
			"rollOverOutlineAlpha": 0,
			"outlineColor": "rgba(80,80,80,1)",
			"rollOverBrightness": 20,
			"selectedBrightness": 20,
			"selectable": true
		},
		"zoomControl": {
			"zoomControlEnabled": true,
			"homeButtonEnabled": true,
			"panControlEnabled": true,
			"right": 38,
			"bottom": 30,
			"minZoomLevel": 1,
			"gridHeight": 100,
			"gridAlpha": 0.1,
			"gridBackgroundAlpha": 0,
			"gridColor": "#FFFFFF",
			"draggerAlpha": 1,
			"buttonCornerRadius": 2
		},

	});

</script>
@endsection
