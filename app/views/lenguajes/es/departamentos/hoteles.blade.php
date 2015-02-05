@extends('templates.departamentotemplate')

@section('titulo')
Hoteles en {{$depto->nombre}} - Nicaragua Tour
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
			<h2>Hoteles</h2>
			<div class="busqueda">
				{{ Form::open(array('onsubmit' => 'return false', 'id' => 'busqueda')) }}
				  <div class="col-sm-4">
				  	<div class="input-group">
				  		<input class="form-control" type="text" name="Buscartxt" id="nombre" value="" placeholder="Buscar hotel..."/>
				  		<span class="input-group-btn">
				  			<input class="btn btn-default" type="button" href="javascript:;" onclick="realizaProceso($('#nombre').val());return false;" value="Buscar"/>
				  		</span>
				  	</div>
				  </div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@if(!count($Hoteles)==0)
		<div class="row" id="listahoteles">
			@foreach($Hoteles as $key)
				<div class="col-sm-6 col-xs-12 hotels">
					<div class="col-xs-12 hotelestitul">
						<h3>{{ $key->nombre }}</h3>
						<img class="hidden-xs" src="{{ asset('img/hotel-01.png') }}">
					</div>
					<div class="col-xs-12 hotdescripcion">
						<p><i class="fa fa-phone fa-fw"></i>{{ $key->telefono }}</p>
						<p><i class="fa fa-map-marker fa-fw"></i>{{$depto->nombre}}, {{ $key->municipio }}</p>
						<p><i class="fa fa-search fa-fw"></i>{{ $key->direccion }}</p>
					</div>		
				</div>
			@endforeach
			<div class="text-center">{{$Hoteles->links()}}</div>
		</div>	
	@else
		<div class="row">
			<h2 class="titul">No hay hoteles disponibles para mostrar</h2>
		</div>
	@endif
	<div class="row" id="resultado">
		
	</div>
@stop
@section('Scripts')
<script type="text/javascript">
       function realizaProceso(nombre){
        if(nombre!=""){
        	document.getElementById("listahoteles").style.display='none';
        	document.getElementById("resultado").style.display='block';
        	var parametros = {
                "nombre": nombre,
                "depto": {{$depto->id}},
                "deptonombre": <?php echo "\"".$depto->nombre."\""; ?>,
        		};
        	$.ajax({
                data:  parametros,
                url:   '{{ URL::to('/es/departamentos/Hoteles/Buscar') }}',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (data) {
                    var dhtml="";
                    var alerta='<br><div class="col-sm-4 col-sm-offset-4"><div class="alert alert-info" role="alert">'+ data.datos.length+' '+ data.sms+' "'+data.resultado+'"</div></div>';
                        for (datas in data.datos) {
                          dhtml+='<div class="col-sm-6 col-xs-12 hotels">';
                          dhtml+='	<div class="col-xs-12 hotelestitul">';
                          dhtml+=' 		<h3 class="titul">'+data.datos[datas].nombre+'</h3>';
                          dhtml+='		<img class="hidden-xs" src="{{ asset('img/hotel-01.png') }}">';
                          dhtml+='	</div>';
                          dhtml+='	<div class="col-xs-12 hotdescripcion">';
                          dhtml+=' 		<p><i class="fa fa-phone fa-fw"></i>'+data.datos[datas].telefono+'</p>';
                          dhtml+=' 		<p><i class="fa fa-map-marker fa-fw"></i>'+data.datos[datas].municipio+', '+data.deptonombre+'</p>';
                          dhtml+=' 		<p><i class="fa fa-search fa-fw"></i>'+data.datos[datas].direccion+'</p>';
                          dhtml+='	</div>';
                          dhtml+='</div>';
                        };
                    
                    $("#resultado").html(alerta+dhtml);
                }
        	});
        }
        else{
        	document.getElementById("listahoteles").style.display='block';
        	document.getElementById("resultado").style.display='none';
        }
}
</script>
@stop