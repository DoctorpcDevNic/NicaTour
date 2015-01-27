@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Evento de {{$depto->nombre}}</h2>		
				@if(!count($Eventos)==0)					
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-8">
							<h2 class="titul">{{$Eventos->nombre}}</h2>
						</div>
					</div>				
			<div class="row">
					<div class="divider">
						<div class="form-group">
						<br>
							@if(Session::has('message'))
								<div class="alert alert-info">{{ Session::get('message') }}</div>
							@endif
							@if(Session::has('updatetrad'))
								<div class="alert alert-danger">{{ Session::get('updatetrad') }}</div>
							@endif
							@if(Session::has('newtrad'))
								<div class="alert alert-danger">{{ Session::get('newtrad') }}</div>
							@endif
							@if( $errors->has('municipio'))
								<div class="col-sm-5 col-sm-offset-3">
									<p class="alert alert-danger">{{ $errors->first('municipio') }}</p>
								</div>
							@endif
							@if( $errors->has('fecha'))
								<div class="col-sm-5 col-sm-offset-3">
									<p class="alert alert-danger">{{ $errors->first('fecha') }}</p>
								</div>
							@endif
							@if( $errors->has('nombre'))
								<div class="col-sm-5 col-sm-offset-3">
									<p class="alert alert-danger">{{ $errors->first('nombre') }}</p>
								</div>
							@endif
							@if( $errors->has('direccion'))
								<div class="col-sm-5 col-sm-offset-3">
									<p class="alert alert-danger">{{ $errors->first('direccion') }}</p>
								</div>
							@endif
						</div>

			{{--Editar Informacion General--}}

						{{Form::open(array('url'=>'administrador/Calendario/Update/General/'.$Eventos->id, 'class' => 'form-horizontal'))}}
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
										@if($value->id==$Eventos->id_depto)
								  			<option value="{{$value->id}}" selected="">{{$value->nombre}}</option>
								  		@else
								  			<option value="{{$value->id}}">{{$value->nombre}}</option>
								  		@endif
								  	@endforeach					  
								</select>
							</div>				
						</div>
						<div class="form-group">
							{{ Form::label('Municipio', 'Municipio', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{ Form::text('municipio', Input::old('municipio') ? Input::old():$Eventos->municipio, array('class' => 'form-control', 'placeholder'=> 'Municipio')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('Nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{ Form::text('nombre', Input::old('nombre') ? Input::old():$Eventos->nombre, array('class' => 'form-control', 'placeholder'=> 'Nombre del evento')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('fecha', 'Fecha', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{Form::input('date', 'fecha', Input::old('fecha') ? Input::old():$Eventos->fecha, ['class' => 'form-control', 'placeholder' => 'Fecha del evento']);}}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{ Form::textarea('direccion', Input::old('direccion') ? Input::old():$Eventos->direccion, array('class' => 'form-control', 'placeholder'=> 'Direccion del evento', 'size' => '30x5')) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
							</div>	
						</div>
						{{Form::close()}}
						
						<br>
			{{--Fin Editar Informacion General--}}


			{{--Revisa si existen traducciones--}}
						@if(!count($Descripcion)==0)
							@foreach($idioma as $key)
								@foreach($Descripcion as $valor)

								{{--Recorre todas las descripciones y compara si pertenece al mismo idioma para editarlo--}}
									@if($key->id!=1)
										@if($valor->id_idioma==$key->id)
											{{Form::open(array('url'=>'administrador/Calendario/Update/Traduccion/'.$valor->id, 'class' => 'form-horizontal'))}}
												<div class="form-group">
													{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
													@if( $errors->has('nombre'.$valor->id))
																<div class="col-sm-7 col-sm-offset-2">
																	<p class="alert alert-danger">{{ $errors->first('nombre'.$valor->id) }}</p>
																</div>
															@endif
															@if( $errors->has('direccion'.$valor->id))
																<div class="col-sm-7 col-sm-offset-2">
																	<p class="alert alert-danger">{{ $errors->first('direccion'.$valor->id) }}</p>
																</div>
															@endif
												</div>
												<div class="form-group">
													{{ Form::label('Titulo', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::text('nombre'.$valor->id, Input::old('titulo') ? Input::old(): $valor->nombre, array('class' => 'form-control', 'placeholder'=> 'Nombre del evento')) }}
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::textarea('direccion'.$valor->id, Input::old('direccion') ? Input::old(): $valor->direccion, array('class' => 'form-control', 'placeholder'=> 'Direccion del evento', 'size' => '30x5')) }}
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
													</div>	
												</div>
											{{Form::close()}}
											<br>
										@else
										{{--Se muestran los idiomas que no tienen taduccion--}}
											@if((count($idioma)-1)>count($Descripcion))
												<div class="divider">
													{{Form::open(array('url'=>'administrador/Calendario/traduccion/add/'.$key->id.'/'.$Eventos->id, 'class' => 'form-horizontal'))}}
														<div class="form-group">
															{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
															@if( $errors->has('nombre'.$key->id))
																<div class="col-sm-7 col-sm-offset-2">
																	<p class="alert alert-danger">{{ $errors->first('nombre'.$key->id) }}</p>
																</div>
															@endif
															@if( $errors->has('direccion'.$key->id))
																<div class="col-sm-7 col-sm-offset-2">
																	<p class="alert alert-danger">{{ $errors->first('direccion'.$key->id) }}</p>
																</div>
															@endif
														</div>
														<div class="form-group">
															{{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::text('nombre'.$key->id, Input::old('nombre') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Nombre del evento')) }}
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::textarea('direccion'.$key->id, Input::old('direccion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Direccion del evento', 'size' => '30x5')) }}
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																{{ Form::submit('Agregar Traducción en '.$key->nombre , array('class'=> 'btn btn-primary')) }}
															</div>	
														</div>
													{{Form::close()}}
												</div>
												<br>
											@endif
										@endif
									@endif
								@endforeach							
							@endforeach


				{{--Si no existe ninguna traduccion, permite agregar exceptuando el espanol--}}
							@else
								@foreach($idioma as $variable)
									@if($variable->id!=1)
										<div class="divider">
											{{Form::open(array('url'=>'administrador/Calendario/traduccion/add/'.$variable->id.'/'.$Eventos->id, 'class' => 'form-horizontal'))}}
												<div class="form-group">
													{{ Form::label('Idioma', $variable->nombre, array('class' => 'col-sm-6 control-label')) }}
													@if( $errors->has('nombre'.$variable->id))
														<div class="col-sm-5 col-sm-offset-3">
															<p class="alert alert-danger">{{ $errors->first('nombre'.$variable->id) }}</p>
														</div>
													@endif
													@if( $errors->has('direccion'.$variable->id))
														<div class="col-sm-5 col-sm-offset-3">
															<p class="alert alert-danger">{{ $errors->first('direccion'.$variable->id) }}</p>
														</div>
													@endif
												</div>
												<div class="form-group">
													{{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::text('nombre'.$variable->id, Input::old('nombre') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Nombre del evento')) }}
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::textarea('direccion'.$variable->id, Input::old('direccion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Direccion del evento', 'size' => '30x5')) }}
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
														{{ Form::submit('Agregar Traducción en '.$variable->nombre , array('class'=> 'btn btn-primary')) }}
													</div>	
												</div>
											{{Form::close()}}
										</div>
										<br>
									@endif
								@endforeach
						@endif					
					</div>
				@else
					<h2 class="titul">No se ha encontrado ninguna informacion</h2>
				@endif	
			</div>	
	</div>
@stop