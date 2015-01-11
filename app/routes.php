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

			Route::get('{dpto}/locales/{localdpto}', 'DepartamentosController@dptlocal');

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
	    		Route::post('/Update/{opcion}/{departamento}/{id}','AdminController@InfoUpdate');
	    		Route::post('/Update/General/{id}','AdminController@InfoUpdateGeneral');
	    		Route::post('/traduccion/{idioma}/{id}','AdminController@InfoTraduccion');
	    		Route::get('/Del/{opcion}/{departamento}/{info}','AdminController@InfoDel');

	    	});    	
	    	
	    	Route::group(array('prefix'=>'Locales'), function(){

	    		Route::get('/Show/{local}','LocalesAdmin@ViewDepto');
	    		Route::get('/Show/{local}/{departamento}','LocalesAdmin@LocalesDpto');
	    		Route::get('/Edit/{local}/{departamento}/{id}','LocalesAdmin@LocalesEdit');
	    		Route::post('/Update/Traduccion/{id}','LocalesAdmin@LocalesUpdate');
	    		Route::post('/Update/General/{id}','LocalesAdmin@LocalesUpdateGeneral');
	    		Route::post('/traduccion/add/{idioma}/{id}','LocalesAdmin@LocalesTraduccion');
	    		Route::get('/Del/{info}','LocalesAdmin@LocalesDel');
	    		Route::get('/Add','LocalesAdmin@LocalesAdd');
	    		Route::post('/Add','LocalesAdmin@LocalesNew');

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


