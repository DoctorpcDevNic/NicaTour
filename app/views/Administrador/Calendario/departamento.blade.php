@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Eventos en {{$depto->nombre}}</h2>
		<div class="form-group">
		<br>
			@if(Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
		</div>
		@if(!count($Eventos)==0)
			<div class="row">	
				@foreach($Eventos as $key)
					<div class="col-md-6">									
						<h2 class="titul">{{$key->nombre}}</h2>
						<p>{{$key->municipio}}</p>
						<?php $fecha=new DateTime($key->fecha);  ?>
						<p>{{$fecha->format('d/m/y')}}</p>
						<p>{{$key->direccion}}</p>
						<a href="{{ URL::to('/administrador/Calendario/Edit/'.$depto->nombre.'/'.$key->id.'') }}">
							<h2 class="btn btn-primary">Editar</h2>
						</a>
						<a href="{{ URL::to('/administrador/Calendario/Del/'.$key->id.'') }}">
							<h2 class="btn btn-danger">Eliminar</h2>
						</a>										
					</div>
				<br>
				@endforeach
			</div>
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
		<div>{{$Eventos->links()}}</div>
	</div>
@stop