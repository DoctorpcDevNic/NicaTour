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
          <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Gastronomia#descripcion') }}"><img src="{{ asset('img/comedor.png') }}">
          <h3>Gastronomia</h3></a>
        </div>
      </div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro tesoros">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Tesoros Coloniales#descripcion') }}">
          <img src="{{ asset('img/tesoros.png') }}">
          <h3>Tesoros</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro danza">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Danza#descripcion') }}">
          <img src="{{ asset('img/bailes.png') }}">
          <h3>Danza</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro artesania">
         <a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Artesania#descripcion') }}">
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
		<div class="col-md-8 col-xs-8">
			<div class="youtube">
				<div class="videoWrapper">
					<embed src="http://www.youtube.com/v/{{$depto->youtube}}">
				</div>			
				<h3>NICATOUR You Tube</h3>
			</div>	
		</div>
		<div class="col-md-4 col-xs-4" style="padding:0 5px 0 5px">
			<div class="operadora">
				<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/locales/ToursOperadoras') }}">
					<img src="{{ asset('img/operadora.png') }}">
					<h3 class="hidden-xs">Tours Operadora</h3>
				</a>
			</div>
			<div class="row" style="padding: 3px 0">
				<div class="col-md-6 col-xs-6 gasolina">
					<a href="{{ URL::to('es/departamentos/Gasolineras/'.$depto->nombre) }}">
						<img src="{{ asset('img/gasolina.png') }}">
						<h3 class="hidden-xs">Gasolinera</h3>
					</a>
				</div>
				<div class="col-md-6 col-xs-6" style="padding:0">
					<div class="clima">
						<h3>{{$clima->temperatura}} C°</h3>
						<p>{{$clima->nombre}}</p>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-xs-4" style="padding:0 0 0 10px">
			<div class="restaurante">
				<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/locales/Restaurantes') }}">
					<img src="{{ asset('img/restaurante.png') }}" alt="">
					<h3>Restaurantes</h3>
				</a>
			</div>
		</div>
		<div class="col-md-4 col-xs-4" style="padding:0 0 0 5px">
			<div class="hotel">
				<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/Hoteles') }}">
					<img src="{{ asset('img/hotel.png') }}">
					<h3>Hoteles</h3>
				</a>
			</div>
		</div>
		<div class="col-md-4 col-xs-4" style="padding:0 5px 0 5px">
			<div class="transporte">
				<a href="{{ URL::to('es/departamentos/'.$depto->nombre.'/locales/Traslado') }}">
					<img src="{{ asset('img/transporte.png') }}">
					<h3 class="hidden-xs">Traslado</h3>
				</a>
			</div>
		</div>
	</div>
</div>
@stop








