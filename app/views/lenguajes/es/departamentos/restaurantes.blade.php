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
	@if(!count($Rest)==0)
		<div class="row">
			@foreach($Rest as $key)
				<div class="col-md-6 col-xs-6 hoteles">
					<h3>{{ $key->nombre }}</h3>
					<p>{{ $key->telefono }}</p>
					<p>{{$depto->nombre}}, {{ $key->municipio }}</p>
					<p>{{ $key->direccion }}</p>		
				</div>
			@endforeach
		</div>	
	@else
		<div class="row">
			<h2 class="titul">No hay hoteles disponibles para mostrar</h2>
		</div>
	@endif
	<div>{{$Rest->links()}}</div>
@stop