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
					{{--Imprime el nombre de la imagen--}}
						@if(!count($Descripcion)==0)
							@foreach($Descripcion as $value)
								@if($value->id_idioma==1)
								<div class="col-md-8">
									<div class="col-md-12">
										<h2 class="titul">{{$value->titulo}}</h2>
									</div>
									<div class="col-md-8">
										<p>{{substr($value->texto,0,150)}}</p>
									</div>
								</div>
								@endif
							@endforeach
						@else
							<div class="col-md-8">
								<h2 class="titul">Imagen sin titulo</h2>
							</div>
						@endif
					{{--Fin nombre imagen--}}
				</div>

				<div class="row">
					<div class="divider">

							@if(Session::has('message'))
								<br>
								<div class="form-group">
									<div class="col-sm-7 col-sm-offset-2">
										<p class="alert alert-success">{{ Session::get('message') }}</p>
									</div>
								</div>
							@endif
							@if(Session::has('alerta'))
								<br>
								<div class="form-group">
									<div class="col-sm-7 col-sm-offset-2">
										<p class="alert alert-danger">{{ Session::get('alerta') }}</p>
									</div>
								</div>
							@endif
							@if( $errors->has('titulo'))
								<br>
								<div class="form-group">
									<div class="col-sm-7 col-sm-offset-2">
										<p class="alert alert-danger">{{ $errors->first('titulo') }}</p>
									</div>
								</div>
							@endif
							@if( $errors->has('texto'))
								<div class="form-group">
									<div class="col-sm-7 col-sm-offset-2">
										<p class="alert alert-danger">{{ $errors->first('texto') }}</p>
									</div>
								</div>
							@endif

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
											@if($value->id < 5 )
												@if($value->id == $Info->id_tipo)
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
								@if($valor->id_idioma == 1)
									<div class="form-group">
										{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('titulo', Input::old('titulo') ? Input::old(): $valor->titulo, array('class' => 'form-control', 'placeholder'=> 'Titulo de la Imagen')) }}
										</div>
									</div>
									<div class="form-group">
										{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
										<div class="col-sm-7">
											{{ Form::textarea('texto', Input::old('texto') ? Input::old(): $valor->texto, array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
										</div>
									</div>
								@endif
							@endforeach
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
								</div>	
							</div>
						{{ Form::close() }}
						{{-- Fin formulario informacion general --}}
					</div>	
				</div>
				{{--Agregar Traducciones--}}
				<div class="row">
					<div class="divider">
						{{--Comprobar si no hay traducciones disponibles--}}
						@if(count($Descripcion)>1)
							@foreach($idioma as $lang)
								<?php $conteo=0; ?>
								@foreach($Descripcion as $traduccion)
									@if($lang->id!=1)
										@if($traduccion->id_idioma!=1)
												
											{{--Verifica cada traduccion, y si no es espanol imprime su contenio--}}
											@if($lang->id==$traduccion->id_idioma)
												
												@if( $errors->has('titulo'.$traduccion->id))
													<br>
													<div class="form-group">
														<div class="col-sm-7 col-sm-offset-2">
															<p class="alert alert-danger">{{ $errors->first('titulo'.$traduccion->id) }}</p>
														</div>
													</div>
												@endif
												@if( $errors->has('texto'.$traduccion->id))
													<div class="form-group">
														<div class="col-sm-7 col-sm-offset-2">
															<p class="alert alert-danger">{{ $errors->first('texto'.$traduccion->id) }}</p>
														</div>
													</div>
												@endif
												{{Form::open(array('url'=>'administrador/Info/Update/Traduccion/'.$lang->nombre.'/'.$traduccion->id, 'class' => 'form-horizontal'))}}
													<div class="form-group">
														{{ Form::label('Idioma', $lang->nombre, array('class' => 'col-sm-6 control-label')) }}
													</div>
													<div class="form-group">
														{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::text('titulo'.$traduccion->id, Input::old('titulo') ? Input::old(): $traduccion->titulo, array('class' => 'form-control', 'placeholder'=> 'Titulo de la Imagen')) }}
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::textarea('texto'.$traduccion->id, Input::old('texto') ? Input::old(): $traduccion->texto, array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-offset-2 col-sm-10">
															{{ Form::submit('Actualizar traduccion en '.$lang->nombre , array('class'=> 'btn btn-primary')) }}
														</div>	
													</div>
												{{Form::close()}}
											{{--Segunda comprobacion--}}	
											@else
												<?php $conteo++; ?>
												@if($conteo==(count($Descripcion)-1))
													@if( $errors->has('titulo'.$lang->id))
														<br>
														<div class="form-group">
															<div class="col-sm-7 col-sm-offset-2">
																<p class="alert alert-danger">{{ $errors->first('titulo'.$lang->id) }}</p>
															</div>
														</div>
													@endif
													@if($errors->has('texto'.$lang->id))
														<div class="form-group">
															<div class="col-sm-7 col-sm-offset-2">
																<p class="alert alert-danger">{{ $errors->first('texto'.$lang->id) }}</p>
															</div>
														</div>
													@endif

													{{Form::open(array('url'=>'administrador/Info/traduccion/'.$lang->id.'/'.$Info->id, 'class' => 'form-horizontal'))}}
														<div class="form-group">
															{{ Form::label('Idioma', $lang->nombre, array('class' => 'col-sm-6 control-label')) }}
														</div>
														<div class="form-group">
															{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::text('titulo'.$lang->id, Input::old('titulo'), array('class' => 'form-control', 'placeholder'=> 'Titulo de la Imagen')) }}
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::textarea('texto'.$lang->id, Input::old('texto'), array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																{{ Form::submit('Agregar traduccion en '.$lang->nombre , array('class'=> 'btn btn-primary')) }}
															</div>	
														</div>
													{{Form::close()}}
												@endif
											@endif
										@endif
									@endif
								@endforeach
							@endforeach

						@else
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-4 control-label">
									<h3>Agregar Traducciones</h3>
								</div>
							</div>
							{{--Si la cantidad de descripciones es menor o igual a 1, muestra los formularios para agregar traducciones--}}
							@foreach($idioma as $lang)
								@if($lang->id!=1)
									@if( $errors->has('titulo'.$lang->id))
										<br>
										<div class="form-group">
											<div class="col-sm-7 col-sm-offset-2">
												<p class="alert alert-danger">{{ $errors->first('titulo'.$lang->id) }}</p>
											</div>
										</div>
									@endif
									@if( $errors->has('texto'.$lang->id))
										<div class="form-group">
											<div class="col-sm-7 col-sm-offset-2">
												<p class="alert alert-danger">{{ $errors->first('texto'.$lang->id) }}</p>
											</div>
										</div>
									@endif
									{{Form::open(array('url'=>'administrador/Info/traduccion/'.$lang->id.'/'.$Info->id, 'class' => 'form-horizontal'))}}
										<div class="form-group">
										<h1 class="titul">Cagada3</h1>
											{{ Form::label('Idioma', $lang->nombre, array('class' => 'col-sm-6 control-label')) }}
										</div>
										<div class="form-group">
											{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
											<div class="col-sm-7">
												{{ Form::text('titulo'.$lang->id, Input::old('titulo'), array('class' => 'form-control', 'placeholder'=> 'Titulo de la Imagen')) }}
											</div>
										</div>
										<div class="form-group">
											{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
											<div class="col-sm-7">
												{{ Form::textarea('texto'.$lang->id, Input::old('texto'), array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												{{ Form::submit('Agregar traduccion en '.$lang->nombre , array('class'=> 'btn btn-primary')) }}
											</div>	
										</div>
									{{Form::close()}}
								@endif
							@endforeach

						@endif
					</div>
				</div>
			@else
			<div class="row">
				<h2 class="titul">Informacion no disponible</h2>
			</div>
			@endif
@stop