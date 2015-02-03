@extends('templates.departamentotemplate')
@section('titulo')
Nicaragua Tour - Conoce {{$depto->nombre}}
@stop

@section('anuncio')
<div class="anuncio">
      <h2>Calendario Turistico</h2>
    </div>
@stop
@section('SliderDpto')
 <div class="fluid_container">              
    <div class="camera_wrap camera_azure_skin" id="camera_wrap_2">
        @foreach($SliderImg as $value)
        <div data-src="{{ asset( 'img/'.$value->img.'') }}">
            <div class="titulSlideimg">
                 <!--h2>Chinandega, Corinto</h2-->
            </div>
        </div>
        @endforeach
    </div>
 </div>
@stop

@section('titulslider')
	<!--h2>Granada, <span> La gran Sultana</span></h2-->
@stop

@section('infodpto')
	<div class="row">
      <div class="col-md-3 col-xs-3">
        <div class="cuadro gastronomia">
          <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Cultura/Gastronomia#descripcion') }}"><img src="{{ asset('img/comedor.png') }}">
          <h3>Gastronomia</h3></a>
        </div>
      </div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro tesoros">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Cultura/Tesoros Coloniales#descripcion') }}">
          <img src="{{ asset('img/tesoros.png') }}">
          <h3>Tesoros</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro danza">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Cultura/Danza#descripcion') }}">
          <img src="{{ asset('img/bailes.png') }}">
          <h3>Danza</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro artesania">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Cultura/Artesania#descripcion') }}">
          <img src="{{ asset('img/artesania.png') }}">
          <h3>Artesania</h3>
          </a>
        </div></div>
@stop

@section('contenido')
<div class="row"> 
	<div class="col-md-8 infoiz">
		<h3 class="titul2">27 de Agosto</h3>
		<h3>fiesta la sopa de cangrejo,<span>en conmemoracion a la abolicion de la esclavitud</span><a href="#" class="btn btn-success"> leer mas</a> </h3>
		<p><i class="glyphicon glyphicon-calendar"></i></p>
	</div>
	<div class="col-md-4 infoder">
		<div class="event">
			<h3 class="titul3">30 septiembre</h3>
			<p>fiesta en honor a san jeronimo el...</p>			
		</div>
		<div class="event">
			<h3 class="titul3">5 octubre</h3>
			<p>la virgen del rosario, patrona del municipio</p>			
		</div>
		<div class="event">
			<h3 class="titul3">celebrando todo el mes de mayo</h3>
			<p>la mayor expresion cultural y tradicional, se manifiesta en la fiestas del palo de mayo</p>			
		</div>
	</div>
</div>

<div class="sliderdpto">
	<img src="{{ asset('img/item4.jpg') }}">
</div>

<div class="evento">
	<img src="{{ asset('img/item1.jpg') }}">
	<h3 class="titul2">27 de Agosto</h3>
	<h2>Summer Fest, <span> en las maravillosas playas de san juan del sur</span></h2>
</div>

<div class="anuncios">
	<div class="row">
		<div class="col-md-4 col-xs-12" style="padding:0 5px 0 5px">
			<div class="row" style="padding: 3px 0">
				<div class="col-md-12 col-xs-6 hotel">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Hoteles') }}">
						<img src="{{ asset('img/hotel-01.png') }}">
						<h3>Hoteles</h3>
					</a>
				</div>
				<div class="col-md-12 col-xs-6 restaurante">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Restaurantes') }}">
						<img src="{{ asset('img/Restaurante-01.png') }}">
						<h3>Restaurantes</h3>
					</a>
				</div>
				<div class="col-md-12 col-xs-6 gasolina">
					<a href="{{ URL::to('es/departamentos/Gasolineras/'.$depto->nombre) }}">
						<img src="{{ asset('img/gasolina.png') }}">
						<h3>Gasolinera</h3>
					</a>
				</div>
				<div class="col-md-12 col-xs-6 transporte">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre) }}">
						<img src="{{ asset('img/transporte.png') }}">
						<h3>Traslado</h3>
					</a>
				</div>
			</div>
			<div class="operadora">
				<a href="{{ URL::to('es/departamentos/'.$depto->nombre) }}">
					<img src="{{ asset('img/operadora.png') }}">
					<h3>Tours Operadora</h3>
				</a>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="youtube">
					<div class="videoWrapper">
						<embed src="http://www.youtube.com/embed/{{$depto->youtube}}">
					</div>			
					<h3>NICATOUR You Tube</h3>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-3 col-xs-6 clima">
					<img src="{{ asset('img/clima/'.$depto->icono.'.png') }}" alt="">
					<div>
						<h3>{{$depto->temperatura}}° c</h3>
						<p>{{$depto->nombre}}</p>
					</div>
				</div>
				<div class="col-md-3 col-xs-6 policia">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Policia') }}">
						<img src="{{ asset('img/policia-01.png') }}">
						<h3>Policia</h3>
					</a>
				</div>
				<div class="col-md-3 col-xs-6 hospital">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Hospital') }}">
						<img src="{{ asset('img/HOSPITAL-01.png') }}">
						<h3>Hospital</h3>
					</a>
				</div>
				<div class="col-md-3 col-xs-6 bombero">
					<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Bomberos') }}">
						<img src="{{ asset('img/BOMBERO-01.png') }}">
						<h3>Bomberos</h3>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop








