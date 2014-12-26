@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Slider Principal</h2>
		<div class="row">
			@foreach($depto as $value)
				@foreach($Slider as $key)
					@if($key->id_dpto==$value->id)						
							<?php $value->id+=17;?>
							<div class="col-md-4">
							<div>
								<img class="img-responsive" src="{{ asset( 'img/'.$key->img.'') }}" alt="">
							</div>
								<a href="{{ URL::to('/administrador/Slider/Show/'.$value->nombre.'') }}"><h2 class="titul">{{$value->nombre}}</h2></a>
							</div>
					@else

					@endif
				@endforeach
			@endforeach
		</div>
	</div>
@stop