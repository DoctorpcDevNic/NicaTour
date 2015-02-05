@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Slider Principal {{$depto->nombre}}</h2>		
				<div class="row">
					@if(Session::has('mensaje'))
						<div class="alert alert-info">{{ Session::get('mensaje') }}</div>
					@endif
					@foreach($Slider as $key)
							<div class="col-sm-4 col-xs-6 SlideDel">						
									<img class="img-responsive" src="{{ asset( 'img/'.$key->img.'') }}" alt="">							
								<div>
									<a href="{{ URL::to('/administrador/Slider/Del/'.$depto->nombre.'/'.$key->id.'') }}">
										<h2 class="titul">Eliminar</h2>
									</a>
								</div>
							</div>	
					@endforeach
				</div>					
		{{$Slider->links()}}
	</div>
@stop
