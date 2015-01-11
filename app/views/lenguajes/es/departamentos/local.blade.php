@extends('templates.departamentotemplate')

@section('titulo')
Nicaragua Tour - {{$localdpto}} en {{$dpto}}
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
	@if(!count($DetalleInfo)==0)
		@foreach($DetalleInfo as $value)		
				@foreach($Descripcion as $key)
					@if($key->id_infodetalle==$value->id)
						<div class="row">
							<div class="col-md-9 col-xs-7">
								<h3>{{ $key->nombre }}</h3>
								<p>{{ $key->telefono }}</p>
								<p>{{ $key->direccion }}</p>		
							</div>
						</div>
					@endif
				@endforeach		
		@endforeach
	@else
		<div class="row">
			<h2 class="titul">No hay {{$localdpto}} disponibles</h2>
		</div>
	@endif
	<div>{{$DetalleInfo->links()}}</div>
@stop