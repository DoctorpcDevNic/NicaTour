@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Hoteles en {{$depto->nombre}}</h2>
		<div class="form-group">
		<br>
			@if(Session::has('message'))
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif
		</div>
		@if(!count($Hotels)==0)			
				@foreach($Hotels as $key)					
					<div class="row">
						<div class="col-md-4">
							<img class="img-responsive" src="{{ asset( 'img/restaurante.png') }}" alt="" style="background:red;">
						</div>
						<div class="col-md-8">									
							<h2 class="titul">{{$key->nombre}}</h2>
							<p>{{$key->municipio}}</p>
							<p>{{$key->telefono}}</p>
							<p>{{$key->direccion}}</p>
							<a href="{{ URL::to('/administrador/Hoteles/Edit/'.$depto->nombre.'/'.$key->id.'') }}">
								<h2 class="btn btn-primary">Editar</h2>
							</a>
							<a href="{{ URL::to('/administrador/Hoteles/Del/'.$key->id.'') }}">
								<h2 class="btn btn-danger">Eliminar</h2>
							</a>										
						</div>									
					</div>
					<br>
				@endforeach
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
		<div>{{$Hotels->links()}}</div>
	</div>
@stop