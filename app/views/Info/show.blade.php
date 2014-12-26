@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Cultura Departamental - {{$opcion}}</h2>
		<div class="row">
		@if(!count($Info)==0)		
			@foreach($depto as $value)
				@foreach($Info as $key)
					@if($key->id_dpto==$value->id)
						<?php $value->id++; ?>
						<div class="col-md-4">
						<div>
							<img class="img-responsive" src="{{ asset( 'img/'.$key->foto.'') }}" alt="">
						</div>
							<a href="{{ URL::to('/administrador/Info/Show/'.$opcion.'/'.$value->nombre.'') }}"><h2 class="titul">{{$value->nombre}}</h2></a>
						</div>																		
					@endif
				@endforeach
			@endforeach
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
		</div>
	</div>
@stop