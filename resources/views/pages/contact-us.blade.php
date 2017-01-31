@extends('layouts.app')

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
						<p>13/25 New Avenue New Heaven 45Y 73J Denmark </p>
					</div>
					<div class="col-md-4 mail-grid">
						<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
						<h5>Phone</h5>
						<p>Telephone:  +0 000 0000 0000</p>
					</div>
					<div class="col-md-4 mail-grid">
						<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
						<h5>E-mail</h5>
						<p>E-mail:<a href="mailto:info@ecoopu.com"> info@ecoopu.com</a></p>
					</div>
					<div class="clearfix"></div>
				</div>
				<br><br><br>
				<div class="map-w3">
					<h1>We have shops in the following countries</h1>
					<div id="chartdiv"></div>
					<!-- <div id="info">Seletced countries: <span id="selected">-</span></div> -->
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://www.amcharts.com/lib/3/ammap.js"></script>
<script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script type="text/javascript">
/**
* Create the map
*/
var map = AmCharts.makeChart("chartdiv", {
	"type": "map",
	"theme": "light",
	"projection": "eckert3",
	"dataProvider": {
		"map": "worldLow",
		"getAreasFromMap": true;
	},
	"areasSettings": {
		"selectedColor": "#d9534f",
		"selectable": false
	},

  /**
   * Add click event to track country selection/unselection
   */
   "listeners": [{
   	"event": "clickMapObject",
   	"method": function(e) {

      // Ignore any click not on area
      if (e.mapObject.objectType !== "MapArea")
      	return;
      
      var area = e.mapObject;
      
      // Toggle showAsSelected
      area.showAsSelected = !area.showAsSelected;
      e.chart.returnInitialColor(area);
      
      // Update the list
      /*document.getElementById("selected").innerHTML = JSON.stringify(getSelectedCountries());*/
  }
}]
});

/**
 * Function which extracts currently selected country list.
 * Returns array consisting of country ISO2 codes
 */
 function getSelectedCountries() {
 	var selected = ["DE","DK","FR","GB"];
 	for(var i = 0; i < map.dataProvider.areas.length; i++) {
 		/*if(map.dataProvider.areas[i].showAsSelected)
 			selected.push(map.dataProvider.areas[i].id);*/
 			map.dataProvider.areas[i].showAsSelected;
 			map.clickMapObject(map.dataProvider.areas[i]);
 	}
 	return selected;
 }

 getSelectedCountries();
</script>
@endsection
