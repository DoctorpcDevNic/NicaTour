@extends('templates.localestemplate')

@section('contenido')
	@foreach($DetalleInfo as $value)		
			@foreach($Descripcion as $key)
				@if($key->id_infodetalle==$value->id)
					<div class="row">
						<div class="col-md-3 col-xs-5">
							<img class="img-responsive" src="{{ asset('img/'. $value->foto .'') }}" alt="" style="background: aqua;">
						</div>
						<div class="col-md-9 col-xs-7">
							<h3>{{ $key->nombre }}</h3>
							<p>{{ $key->telefono }}</p>
							<p>{{ $key->direccion }}</p>		
						</div>
					</div>
				@endif
			@endforeach		
	@endforeach	
	<div>{{$DetalleInfo->links()}}</div>
@stop