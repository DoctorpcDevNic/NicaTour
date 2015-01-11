@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Gasolineras</h2>
		<div class="row">
		@if(!count($Gasolineras)==0)		
			@foreach($departamentos as $value)
						<div class="col-md-6">						
							<div id="mapa{{$value->id}}" style="height:300px;">
								
							</div>
							<h3 class="titul">{{$value->nombre}}</h3>
						</div>
			@endforeach
		@else
			<h2 class="titul">No se ninguna gasolineras, favor agregar datos</h2>
		@endif
		</div>
		<div>{{$departamentos->links()}}</div>
	</div>
@stop

@section('Scripts')

<script>
	var conteo=0;
	
	function initialize(){

		@foreach($departamentos as $key)
			var map{{$key->id}};
			map{{$key->id}} = new google.maps.Map(document.getElementById('mapa{{$key->id}}'), mapOptions);

			var myLatlng{{$key->id}} = new google.maps.LatLng({{$key->latitud}},{{$key->longitud}});
			var mapOptions = {
		          zoom: {{$key->zoom}},
		          center: myLatlng{{$key->id}},
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		          scrollwheel: false
		        };


		@endforeach
		
	}
	
	function loadScript()
	{
	  var script = document.createElement("script");
	  script.type = "text/javascript";
	  script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
	  document.body.appendChild(script);
	}

	window.onload = loadScript;	
	window.onresize = initialize;
</script>

@stop