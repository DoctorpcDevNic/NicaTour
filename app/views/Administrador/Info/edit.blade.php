@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">{{$opcion}} de {{$depto->nombre}}</h2>
		{{--Verificar si existe la informacion--}}		
			@if(!count($Info)==0)					
				<div class="row">
					<div class="col-md-4">
						<img class="img-responsive" src="{{ asset( 'img/'.$Info->foto.'') }}" alt="">
					</div>
					<div class="col-md-8">
					{{--Imprime el nombre de la imagen--}}
						@if(!count($Descripcion)==0)
							@foreach($Descripcion as $value)
								@if($value->id_idioma==1)
									<h2 class="titul">{{$value->titulo}}</h2>
								@endif
							@endforeach
						@else
							<h2 class="titul">Imagen sin titulo</h2>
						@endif
					{{--Fin nombre imagen--}}
					</div>
				</div>
				<div class="row">
					<div class="divider">
						<div class="form-group">
							<br>
							@if(Session::has('message'))
								<div class="alert alert-info">{{ Session::get('message') }}</div>
							@endif
						</div>
					{{--Formulario de informacion general--}}
						{{Form::open(array('url'=>'administrador/Info/Update/General/'.$Info->id, 'class' => 'form-horizontal'))}}
							<div class="form-group">
								<div class="col-sm-6 control-label">
									<h3>Informacion General</h3>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('lbldepartamento', 'Seleccionar departamento', array('class' => 'col-sm-2 control-label')) }}
								<div class="col-sm-7">
									<select class="form-control" id="departamento" name="departamento">
										@foreach($DptosAll as $value)
											@if($value->id==$depto->id)
									  			<option value="{{$value->id}}" selected="">{{$value->nombre}}</option>
									  		@else
									  			<option value="{{$value->id}}">{{$value->nombre}}</option>
									  		@endif
									  	@endforeach					  
									</select>
								</div>				
							</div>
							<div class="form-group">
								{{ Form::label('lbllocal', 'Tipo Informacion', array('class' => 'col-sm-2 control-label')) }}
								<div class="col-sm-7">
									<select class="form-control" id="tipo" name="tipo">
										@foreach($TipoCultura as $value)
											@if($value->id<5)
												@if($value->id==$Info->id_tipo)
										  			<option value="{{$value->id}}" selected="">{{$value->tipo}}</option>
										  		@else
										  			<option value="{{$value->id}}">{{$value->tipo}}</option>
										  		@endif
										  	@endif
									  	@endforeach					  
									</select>
								</div>				
							</div>
							@foreach($Descripcion as $valor)
								@if($valor->id_idioma==1)
									<div class="form-group">
										{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('titulo', Input::old('titulo') ? Input::old(): $valor->titulo, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
										<div class="col-sm-7">
											{{ Form::textarea('texto', Input::old('texto') ? Input::old(): $valor->texto, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
										</div>
									</div>
								@endif
							@endforeach
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
								</div>	
							</div>
						{{Form::close()}}
						{{--Fin formulario informacion general--}}
								<br>
								@if(!count($Descripcion)==0)
									@foreach($idioma as $key)
										@foreach($Descripcion as $valor)
											@if($valor->id_idioma!=1)
												@if($valor->id_idioma==$key->id)
													{{Form::open(array('url'=>'administrador/Info/Update/'.$opcion.'/'.$depto->nombre.'/'.$valor->id, 'class' => 'form-horizontal'))}}
														<div class="form-group">
															{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
														</div>
														<div class="form-group">
															{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::text('titulo', Input::old('titulo') ? Input::old(): $valor->titulo, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::textarea('texto', Input::old('texto') ? Input::old(): $valor->texto, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
															</div>	
														</div>
													{{Form::close()}}
												@endif
											@endif
										@endforeach
									@endforeach
								@else
									<h2 class="titul">No se ha encontrado ninguna informacion</h2>
								@endif	
					}
					}
					</div>	
			</div>
@stop