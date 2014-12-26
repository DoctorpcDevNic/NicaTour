<?php
  /*$json_string = file_get_contents("http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NK/Managua.json");
  $parsed_json = json_decode($json_string);
  $location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
  $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};
  $icono = $parsed_json->{'current_observation'}->{'icon_url'};
  $altura = $parsed_json->{'current_observation'}->{'observation_location'}->{'elevation'};
  $humedad = $parsed_json->{'current_observation'}->{'relative_humidity'};*/
?>
@extends('templates.maintemplate')
@section('informacion')

<div class="container">

	<div class="infomain">
		<div class="canal">
			<img src="{{ asset('img/video.png') }}" class="img-responsive">
			<h3>NICATOUR YouTube</h3>
		</div>		
		<div class="row">
			<div class="col-md-4 col-xs-4 clima">
				<h2> <?php /*echo $temp_c; */?> c°</h2>
				<p><?php/* echo $location;*/ ?></p>
			</div>
			<div class="col-md-4 col-xs-4 cambio">
				<h2><img src="{{ asset('img/cambio.png')  }}"></h2>
				<h4>
					<p class="hidden-xs">Tipo de cambio:</p>
					<p class="hidden-md">Cambio</p>
					<p>26.22 C$ por C$1</p>
				</h4>
				<p class="bordercambio"></p>
			</div>
			<div class="col-md-4 col-xs-4 contact">
				<img src="{{ asset('img/ntalogo.png') }}" class="img-responsive">
				<p>Contactenos</p>
			</div>
		</div>
	</div>


	<h2 class="titul wow tada"   data-wow-iteration="5">
		<span>todo para </span> tu estadia!!!
	</h2>	

	<div class="items">
		<div class="item1">
			<img src="{{ asset('img/item1.jpg') }}" class="img-responsive">
			<h2 class="titul1 wow bounceIn" >
				<p>Este verano no te lo puedes perder</p>				
			</h2>
			<h2 class="titul2 wow bounceIn">
				<span>Summer Fest</span><p class="hidden-xs">en las maravillosas playas de San Juan del Sur</p>
			</h2>
		</div>
		<div class="item2">
			<img src="{{ asset('img/item2.jpg') }}" class="img-responsive">
			<h2 class="titul1 wow bounceInDown">
				<span>15 de abril</span><br>
				<p>El obispo de granada, Monseñor Jorge Solórzano</p>
			</h2>
			<h2 class="titul2 hidden-xs wow bounceInDown">
				<p>se sintió muy contento al ver que el fervor de las comunidades de las isletas de Granada se mantiene vivo...</p>
			</h2>
		</div>
		<div class="item3">
			<img src="{{ asset('img/item3.jpg') }}" class="img-responsive">
			<h2 class="titul1 wow lightSpeedIn">
				<span>Torneo Deportivo de Pesca,</span><br>
				<p>si te gustan los retos </p>
			</h2>
			<h2 class="titul2 hidden-xs wow lightSpeedIn">
				<p>Estás listo para <span>Pescar?</span></p>
			</h2>
		</div>
		<div class="item4">
			<img src="{{ asset('img/item4.jpg') }}" class="img-responsive">
			<h2 class="titul1">
				<p>Toda la naturaleza es como un arte <br> desconocido del hombre</p>
			</h2>
			<h2 class="titul2 hidden-xs wow bounceInLeft">
				<span>Maravilloso desove, </span>
				<p>de tortuga Paslama en playa <br> la Flor</p>
			</h2>
		</div>
	</div>
</div>
@stop