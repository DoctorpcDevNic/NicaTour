<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
 

Route::get('/', function()
{
	return Redirect::to('/es');
});

Route::get('sitemap', function(){
	$sitemap = App::make("sitemap"); 
	// add items to the sitemap (url, date, priority, freq) 
	
	$sitemap->add(URL::to('/es'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly'); 
	$sitemap->add(URL::to('/contacto'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly'); 
	$sitemap->add(URL::to('/nosotros/mision'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly'); 
	
	$departamentos = DB::table('deptos')->orderBy('created_at', 'desc')->get(); 
	foreach ($departamentos as $key)
		{ 
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Hoteles'),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Restaurantes'),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/Gasolineras'.$key->nombre),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Cultura/Gastronomia'),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Cultura/Tesoros Coloniales'),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Cultura/Danza'),
				$key->updated_at,
				'0.9',
				'daily');
			$sitemap->add(
				URL::to('/es/departamentos/'.$key->nombre.'/Cultura/Artsania'),
				$key->updated_at,
				'0.9',
				'daily');
		} 
	$sitemap->store('xml', 'sitemap');
	return $sitemap->render('xml');

});


	/* ESPAÑOL  */
    Route::group(array('prefix' => 'es'), function () {

    	Route::get('/', function()
		{	$clima=Clima::find(10);
			$depto=deptos::find(10);
			return View::make('inicio',array('clima'=>$clima, 'depto'=>$depto));
		});

	     Route::get('contacto', function(){
				return View::make('nosotros.contacto');
		});	

	    Route::get('nosotros/mision', function(){
			return View::make('nosotros.mision');
		});

		Route::group(array('prefix' => 'departamentos'), function(){

			Route::get('{dpto}/Cultura/{opcion}', 'DepartamentosController@dptoinfo');

			Route::get('{dpto}/Hoteles', 'DepartamentosController@DeptoHoteles');

			Route::get('{dpto}/Restaurantes', 'DepartamentosController@DeptoRest');

			Route::get('{dpto}','DepartamentosController@view');

			Route::get('Gasolineras/{depto}','DepartamentosController@Gasview');
			
		});

	});

	/* INGLES  */
    Route::group(array('prefix' => 'en'), function () {

    	Route::get('/', function()
		{
			return View::make('lenguajes.en.inicio');
		});

	     Route::get('contacto', function(){
				return View::make('nosotros.contacto');
		});	

	    Route::get('nosotros/mision', function(){
			return View::make('nosotros.mision');
		});

		Route::group(array('prefix' => 'departament'), function(){

			Route::get('{dpto}/{opcion}', 'InglesController@dptoinfo');

			Route::get('{dpto}/place/{localdpto}', 'InglesController@dptlocal');

			Route::get('{dpto}','InglesController@view');			
			
		});

	});

	/*Administrador*/
	Route::get('login', array('uses' => 'UsuariosController@viewLogin'));//muestra la interface de login
	Route::post('usuarios/validar', array('uses'=> 'UsuariosController@validateLogin'));// se inicia seccion con username, pass	

	Route::group(array('before' => 'auth'), function()		
	{
		Route::get('usuarios/logout', array('uses'=> 'UsuariosController@getLogout'));		//cerrar secion

	    Route::group(array('prefix' => 'administrador'), function () {

	    	Route::get('/', function()
				{
					return View::make('admin');
				});
	    	Route::group(array('prefix'=>'usuarios'),function(){
	    		
	    		Route::post('/login', array('uses' => 'UsuariosController@register'));		//registra al usuario con sus datos
		
				Route::get('/registrar', array('uses' => 'UsuariosController@viewRegister'));// muestra la interface de registro

				Route::get('/Show', function(){
					$ShowUser=DB::table('usuarios')
						->paginate(6);
					return View::make('usuarios.show',array('ShowUser'=>$ShowUser));
				});

				Route::get('/del/{id}', 'UsuariosController@eliminar');
	    	});   	
	    	
	    	Route::group(array('prefix'=>'Slider'), function(){
	    		
	    		Route::get('/', 'AdminController@SliderDpto');
	    		
	    		Route::get('/Show/{departamento}', 'AdminController@SliderDptoShow');

	    		Route::get('/Add', 'AdminController@SliderDptoAdd');

	    		Route::post('/Add', 'AdminController@SliderDptoNew');

	    		Route::get('/Del/{departamento}/{id}', 'AdminController@SliderDptoDel');
	    	});

	    	Route::group(array('prefix'=>'Info'), function(){

	    		Route::get('/Show/{opcion}','AdminController@Info');
	    		Route::get('/Show/{opcion}/{departamento}','AdminController@InfoDepartamento');
	    		Route::get('/Edit/{opcion}/{departamento}/{id}','AdminController@InfoEdit');
	    		Route::get('/Add','AdminController@InfoAdd');
	    		Route::post('/Add','AdminController@InfoNew');
	    		Route::post('/Update/Traduccion/{idioma}/{id}','AdminController@InfoUpdate');
	    		Route::post('/Update/General/{id}','AdminController@InfoUpdateGeneral');
	    		Route::post('/traduccion/{idioma}/{id}','AdminController@InfoTraduccion');
	    		Route::get('/Del/{opcion}/{departamento}/{info}','AdminController@InfoDel');

	    	});

	    	Route::group(array('prefix'=>'Calendario'), function(){

	    		Route::get('/Show','CalendarioAdmin@ViewDepto');
	    		Route::get('/Show/{departamento}','CalendarioAdmin@Depto');
	    		Route::get('/Edit/{departamento}/{id}','CalendarioAdmin@Edit');
	    		Route::post('/Update/Traduccion/{id}','CalendarioAdmin@Update');
	    		Route::post('/Update/General/{id}','CalendarioAdmin@UpdateGeneral');
	    		Route::post('/traduccion/add/{idioma}/{id}','CalendarioAdmin@Traduccion');
	    		Route::get('/Del/{id}','CalendarioAdmin@EventoDel');
	    		Route::get('/Add','CalendarioAdmin@Add');
	    		Route::post('/Add','CalendarioAdmin@EventoNew');

	    	});    	
	    	
	    	Route::group(array('prefix'=>'Restaurantes'), function(){

	    		Route::get('/Show','RestaurantesAdmin@ViewDepto');
	    		Route::get('/Show/{departamento}','RestaurantesAdmin@Depto');
	    		Route::get('/Edit/{departamento}/{id}','RestaurantesAdmin@Edit');
	    		Route::post('/Update/Traduccion/{id}','RestaurantesAdmin@Update');
	    		Route::post('/Update/General/{id}','RestaurantesAdmin@UpdateGeneral');
	    		Route::post('/traduccion/add/{idioma}/{id}','RestaurantesAdmin@Traduccion');
	    		Route::get('/Del/{id}','RestaurantesAdmin@RestDel');
	    		Route::get('/Add','RestaurantesAdmin@Add');
	    		Route::post('/Add','RestaurantesAdmin@RestNew');

	    	});

	    	Route::group(array('prefix'=>'Hoteles'), function(){

	    		Route::get('/Show','HotelesAdmin@ViewDepto');
	    		Route::get('/Show/{departamento}','HotelesAdmin@Depto');
	    		Route::get('/Edit/{departamento}/{id}','HotelesAdmin@Edit');
	    		Route::post('/Update/Traduccion/{id}','HotelesAdmin@Update');
	    		Route::post('/Update/General/{id}','HotelesAdmin@UpdateGeneral');
	    		Route::post('/traduccion/add/{idioma}/{id}','HotelesAdmin@Traduccion');
	    		Route::get('/Del/{id}','HotelesAdmin@HotelDel');
	    		Route::get('/Add','HotelesAdmin@Add');
	    		Route::post('/Add','HotelesAdmin@HotelsNew');

	    	});

	    	Route::group(array('prefix'=>'Gasolineras'), function(){

	    		Route::get('/Show','GasolinerasAdmin@GasView');
	    		Route::get('/Show/{departamento}','GasolinerasAdmin@GasDpto');
	    		Route::get('/Edit/{departamento}','GasolinerasAdmin@GasEdit');
	    		Route::post('/Update/Traduccion/{id}','GasolinerasAdmin@GasUpdate');
	    		Route::get('/Del/{id}','GasolinerasAdmin@GasDel');
	    		Route::get('/Add','GasolinerasAdmin@GasAdd');
	    		Route::post('/Add','GasolinerasAdmin@GasNew');

	    	});

	    	Route::group(array('prefix'=>'Youtube'), function(){

	    		Route::get('/Show','AdminController@Youtube');
	    		Route::post('/Show','AdminController@YoutubeUpdate');

	    	});

	    	Route::group(array('prefix'=>'SEO'), function(){

	    		Route::get('/Show','AdminController@SEO');
	    		Route::post('/Update','AdminController@SEOUpdate');

	    	});

		});
});


Route::post('contacto/enviar', function(){

	$data = "el usuario ".Input::get('nombre')." ".Input::get('apellido')." <br> con correo: " .Input::get('email')." <br> de la ciudad de: ".Input::get('ciudad')."<br> telefono: ". Input::get('telefono')."<br> escribio este mensaje: <br>".Input::get('mensaje');
		
		
	Mail::send('emails.welcome',  array('data'=>$data), function($message){
	    $message->to('email', 'Cliente')->subject('info contacto');
	});

	Session::flash('message', 'Mensaje Enviado');
	return Redirect::back();
});


