@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Video mostrado desde Youtube</h2>
		@if(Session::has('message'))
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
		<div class="row">
			@foreach($departamentos as $value)
				<div class="col-md-4">
					<div class="embed-responsive embed-responsive-16by9">
						 <iframe class="embed-responsive-item" src="http://www.youtube.com/v/{{$value->youtube}}"></iframe>
					</div>
					<a href="#Editar" value="{{$value->id}}"><h2 class="titul">{{$value->nombre}}</h2></a>
				</div>
			@endforeach
		</div>
		<div>{{$departamentos->links()}}</div>
	</div>
	<br>
	<div class="container-fluid">
		<h2 class="titul" id="Editar">Editar</h2>
			{{ Form::open(array('url' => 'administrador/Youtube/Show', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
			<div class="form-group">
				{{ Form::label('lbldepartamento', 'Seleccionar departamento', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					<select class="form-control" id="departamento" name="departamento" onchange="initialize()">
						@foreach($departamentos as $value)
					  		<option value="{{$value->id}}">{{$value->nombre}}</option>					  		
					  	@endforeach
					</select>
				</div>				
			</div>
			@foreach($departamentos as $value)
				{{ Form::hidden('UriVideo', $value->youtube, array('id'=>'Video'.$value->id)) }}
			@endforeach
			<div class="form-group">
				{{ Form::label('uri', 'http://youtu.be/', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('video', Input::old('video') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> '*ID del video', 'id'=>'idvideo')) }}
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Cambiar Video' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
			{{Form::close()}}
	</div>
@stop

@section('Scripts')
<script>
	function initialize(){
		var seleccion = document.getElementById('departamento');
		var DeptoSelect=seleccion.options[seleccion.selectedIndex].value;
		var Video=document.getElementById('Video'+DeptoSelect).value;

		document.getElementById('idvideo').value=document.getElementById('Video'+DeptoSelect).value;
	}

	window.onload = initialize;	
</script>

@stop