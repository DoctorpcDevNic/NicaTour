@extends('templates.departamentotemplate')
@section('titulo')
Gasolineras en {{$departamento->nombre}}
@stop


@section('SliderDpto')
 <div class="fluid_container">              
    <div class="camera_wrap camera_azure_skin" id="camera_wrap_2">
        @foreach($SliderDpto as $value)
        <div data-src="{{ asset( 'img/'.$value->img.'') }}">
            <div class="titulSlideimg">
                 <!--h2>Chinandega, Corinto</h2-->
            </div>
        </div>
        @endforeach
    </div>
 </div>
@stop

@section('anuncio')
  <div class="anuncio">
        <h2 id="Maps">Gasolineras en {{$departamento->nombre}}</h2>
  </div>
@stop


@section('contenido') 
<div class="container-fluid">
  <div class="row">
  	<div class="col-sm-12" id="mapa" style="height:450px;">

	</div>
  </div>
</div>
@stop

@section('Scripts')

<script>
		
	var map;
	var conteo=0;
	
	function initialize(){  
		
		var myLatlng = new google.maps.LatLng({{$departamento->latitud}},{{$departamento->longitud}});
		var mapOptions = {
		          zoom: {{$departamento->zoom}},
		          center: myLatlng,
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		          scrollwheel: false
		        };
					
		map = new google.maps.Map(document.getElementById('mapa'), mapOptions);		
		
		@if(!count($Gasolineras)==0)
			@foreach($Gasolineras as $key)
				var MarcaPosition{{$key->id}} = new google.maps.LatLng({{$key->latitud}},{{$key->longitud}});
				var marker{{$key->id}}=new google.maps.Marker({
				  position: MarcaPosition{{$key->id}},
				  icon:'{{ asset('img/gas2.png')  }}'
				  });
				marker{{$key->id}}.setMap(map);
				var infowindow{{$key->id}} = new google.maps.InfoWindow({
				  content:"{{$key->nombre}}",
				  maxWidth: 80
				  });
				google.maps.event.addListener(marker{{$key->id}}, 'click', function() {
					if(conteo==0)
					{
						infowindow{{$key->id}}.open(map,marker{{$key->id}});
						conteo++;
					}
					else
					{
						infowindow{{$key->id}}.close(map,marker{{$key->id}});
						conteo=0;
					}	  				  
				  });
				google.maps.event.addListener(marker{{$key->id}}, 'rightclick', function() {
				  infowindow{{$key->id}}.close(map,marker{{$key->id}});
				  });
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






