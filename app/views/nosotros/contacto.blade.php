@extends('templates.maintemplate')
@section('informacion')
<div class="contacto">
	@if(Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	{{ HTML::ul($errors->all(), array('class' =>'bg-danger')) }}

	{{ Form::open(array('url' => 'contacto/enviar', 'files' => 'true' ,'class' => 'form-horizontal')) }}
		<div class="form-group contactini">
			{{ Form::label('nombre', 'Nombres', array('class' => 'col-md-3 col-sm-1 col-xs-12 control-label')) }}
			<div class="col-md-6 col-xs-12">
				{{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder'=> 'Nombres')) }}	
			</div>
		</div>	
		<div class="form-group">
			{{ Form::label('apellido', 'Apellidos', array('class' => 'col-md-3 col-sm-1 col-xs-12 control-label')) }}
			<div class="col-md-6 col-xs-12">
				{{ Form::email('apellido', Input::old('apellido'), array('class' => 'form-control', 'placeholder'=> 'Apellidos')) }}	
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Email', array('class' => 'col-md-3 col-sm-1 col-xs-12 control-label')) }}
			<div class="col-md-6 col-xs-12">
				{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder'=> 'Email')) }}	
			</div>
		</div>		
		<div class="form-group">
			{{ Form::label('mensaje', 'Mensaje', array('class' => 'col-md-3 col-sm-1 col-xs-12 control-label')) }}
			<div class="col-md-6 col-xs-12">
				{{ Form::textarea('mensaje', Input::old('mensaje'), array('class' => 'form-control col-xs-12', 'placeholder'=> 'Mensaje')) }}	
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-8 col-xs-12">
				{{ Form::submit('Enviar Comentario' , array('class'=> 'btn btn-success')) }}
			</div>	
		</div>
	{{ Form::close() }}
</div>
@stop