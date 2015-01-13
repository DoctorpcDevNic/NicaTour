@extends('templates.adminTemplate')
@section('contenido')
	<div class="container-fluid">
		<h2 class="titul" id="Editar">Editar etiquetas</h2>
		@if(Session::has('message'))
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
			{{ Form::open(array('url' => 'administrador/SEO/Update', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
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
				{{ Form::hidden('tags', $value->keywords, array('id'=>'key'.$value->id)) }}
				{{ Form::hidden('descr', $value->descripcion, array('id'=>'descr'.$value->id)) }}
			@endforeach
			<div class="form-group">
				{{ Form::label('Keywords', 'Keywords', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('keywords', Input::old('keywords') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> '*Separar tags por comas', 'size' => '30x5', 'id'=>'KeyForm')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('descripcion', Input::old('descripcion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Descripcion de la pagina', 'size' => '30x5', 'id'=>'DescForm')) }}
				</div>
			</div>
			<div class="form-group">				
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Actualizar Etiquetas' , array('class'=> 'btn btn-primary')) }}
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

		document.getElementById('KeyForm').value=document.getElementById('key'+DeptoSelect).value;
		document.getElementById('DescForm').value=document.getElementById('descr'+DeptoSelect).value;
	}

	window.onload = initialize;	
</script>

@stop