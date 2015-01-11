@extends('templates.departamentotemplate')
@section('titulo')
Nicaragua Tour - {{$opcion}} de {{$dpto->nombre}}
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

@section('anuncio')
  <div class="anuncio">
        <h2 id="descripcion">{{$opcion}}</h2>
  </div>
@stop

@section('titulslider')
	<!--h2>Granada, <span> La gran Sultana</span></h2-->
@stop

@section('infodpto')
  <div class="row">
      <div class="col-md-3 col-xs-3">
        <div class="cuadro gastronomia">
          <a href="{{ URL::to('es/departamentos/'.$dpto->nombre.'/Gastronomia#descripcion') }}"><img src="{{ asset('img/comedor.png') }}">
          <h3>Gastronomia</h3></a>
        </div>
      </div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro tesoros">
         <a href="{{ URL::to('es/departamentos/'.$dpto->nombre.'/Tesoros Coloniales#descripcion') }}">
          <img src="{{ asset('img/tesoros.png') }}">
          <h3>Tesoros</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro danza">
         <a href="{{ URL::to('es/departamentos/'.$dpto->nombre.'/Danza#descripcion') }}">
          <img src="{{ asset('img/bailes.png') }}">
          <h3>Danza</h3></a>
        </div></div>
      <div class="col-md-3 col-xs-3"> 
        <div class="cuadro artesania">
         <a href="{{ URL::to('es/departamentos/'.$dpto->nombre.'/Artesania#descripcion') }}">
          <img src="{{ asset('img/artesania.png') }}">
          <h3>Artesania</h3>
          </a>
        </div></div>
@stop

@section('contenido') 
<div class="container-fluid">
  <div class="row">
  	<div class="col-md-12">
  		<section class="slidercenter degra">
          <div>
            <section id="features" class="">
              <div class="content ">
                <div class="slider responsive2">                                    
                   @foreach($info_detalle as $value)                      
                              @foreach($Descripcion as $key)
                                  @if($key->id_foto==$value->id)
                                  <div>
                                    <div class="container-fluid">
                                      <div class="row">
                                          <div class="col-md-7">
                                            <img src="{{ asset('img/'. $value->foto .'') }}">
                                          </div>
                                          <div class="col-md-5 descripcion">
                                            <h3>{{ $key->titulo }}</h3>
                                            <p>{{ $key->texto }}</p>
                                           </div>
                                      </div>
                                    </div>
                                  </div>
                                  @endif
                              @endforeach
                    @endforeach
              </div>
            </section>
          </div>
        </section>
  	</div>

  	<!--div class="col-md-6">
  		<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime eveniet, veniam quo inventore voluptatum vitae possimus, similique omnis sequi. Veritatis expedita modi, amet soluta dignissimos ea facere quasi asperiores ut.</p>
  	</div-->
  </div>
</div>
@stop






