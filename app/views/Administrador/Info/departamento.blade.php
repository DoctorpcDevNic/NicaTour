@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Cultura Departamental - {{$opcion}} de {{$depto->nombre}}</h2>
		<div class="form-group">
		<br>
			@if(Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
		</div>
		@if(!count($Info)==0)
			<?php $registro=count($Descripcion); ?>
				@foreach($Info as $key)
					<?php $conteo=0; ?>
					@foreach($Descripcion as $value)						
						@if($value->id_infodetalle==$key->id)							
							@if($value->id_idioma==1)
								<div class="row">
									<div class="col-md-5">
										<img class="img-responsive" src="{{ asset( 'img/'.$key->foto.'') }}" alt="">
									</div>
									<div class="col-md-7">									
										<h2 class="titul">{{$value->titulo}}</h2>										
										<p>{{$value->texto}}</p>
										<a href="{{ URL::to('/administrador/Info/Edit/'.$opcion.'/'.$depto->nombre.'/'.$key->id.'') }}">
											<h2 class="btn btn-primary">Editar</h2>
										</a>
										<a href="{{ URL::to('/administrador/Info/Del/'.$opcion.'/'.$depto->nombre.'/'.$key->id.'') }}">
											<h2 class="btn btn-danger">Eliminar</h2>
										</a>										
									</div>									
								</div>
								<br>
							@endif
						@else
							<?php $conteo++; ?>
							@if($registro==$conteo)
								<div class="row">
										<div class="col-md-5">
											<img class="img-responsive" src="{{ asset( 'img/'.$key->foto.'') }}" alt="">
										</div>
										<div class="col-md-7">									
											<h2 class="titul">Imagen sin titulo</h2>										
											<p>No hay descripcion</p>
											<a href="{{ URL::to('/administrador/Info/Edit/'.$opcion.'/'.$depto->nombre.'/'.$key->id.'') }}">
												<h2 class="btn btn-primary">Editar</h2>
											</a>
											<a href="{{ URL::to('/administrador/Info/Del/'.$opcion.'/'.$depto->nombre.'/'.$key->id.'') }}">
												<h2 class="btn btn-danger">Eliminar</h2>
											</a>										
										</div>									
									</div>
									<br>
							@endif
						@endif						
					@endforeach
				@endforeach
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif		
		<div>{{$Info->links()}}</div>
	</div>
@stop