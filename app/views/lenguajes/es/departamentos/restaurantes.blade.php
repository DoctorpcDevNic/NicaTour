@extends('templates.departamentotemplate')

@section('titulo')
Restaurantes en {{$depto->nombre}} - Nicaragua Tour
@stop

@section('SliderDpto')
 <div class="fluid_container">              
    <div class="camera_wrap camera_azure_skin" id="camera_wrap_2">
        @foreach($SliderDpto as $value)
        <div data-src="{{ asset( 'img/'.$value->img.'') }}">
            <div class="titulSlideimg">
                 <!--h2>Chinandega, Corinto</h2-->
            </div>
        </div>
        @endforeach
    </div>
 </div>
@stop

@section('contenido')
<div class="row">
	<div class="anuncio">
		<h2>Restaurantes</h2>
	</div>
</div>
	@if(!count($Rest)==0)
		<div class="row">
			@foreach($Rest as $key)
				<div class="col-sm-6 col-xs-6 restaurant">
					<div class="col-xs-12 resttitul">
						<h3>{{ $key->nombre }}</h3>
						<img class="hidden-xs" src="{{ asset('img/Restaurante-01.png') }}">
					</div>
					<div class="col-xs-12 restdescripcion">
						<p><i class="fa fa-phone fa-fw"></i>{{ $key->telefono }}</p>
						<p><i class="fa fa-map-marker fa-fw"></i>{{$depto->nombre}}, {{ $key->municipio }}</p>
						<p><i class="fa fa-search fa-fw"></i>{{ $key->direccion }}</p>
					</div>		
				</div>
			@endforeach
		</div>	
	@else
		<div class="row">
			<h2 class="titul">No hay restaurantes disponibles para mostrar</h2>
		</div>
	@endif
	<div class="text-center">{{$Rest->links()}}</div>
@stop