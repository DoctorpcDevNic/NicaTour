@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Hoteles en {{$depto->nombre}}</h2>
			@if(Session::has('message'))
				<br>
				<div class="form-group">
					<div class="alert alert-info">{{ Session::get('message') }}</div>
				</div>
			@endif
		<div class="row buscar">
		{{ Form::open(array('onsubmit' => 'return false', 'id' => 'busqueda')) }}
		  <div class="col-sm-6 col-sm-offset-6">
		  	<div class="input-group">
		  		<input class="form-control" type="text" name="Buscartxt" id="nombre" value="" placeholder="Buscar hotel..."/>
		  		<span class="input-group-btn">
		  			<input class="btn btn-default" type="button" href="javascript:;" onclick="realizaProceso($('#nombre').val());return false;" value="Buscar"/>
		  		</span>
		  	</div>
		  </div>
		{{ Form::close() }}
		</div>
		@if(!count($Hotels)==0)
			<div class="lista" id="lista">
				@foreach($Hotels as $key)					
					<div class="row">
						<div class="col-sm-3" style="background:red;">
							<img class="img-responsive hidden-xs" src="{{ asset( 'img/hotel-01.png') }}" alt="">
						</div>
						<div class="col-sm-9">
							<h2 class="titul">{{$key->nombre}}</h2>
							<p>{{$key->municipio}}, {{$depto->nombre}}</p>
							<p>{{$key->telefono}}</p>
							<p>{{$key->direccion}}</p>
							<a href="{{ URL::to('/administrador/Hoteles/Edit/'.$depto->nombre.'/'.$key->id) }}">
								<h2 class="btn btn-primary">Editar</h2>
							</a>
							<a href="{{ URL::to('/administrador/Hoteles/Del/'.$key->id) }}">
								<h2 class="btn btn-danger">Eliminar</h2>
							</a>										
						</div>									
					</div>
					<br>
				@endforeach
				<div id="paginacion">{{$Hotels->links()}}</div>
			</div>
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
		<div class="lista" id="resultado">
			
		</div>
	</div>
@stop
@section('Scripts')
<script type="text/javascript">
       function realizaProceso(nombre){
        if(nombre!=""){
        	document.getElementById("lista").style.display='none';
        	document.getElementById("resultado").style.display='block';
        	var parametros = {
                "nombre": nombre,
                "depto": {{$depto->id}},
                "deptonombre": <?php echo "\"".$depto->nombre."\""; ?>,
        		};
        	$.ajax({
                data:  parametros,
                url:   '{{ URL::to('/administrador/Hoteles/Buscar') }}',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (data) {

                    var dhtml="";
                    var alerta='<div class="alert alert-info" role="alert">'+ data.datos.length+' '+ data.sms+' "'+data.resultado+'"</div>';
                        for (datas in data.datos) {
                          dhtml+='<div class="row">';
                          dhtml+='	<div class="col-sm-3" style="background:red;">';
                          dhtml+='		<img class="img-responsive hidden-xs" src="{{ asset( 'img/hotel-01.png') }}" alt="">';
                          dhtml+='	</div>';
                          dhtml+='	<div class="col-sm-9">'
                          dhtml+=' 		<h2 class="titul">'+data.datos[datas].nombre+'</h2>';
                          dhtml+=' 		<p>'+data.datos[datas].municipio+'</p>';
                          dhtml+=' 		<p>'+data.datos[datas].direccion+'</p>';
                          dhtml+=' 		<p>'+data.datos[datas].telefono+'</p>';
                          dhtml+='		<a href="'+data.urleditar+'/'+data.deptonombre+'/'+data.datos[datas].id+'">';
                          dhtml+='			<h2 class="btn btn-primary">Editar</h2>';
                          dhtml+='		</a>'
                          dhtml+='		<a href="'+data.urldel+'/'+data.datos[datas].id+'">';
                          dhtml+='			<h2 class="btn btn-danger">Eliminar</h2>';
                          dhtml+='		</a>'
                          dhtml+='	</div>';
                          dhtml+='</div>';
                          dhtml+='<br>';
                        };
                    
                    $("#resultado").html(alerta+dhtml);
                }
        	});
        }
        else{
        	document.getElementById("lista").style.display='block';
        	document.getElementById("resultado").style.display='none';
        }
}
</script>
@stop