@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">{{$Slide->titulo}}</h2>		
				@if(!count($Slide)==0)					
					<div class="row">
						<div class="col-md-4">
							<img src="{{ asset('img/'.$Slide->img)  }}" alt="" class="img-responsive">
						</div>
						<div class="col-md-8">
						@if($Slide->titulo!="")
							<h2 class="titul">{{$Slide->titulo}}</h2>
						@else
							<h2 class="titul">Imagen sin titulo</h2>
						@endif
						@if($Slide->descripcion!="")
							<p>{{$Slide->descripcion}}</p>
						@else
							<p>No hay descripcion</p>
						@endif
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

			{{--Editar Informacion General--}}

						{{Form::open(array('url'=>'administrador/Slider/Update/'.$Slide->id, 'class' => 'form-horizontal'))}}
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
										@if($value->id==$Slide->id_dpto)
								  			<option value="{{$value->id}}" selected="">{{$value->nombre}}</option>
								  		@else
								  			<option value="{{$value->id}}">{{$value->nombre}}</option>
								  		@endif
								  	@endforeach					  
								</select>
							</div>				
						</div>
						<div class="form-group">
							{{ Form::label('Titulo', 'Titulo Imagen', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{ Form::text('titulo', Input::old('titulo') ? Input::old():$Slide->titulo, array('class' => 'form-control', 'placeholder'=> 'Nombre de la Imagen')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('descripcion', 'Descripcion de la imagen', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								{{ Form::textarea('descripcion', Input::old('descripcion') ? Input::old():$Slide->descripcion, array('class' => 'form-control', 'placeholder'=> 'Descripcion de la Imagen')) }}
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
											{{Form::open(array('url'=>'administrador/Slider/Update/Traduccion/'.$valor->id, 'class' => 'form-horizontal'))}}
												<div class="form-group">
													{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
												</div>
												<div class="form-group">
													{{ Form::label('Titulo', 'Titulo', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::text('titulo', Input::old('titulo') ? Input::old(): $valor->titulo, array('class' => 'form-control', 'placeholder'=> 'Titulo de la imagen')) }}
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('Descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::textarea('descripcion', Input::old('descripcion') ? Input::old(): $valor->descripcion, array('class' => 'form-control', 'placeholder'=> 'Descripcion de la imagen', 'size' => '30x5')) }}
													</div>
												</div>
												<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																{{ Form::submit('Actualizar Traducción en '.$key->nombre , array('class'=> 'btn btn-primary')) }}
															</div>	
														</div>
											{{Form::close()}}
											<br>
										@else
										{{--Se muestran los idiomas que no tienen taduccion--}}
											@if((count($idioma)-1)>count($Descripcion))
												<div class="divider">
													{{Form::open(array('url'=>'administrador/Slider/Traduccion/Add/'.$key->id.'/'.$Slide->id.'/'.$Slide->id_dpto, 'class' => 'form-horizontal'))}}
														<div class="form-group">
															{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
														</div>
														<div class="form-group">
															{{ Form::label('Titulo', 'Titulo', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::text('titulo', Input::old('titulo') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Titulo de la imagen')) }}
															</div>
														</div>
														<div class="form-group">
															{{ Form::label('Descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
															<div class="col-sm-7">
																{{ Form::textarea('descripcion', Input::old('descripcion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Descripcion de la imagen', 'size' => '30x5')) }}
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
											{{Form::open(array('url'=>'administrador/Slider/Traduccion/Add/'.$variable->id.'/'.$Slide->id.'/'.$Slide->id_dpto, 'class' => 'form-horizontal'))}}
												<div class="form-group">
													{{ Form::label('Idioma', $variable->nombre, array('class' => 'col-sm-6 control-label')) }}
												</div>
												<div class="form-group">
													{{ Form::label('Titulo', 'Titulo', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::text('titulo', Input::old('titulo') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Titulo de la imagen')) }}
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('Descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
													<div class="col-sm-7">
														{{ Form::textarea('descripcion', Input::old('descripcion') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Descripcion de la imagen', 'size' => '30x5')) }}
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