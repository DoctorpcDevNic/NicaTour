<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    	 <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('titulo')</title>
       
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


        <meta name="description" content="Para conocer y sentir" />
        <meta name="keywords" content="Nicaragua, tour, explorar, turismo, aventuras, descubre, comidas, tipicas, danzas, bailes, tradición, hoteles, Managua, ">
        <link rel="canonical" href="http://nicaraguatour.com.ni/">
        <!-- Twitter Card data --> 
        <meta name="twitter:card" value="Para conocer y sentir">

        <!-- Open Graph data --> 
        <meta property="og:title" content="Nicaragua Tour" /> 
        <meta property="og:type" content="website" /> 
        <meta property="og:url" content=" http://nicaraguatour.com.ni/" />
        <meta property="og:image" content="{{asset('img/logo.png')}}" />
        <meta property="og:description" content="Nicaragua Tour, para conocer y sentir." />
        <meta property="og:site_name" content="Nicaragua Tour">
       
		{{ HTML::style('css/main.css') }} 
 
    {{ HTML::style('css/slick.css') }}
		{{ HTML::style('css/monokai.min.css') }}
		{{ HTML::style('css/styleSlidePost.css') }}
        

        <!--PLUGIN -->
		{{ HTML::style('css/bootstrap.min.css') }}

		{{ HTML::style('css/camera.css') }}

    {{ HTML::style('css/animate.css') }}



        
    </head>
    <body>
     <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

       	<header>
       		<!-- slider -->
          <section class="slidermain">
            <div class="fluid_container">              
                  <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                      <div data-src="{{ asset( 'img/cocosyplaya.jpg' )}}">
                          <div class="titulSlideimg">
                             <h2>Bilwi, Puerto Cabezas</h2>
                         </div>
                      </div>
                      <div data-src="{{ asset( 'img/Chinandega.jpg') }}">
                          <div class="titulSlideimg">
                               <h2>Chinandega, Corinto</h2>
                          </div>
                      </div>
                      <div data-src="{{ asset( 'img/sanjuan2.jpg') }}">
                          <div class="titulSlideimg">
                               <h2>San Juan del sur</h2>
                          </div>
                      </div>
                  </div>
            </div>
          
               
            <div class="logo">
              <a href="{{ URL::to('/') }}"><img src="{{ asset( 'img/logorevistafinareto.png' ) }}"></a>
            </div>             
                      
        </section>
        <!-- end slider -->


          	<!-- Menu -->
        	<div class="degra">            
	            <nav class="navbar navbar-default menumain" role="navigation">
	              <!-- MENU MOVIL -->
	              <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                  <span class="sr-only">Nicaragua</span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                  <span class="icon-bar"></span>
	                </button>                
	              </div>

	              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                  <li class="nica dropdown">
	                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Nicaragua <span class="caret"></span></a> 
                      <ul class="dropdown-menu quienes" role="menu">
                        <li><a href="#">About</a></li>       
                        <li><a href="{{ URL::to('es/nosotros/mision') }}">Mision</a></li>       
                        <li><a href="{{ URL::to('es/nosotros/mision') }}">Vision</a></li>       
                        <li><a href="#">Staff</a></li>                       
                      </ul> 
	                    <span><img src="{{ asset('img/guardabarranco.png') }}"></span>
	                  </li>
	                  <li class="about dropdown">
	                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Department <span class="caret"></span></a> 
	                    <ul class="dropdown-menu deptos" role="menu">
                        <li><a href="{{ URL::to('en/departament/Chinandega') }}">Chinandega</a></li>
                        <li><a href="{{ URL::to('en/departament/Esteli') }}">Estelí</a></li>
	                    	<li><a href="{{ URL::to('en/departament/Granada') }}">Granada</a></li>
                        <li><a href="{{ URL::to('en/departament/Leon') }}">Leon</a></li>
                        <li><a href="{{ URL::to('en/departament/Madriz') }}">Madriz</a></li>
                        <li><a href="{{ URL::to('en/departament/Managua') }}">Managua</a></li>
                        <li><a href="{{ URL::to('en/departament/Masaya') }}">Masaya</a></li>                        
                        <li><a href="{{ URL::to('en/departament/Matagalpa') }}">Matagalpa</a></li>
                        <li><a href="{{ URL::to('en/departament/Nueva Segovia') }}">Nueva Segovia</a></li>
                        <li><a href="{{ URL::to('en/departament/RAAS') }}">RAAS</a></li>
                        <li><a href="{{ URL::to('en/departament/Rio San Juan') }}">Rio San Juan</a></li>
                        <li><a href="{{ URL::to('en/departament/Rivas') }}">Rivas</a></li>
	                    </ul>                 
	                  </li>
	                  <li class="explo">
	                    <a href="">Explore</a>                
	                  </li>
	                  <li class="plani">
	                    <a href="#">Reaches anywhere</a>                  
	                  </li>
	                  <li class="len">
	                    <a href="#">Languages</a>                   
	                  </li>
	                   <li class="contac">
	                    <a href="{{ URL::to('es/contacto') }}">Contact</a>                   
	                  </li>
	                </ul>
	              </div>
	            </nav>
        	</div> 
       	</header>
       <!-- End Menu -->	
		  <!--SEGUNDO SLIDER -->
      <section class="slidercenter degra">
        <div>
          <section id="features" class="">
            <div class="content ">
              <div class="slider center">
                <div><h3><img src="{{ asset('img/bailes.jpg') }}"><span>Danzas Típicas</span></h3></div>
                <div><h3><img src="{{ asset('img/leon.jpg') }}"><span>Tesoros Coloniales</span></h3></div>
                <div><h3><img src="{{ asset('img/gastronomia.jpg') }}"><span>Gastronomía</span></h3></div>
                <div><h3><img src="{{ asset('img/leyendas.jpg') }}"><span>Leyendas</span></h3></div>
                <div><h3><img src="{{ asset('img/perhisto.jpg') }}"><span>Personajes Histórico</span></h3></div>               
              </div>
            </div>
          </section>
        </div>
      </section>
      <!-- end segundo slider -->

      <section class="contenidomain">
        @yield('informacion')
      </section>
		

		<footer>
			<p>Política de Privacidad en línea de Nicatour Adventure S,A.v © 2014 Nicatour Adventure</p>
      <p>Todos los Derechos Reservados.</p>
      <ul class="hidden-xs">
        <li>Quienes somos <span>|</span></li>
        <li>Contáctenos <span>|</span></li>
        <li>Cambiar región <span>|</span></li>
        <li>Términos de Uso <span>|</span></li>
        <li>Idioma <span>|</span></li>
        <li>Designed by <a href="http://doctorpc.com.ni/" target="new">Doctor PC</a></li>
      </ul>
      <p class="hidden-md hidden-lg hidden-sm">Designed by <a href="http://doctorpc.com.ni/" target="new">Doctor PC</a></p>
		</footer>

	{{ HTML::script('js/vendor/jquery-1.11.1.min.js') }}
    
    {{ HTML::script('js/vendor/bootstrap.min.js') }}
    {{ HTML::script('js/vendor/bootstrap-hover-dropdown.min.js') }}
    {{ HTML::script('js/jquery-migrate-1.2.1.min.js')}}

    {{ HTML::script('js/jquery.mobile.customized.min.js') }}
    {{ HTML::script('js/jquery.easing.1.3.js') }}
    {{ HTML::script('js/camera.js') }}

    {{ HTML::script('js/scripts.js') }}
    {{ HTML::script('js/slick.js') }}

    {{ HTML::script('js/wow.min.js') }}

     <script>
    jQuery(function(){
      
      jQuery('#camera_wrap_1').camera({        
        height: '40%',   
        pagination: false,       
      });
      
    });
  </script>

  <script>
 new WOW().init();
</script>
      </body>
</html>