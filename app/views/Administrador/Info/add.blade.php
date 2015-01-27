@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Información Cultural - Agregar Imagen</h2>
		@if( $errors->has('archivo'))
				<div class="row">
					<div class="col-sm-7 col-sm-offset-2">
						<p class="alert alert-danger">{{ $errors->first('archivo') }}</p>
					</div>
				</div>
			@endif
		@if( $errors->has('titulo'))
				<div class="row">
					<div class="col-sm-7 col-sm-offset-2">
						<p class="alert alert-danger">{{ $errors->first('titulo') }}</p>
					</div>
				</div>
			@endif
			@if( $errors->has('descripcion'))
				<div class="row">
					<div class="col-sm-7 col-sm-offset-2">
						<p class="alert alert-danger">{{ $errors->first('descripcion') }}</p>
					</div>
				</div>
			@endif
		{{ Form::open(array('url' => 'administrador/Info/Add', 'files' => 'true', 'class' => 'form-horizontal')) }}
			
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
							@if($key->id<5)
					  			<option value="{{$key->id}}">{{$key->tipo}}</option>
					  		@endif
					  	@endforeach					  
					</select>
				</div>				
			</div>
			<div class="form-group">
				{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('titulo', Input::old('titulo') ? Input::old(): '', array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('texto', Input::old('texto') ? Input::old(): '', array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
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