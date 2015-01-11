@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Agregar Gasolinera</h2>
		{{ Form::open(array('url' => 'administrador/Gasolineras/Add', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
			<div class="form-group">
				{{ Form::label('lbldepartamento', 'Seleccionar departamento', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					<select class="form-control" id="departamento" name="departamento" onchange="initialize()">
						@foreach($deptos as $value)
					  		<option value="{{$value->id}}">{{$value->nombre}}</option>					  		
					  	@endforeach
					</select>
				</div>				
			</div>
			@foreach($deptos as $value)
				{{ Form::hidden('latitud', $value->latitud, array('id'=>'Latitud'.$value->nombre)) }}
				{{ Form::hidden('longitud', $value->longitud, array('id'=>'Longitud'.$value->nombre)) }}
			@endforeach
			<div class="form-group">
				{{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('nombre', Input::old('nombre') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Nombre de la estacion de combustible')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Latitud', 'Latitud', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('latitud', Input::old('latitud') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Latitud', 'id'=>'latitud')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Longitud', 'Longitud', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('longitud', Input::old('longitud') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Longitud', 'id'=>'longitud')) }}
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Agregar' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{Form::close()}}
		<div class="col-sm-12" id="mapa" style="height:260px;">
			

		</div>
	</div>
@stop

@section('Scripts')

<script>
		
	var map;
	var conteo=0;
	var puntos = [];
	
	function initialize(){  
		
		var seleccion = document.getElementById('departamento');
		var DeptoSelect=seleccion.options[seleccion.selectedIndex].text;
		var SelectLatitud=document.getElementById('Latitud'+DeptoSelect).value;
		var SelectLongitud=document.getElementById('Longitud'+DeptoSelect).value;
		
		var myLatlng = new google.maps.LatLng(SelectLatitud,SelectLongitud);
		var mapOptions = {
		          zoom: 12,
		          center: myLatlng,
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		          scrollwheel: false
		        };
					
		map = new google.maps.Map(document.getElementById('mapa'), mapOptions);		
		
		function addMark(location){
			
			if(conteo==0){
				marker = new google.maps.Marker({
					position: location,
					map: map,
					icon:'{{ asset('img/gas2.png')  }}'
					});
				puntos.push(marker);
				document.getElementById('latitud').value=location.lat();
				document.getElementById('longitud').value=location.lng();
			}	
	}	

		google.maps.event.addListener(map, 'click', function(event) {
			if(conteo==0){
				addMark(event.latLng);
		    	conteo++;		    	
			}
			else{
				for (p in puntos) {
				    puntos[p].setMap(null);
				  }
				  conteo=0;
				  document.getElementById('latitud').value="";
				document.getElementById('longitud').value="";
			}	    
		  });

	   
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