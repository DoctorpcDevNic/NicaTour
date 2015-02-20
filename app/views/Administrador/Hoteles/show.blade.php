@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<div>
		<h3 class="titul">Hoteles</h3>
		<table class="table table-hover" id="HotelesTable">
			<thead>
				<tr>
					<td>Acciones</td>
					<td>Departamento</td>
					<td>Municipio</td>
					<td>Tipo</td>
					<td>Categoria</td>
					<td>Nombre</td>
					<td>Direccion</td>
					<td>Telefono</td>
				</tr>
			</thead>
			<tbody>
				@foreach($Hotels as $value)
					@foreach($depto as $key)
						@if($value->id_depto==$key->id)
						<tr>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										Acciones <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ URL::to('/administrador/Hoteles/Edit/'.$key->nombre.'/'.$value->id) }}">Editar</a></li>
										<li class="divider"></li>
										<li><a href="{{ URL::to('/administrador/Hoteles/Del/'.$value->id) }}">Eliminar</a></li>
									</ul>
								</div>
							</td>
							<td>{{$key->nombre}}</td>
							<td>{{$value->municipio}}</td>
							<td>{{$value->tipo}}</td>
							@if($value->categoria==0)
								<td>Super economico</td>
							@elseif($value->categoria==1)
								<td>Economico</td>
							@elseif($value->categoria==2)
								<td>Normal</td>
							@elseif($value->categoria==3)
								<td>Calidad</td>
							@elseif($value->categoria==4)
								<td>Superior</td>
							@elseif($value->categoria==5)
								<td>Lujo</td>
							@endif
							<td>{{$value->nombre }}</td>
							<td>{{$value->direccion }}</td>
							<td>{{$value->telefono }}</td>
							@endif
						@endforeach
				@endforeach
			</tbody>
		</table>
	</div>
	</div>
@stop
@section('Scripts')
{{ HTML::script('js/jquery.dataTables.min.js') }}
{{ HTML::script('js/dataTables.bootstrap.js') }}
<script type="text/javascript">
	 $('#HotelesTable').dataTable({
        "language": {
            "url": "http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json"
        }
    });
	
</script>
@stop