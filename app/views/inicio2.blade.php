@extends('templates.maintemplate')
@section('contenido')
<div class="row">
	<div class="col-md-8 infoiz">
		<h3 class="titul2">27 de Agosto</h3>
		<h3>fiesta la sopa de cangrejo,<span>en conmemoracion a la abolicion de la esclavitud</span><a href="#"> leer mas</a> </h3>
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

<div class="sliderother">
	<div class="content">
          <div class="slider responsive" style="background: #00A7CB">          
             <div><h3><img src="{{ asset('img/cocosyplaya.jpg') }}" alt="Cocos" title="Bilwi"></h3></div>
             <div><h3><img src="{{ asset('img/cocosyplaya.jpg') }}" alt="Cocos" title="Bilwi"></h3></div>
             <div><h3><img src="{{ asset('img/cocosyplaya.jpg') }}" alt="Cocos" title="Bilwi"></h3></div>          
             <div><h3><img src="{{ asset('img/cocosyplaya.jpg') }}" alt="Cocos" title="Bilwi"></h3></div>
             <div><h3><img src="{{ asset('img/cocosyplaya.jpg') }}" alt="Cocos" title="Bilwi"></h3></div>
          </div>
     </div>	       
</div>
<div class="enventmes">
	<img src="{{ asset('img/surf.jpg') }}">
	<h3 class="titul2">27 de agosto</h3>
	<h2>summer fest, <span>en las maravillosas playas de san juan del sur</span></h2>
</div>

<div class="anuncios">
	<div class="row">
		<div class="col-md-8 col-xs-8">
			<img src="{{ asset('img/video.png') }}" class="img-responsive" style="height:18.8em">			
		</div>
		<div class="col-md-4 col-xs-4">
			<img src="{{ asset('img/video.png') }}" class="img-responsive">
			<img src="{{ asset('img/video.png') }}" class="img-responsive">
			<img src="{{ asset('img/video.png') }}" class="img-responsive">			
		</div>
	</div>	
	<div class="row">
		<div class="col-md-4 col-xs-4"><img src="{{ asset('img/video.png') }}" class="img-responsive"></div>
		<div class="col-md-4 col-xs-4"><img src="{{ asset('img/video.png') }}" class="img-responsive"></div>
		<div class="col-md-4 col-xs-4"><img src="{{ asset('img/video.png') }}" class="img-responsive"></div>
	</div>
</div>
@stop