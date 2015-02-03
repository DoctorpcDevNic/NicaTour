<!DOCTYPE html>
<html lang="es">
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    @yield('seo')

    <!-- Bootstrap -->
    {{ HTML::style('css/departamento.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('font-awesome-4.1.0/css/font-awesome.min.css') }}

    <!--Other Slider -->
    {{ HTML::style('css/slick.css') }}
    {{ HTML::style('css/monokai.min.css') }}
    {{ HTML::style('css/styleSlidePost.css') }}

    {{ HTML::style('css/camera.css') }}


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <header>
    <div class="slider">
     @yield('SliderDpto')
    </div>
<style>
  #top li ul, #top ul li {width:300px;} /* Ancho del contenedor de las subpestañas */
  #top ul li a {
  text-align:left;
  padding: 6px 15px;
  font-size:13px;
  font-weight:normal;
  text-transform:none;
  font-family:Arial, sans-serif;
  border:none;
  }
  #top li ul {
  z-index:100;
  position: absolute;
  display: none;
  background-color:#1a3352; /* Color de fondo del contenedor de las subpestañas */
  margin-left:-80px;
  padding:10px 0;
  border-radius: 0px 0px 6px 6px;
  box-shadow:0 2px 2px rgba(0,0,0,0.6);
  filter:alpha(opacity=87);
  opacity:.87;
  }
  #top li ul li {
  width:150px; /* Ancho de cada subpestaña */
  float:left;
  margin:0;
  padding:0;
  }
  #top li:hover ul, #top li.hvr ul {display: block;}
  #top li:hover ul a, #top li.hvr ul a {
  color:#ddd; /* Color del texto de los submenús */
  background-color:transparent;
  text-decoration:none;
  }
  #top ul a:hover {
  text-decoration:underline!important;
  color:#c5fa6f !important; /* Color del texto de los submenús al pasar el cursor */
  }
</style>
    <!--menu -->
    <nav class="menudepto navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>           
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right" id="top">
            <li><a href="">Nicaragua</a></li>
            <li><a href="" class="dropdown-toggle" data-toggle="dropdown">Departamentos</a>
              <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::to('es/departamentos/Boaco') }}">Boaco</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Carazo') }}">Carazo</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Chinandega') }}">Chinandega</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Chontales') }}">Chontales</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Esteli') }}">Estelí</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Granada') }}">Granada</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Jinotega') }}">Jinotega</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Leon') }}">Leon</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Madriz') }}">Madriz</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Managua') }}">Managua</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Masaya') }}">Masaya</a></li>                        
                    <li><a href="{{ URL::to('es/departamentos/Matagalpa') }}">Matagalpa</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Nueva Segovia') }}">Nueva Segovia</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Rivas') }}">Rivas</a></li>
                    <li><a href="{{ URL::to('es/departamentos/Rio San Juan') }}">Rio San Juan</a></li>
                    <li><a href="{{ URL::to('es/departamentos/RAAN') }}">RAAN</a></li>
                    <li><a href="{{ URL::to('es/departamentos/RAAS') }}">RAAS</a></li>
              </ul>
            </li>
            <li><a href="">Explorar</a></li>
            <li><a href="">Idioma</a></li>
            <li><a href="">contactenos</a></li>
          </ul>
        </div>
      </div>   
    </nav>
    <!--end menu --> 

    <div class="logo">
        <a href="{{ URL::to('/es') }}"><img src="{{ asset('img/logorevistafinareto.png') }}"></a>
    </div> 

    <div class="tiulslider">
      @yield('titulslider')
    </div> 
  </header>

  <div class="menuacerca">
    @yield('infodpto')  
  </div>

    @yield('anuncio')
    
  </div>

  <section class="maincontainer">
    @yield('contenido')
  </section>


  <footer>
    <p>Nicatour Adventure S,A. © 2014 Nicatour Adventure</p>
    <p>Todos los Derechos Reservados. </p>
    <ul class="hidden-xs">
      <li><a href="#">Quienes Somos<span>|</span></a></li>
      <li><a href="#">Contáctenos<span>|</span></a></li>
      <li><a href="#">Cambiar región<span>|</span></a></li>
      <li><a href="#">Términos de Uso<span>|</span></a></li>
      <li><a href="#">Idioma</a></li>
    </ul>
    <p>Designed by <a href="">Doctor PC</a> </p> 
  </footer>


   




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('js/vendor/bootstrap.min.js') }}

    {{ HTML::script('js/vendor/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/jquery-migrate-1.2.1.min.js')}}

    {{ HTML::script('js/scripts.js') }}
    {{ HTML::script('js/slick.js') }}  
    {{ HTML::script('js/main.js') }}  

    {{ HTML::script('js/jquery.mobile.customized.min.js') }}
    {{ HTML::script('js/jquery.easing.1.3.js') }}
    {{ HTML::script('js/camera.js') }}


    <script>
    jQuery(function(){
      
      jQuery('#camera_wrap_2').camera({        
        height: '40%',   
        pagination: false,       
      });
      
    });
  </script>
  @yield('Scripts')
  </body>
</html>