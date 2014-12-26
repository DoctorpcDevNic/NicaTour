@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Slider Principal {{$depto->nombre}}</h2>		
				@foreach($Slider as $key)
					<div class="row">											
							<div class="col-md-4">
								<div>
									<img class="img-responsive" src="{{ asset( 'img/'.$key->img.'') }}" alt="">
								</div>								
							</div>
							<div class="col-md-8">
								<div>
									<form action="">
										<input type="button" name="eliminar" id="" value="Eliminar" class="btn">
									</form>
								</div>
								<p></p>
							</div>
					</div>
				@endforeach	
		{{$Slider->links()}}
	</div>
@stop
