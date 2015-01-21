@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Agregar Local</h2>
		{{ Form::open(array('url' => 'administrador/Restaurantes/Add', 'class' => 'form-horizontal')) }}
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
				{{ Form::label('Titulo', 'Municipio', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('municipio', Input::old('municipio') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Municipio')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('Titulo', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('nombre', Input::old('nombre') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Nombre del local')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('telefono', 'Telefono', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('telefono', Input::old('telefono') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Telefono del local')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('direccion', Input::old('direccion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Direccion del local', 'size' => '30x5')) }}
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