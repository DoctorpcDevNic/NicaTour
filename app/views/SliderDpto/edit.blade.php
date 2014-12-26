@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Slider Principal {{$depto->nombre}}</h2>		
				<div class="row">
					@if(Session::has('mensaje'))
						<div class="alert alert-info">{{ Session::get('mensaje') }}</div>
					@endif
					@foreach($Slider as $key)
						<div class="form-horizontal">
							<div class="col-md-4 col-xs-6">						
								<div class="form-group col-md-12">
									<img class="img-responsive" src="{{ asset( 'img/'.$key->img.'') }}" alt="">
								</div>							
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-4">
										<a href="{{ URL::to('/administrador/Slider/Del/'.$depto->nombre.'/'.$key->id.'') }}" class="btn btn-danger">Eliminar</a>
									</div>
								</div>
							</div>	
						</div>
					@endforeach
				</div>					
		{{$Slider->links()}}
	</div>
@stop
