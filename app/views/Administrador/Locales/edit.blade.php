@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">{{$local}} de {{$depto->nombre}}</h2>		
				@if(!count($Info)==0)					
					<div class="row">
						<div class="col-md-4">
							<img class="img-responsive" src="{{ asset( 'img/'.$Info->foto.'') }}" alt="">
						</div>
						<div class="col-md-8">
						@if(!count($Descripcion)==0)
							@foreach($Descripcion as $value)
								@if($value->id_idioma==1)
									<h2 class="titul">{{$value->nombre}}</h2>
								@endif
							@endforeach
						@else
							<h2 class="titul">Imagen sin titulo</h2>
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
						{{Form::open(array('url'=>'administrador/Locales/Update/General/'.$Info->id, 'class' => 'form-horizontal'))}}
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
							{{ Form::label('lbllocal', 'Tipo local', array('class' => 'col-sm-2 control-label')) }}
							<div class="col-sm-7">
								<select class="form-control" id="local" name="local">
									@foreach($Localidades as $value)
										@if($value->id>=5)
											@if($value->id==$Info->id_info)
									  			<option value="{{$value->id}}" selected="">{{$value->tipo}}</option>
									  		@else
									  			<option value="{{$value->id}}">{{$value->tipo}}</option>
									  		@endif
									  	@endif
								  	@endforeach					  
								</select>
							</div>				
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								{{ Form::submit('Actualizar' , array('class'=> 'btn btn-primary')) }}
							</div>	
						</div>
						{{Form::close()}}
						
						<br>

						@if(!count($Descripcion)==0)
							@foreach($idioma as $key)
								@foreach($Descripcion as $valor)
									@if($valor->id_idioma==$key->id)
										{{Form::open(array('url'=>'administrador/Locales/Update/'.$local.'/'.$depto->nombre.'/'.$valor->id, 'class' => 'form-horizontal'))}}
											<div class="form-group">
												{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
											</div>
											<div class="form-group">
												{{ Form::label('Titulo', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::text('nombre', Input::old('titulo') ? Input::old(): $valor->nombre, array('class' => 'form-control', 'placeholder'=> 'Nombre del local')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('telefono', 'Telefono', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::text('telefono', Input::old('telefono') ? Input::old():$valor->telefono , array('class' => 'form-control', 'placeholder'=> 'Telefono del local')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::textarea('direccion', Input::old('direccion') ? Input::old(): $valor->direccion, array('class' => 'form-control', 'placeholder'=> 'Direccion del local', 'size' => '30x5')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::textarea('descripcion', Input::old('descipcion') ? Input::old(): $valor->descripcion, array('class' => 'form-control', 'placeholder'=> 'Descripcion del local', 'size' => '30x8')) }}
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
										@if(count($idioma)>count($Descripcion))
											<div class="divider">
												{{Form::open(array('url'=>'administrador/Locales/traduccion/'.$key->id.'/'.$id_info, 'class' => 'form-horizontal'))}}
													<div class="form-group">
														{{ Form::label('Idioma', $key->nombre, array('class' => 'col-sm-6 control-label')) }}
													</div>
													<div class="form-group">
														{{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::text('nombre', Input::old('nombre') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Nombre del local')) }}
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('telefono', 'Telefono', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::text('telefono', Input::old('telefono') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Telefono del local')) }}
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('direccion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::textarea('direccion', Input::old('texto') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Direccion del local', 'size' => '30x5')) }}
														</div>
													</div>
													<div class="form-group">
														{{ Form::label('descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
														<div class="col-sm-7">
															{{ Form::textarea('descripcion', Input::old('descipcion') ? Input::old(): '', array('class' => 'form-control', 'placeholder'=> 'Descripcion del local', 'size' => '30x8')) }}
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
								@endforeach							
							@endforeach
							@else
								@foreach($idioma as $variable)
									<div class="divider">
										{{Form::open(array('url'=>'administrador/Locales/traduccion/'.$variable->id.'/'.$id_info, 'class' => 'form-horizontal'))}}
											<div class="form-group">
												{{ Form::label('Idioma', $variable->nombre, array('class' => 'col-sm-6 control-label')) }}
											</div>
											<div class="form-group">
												{{ Form::label('nombre', 'Nombre', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::text('nombre', Input::old('nombre') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Nombre del local')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('telefono', 'Telefono', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::text('telefono', Input::old('telefono') ? Input::old():'' , array('class' => 'form-control', 'placeholder'=> 'Telefono del local')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('descripcion', 'Direccion', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::textarea('texto', Input::old('texto') ? Input::old():'', array('class' => 'form-control', 'placeholder'=> 'Direccion del local', 'size' => '30x5')) }}
												</div>
											</div>
											<div class="form-group">
												{{ Form::label('descripcion', 'Descripcion', array('class' => 'col-sm-2 control-label')) }}
												<div class="col-sm-7">
													{{ Form::textarea('descripcion', Input::old('descipcion') ? Input::old(): '', array('class' => 'form-control', 'placeholder'=> 'Descripcion del local', 'size' => '30x8')) }}
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
								@endforeach
						@endif					
					</div>
				@else
					<h2 class="titul">No se ha encontrado ninguna informacion</h2>
				@endif	
			</div>	
	</div>
@stop