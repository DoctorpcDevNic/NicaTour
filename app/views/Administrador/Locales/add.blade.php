@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Agregar Local</h2>
		{{ Form::open(array('url' => 'administrador/Locales/Add', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
			<div class="form-group">
				{{ Form::label('lbldepartamento', 'Seleccionar Departamento', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					<select class="form-control" id="departamento" name="departamento">
						@foreach($depto as $value)
					  		<option value="{{$value->id}}">{{$value->nombre}}</option>
					  	@endforeach					  
					</select>
				</div>				
			</div>

			<div class="form-group">
				{{ Form::label('lblTipo', 'Seleccionar Tipo', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					<select class="form-control" id="tipo" name="tipo">
						@foreach($tipo as $key)
							@if($key->id>=5)
					  			<option value="{{$key->id}}">{{$key->tipo}}</option>
					  		@endif
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