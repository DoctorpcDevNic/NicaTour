@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Gasolineras en {{$depto->nombre}}</h2>
		<div class="form-group">
		<br>
			@if(Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
		</div>
		@if(!count($Gasolineras)==0)
			<div class="col-sm-12" id="mapa" style="height:260px;">

			</div>								
			<div class="row">						
				@foreach($Gasolineras as $value)								
					<div class="col-sm-6">
						<div class="col-sm-12">
							<h3 class="titul">{{$value->nombre}}</h3>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-3">
								<a href="#" class="btn btn-primary">Editar</a>
							</div>
							<div class="col-sm-3">
								<a href="{{ URL::to('/administrador/Gasolineras/Del/'.$value->id.'') }}" class="btn btn-primary">Eliminar</a>
							</div>
						</div>						
					</div>
				@endforeach
			</div>
			<br>
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
	</div>
@stop
@section('Scripts')

<script>
		
	var map;
	
	function initialize(){  
		
		var myLatlng = new google.maps.LatLng({{$depto->latitud}},{{$depto->longitud}});
		var mapOptions = {
		          zoom: {{$depto->zoom}},
		          center: myLatlng,
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		          scrollwheel: false
		        };
					
		map = new google.maps.Map(document.getElementById('mapa'), mapOptions);		
		
		@if(!count($Gasolineras)==0)
			@foreach($Gasolineras as $key)
				var MarcaPosition = new google.maps.LatLng({{$key->latitud}},{{$key->longitud}});
				var marker=new google.maps.Marker({
				  position: MarcaPosition,
				  icon:'{{ asset('img/gas2.png')  }}'
				  });

				marker.setMap(map);
			@endforeach
		@endif
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