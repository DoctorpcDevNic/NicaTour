@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Calendario Turistico</h2>
		<div class="row">
		@if(!count($Eventos)==0)		
			@foreach($depto as $value)
				@foreach($Eventos as $key)
					@if($key->id_depto==$value->id)
						<?php $value->id+=17; ?>
						<div class="col-md-4 col-sm-6">						
							<a href="{{ URL::to('/administrador/Calendario/Show/'.$value->nombre.'') }}"><h2 class="titul">{{$value->nombre}}</h2></a>
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