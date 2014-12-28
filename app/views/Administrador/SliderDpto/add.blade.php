@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Slider Principal - Agregar Imagen</h2>
		{{ Form::open(array('url' => 'administrador/Slider/Add', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
			<div class="form-group">
				{{ Form::label('lbldepartamento', 'Seleccionar departamento', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					<select class="form-control" id="departamento" name="departamento">
						@foreach($depto as $value)
					  		<option value="{{$value->id}}">{{$value->nombre}}</option>
					  	@endforeach					  
					</select>
				</div>				
			</div>

			<div class="form-group">
				{{ Form::label('imagen', 'Seleccionar Imagen', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::file('archivo') }}
				</div>
			</div>

			<div class="form-group">				
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Agregar' , array('class'=> 'btn btn-primary')) }}
				</div>	
			</div>
		{{Form::close()}}
	</div>
@stop