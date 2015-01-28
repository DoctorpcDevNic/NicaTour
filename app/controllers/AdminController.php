<?php

class AdminController extends \BaseController {

	//Inicio Funciones Slider Principal
	public function SliderDpto()	
	{
		//Muestra todos los departamentos que tienen imagen en el Slider departamental
		$depto=DB::table('deptos')->get();

		$Slider=DB::table('detalleslider')->get();

		$conteo=1;

		return View::make('Administrador.SliderDpto.show', array('depto'=>$depto, 'Slider'=>$Slider));
	}

	public function SliderDptoShow($departamento)
	{
		//Muestra todas las imagenes del departamento seleccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$Slider=DB::table('detalleslider')
			->where('id_dpto',$depto->id)
			->paginate(6);		

		return View::make('Administrador.SliderDpto.edit', array('depto'=>$depto, 'Slider'=>$Slider));
	}

	public function SliderDptoAdd()
	{
		//Muestra la vista para añadir una imagen al Slider principal departamental
		$depto=DB::table('deptos')
			->get();

		return View::make('Administrador.SliderDpto.add', array('depto'=>$depto));
	}

	public function SliderDptoNew()
	{		
		$reglas= array(
				'archivo'=> 'required|image|max:350',
			);
		$alertas = array(
            'archivo.required' => 'La imagen no puede estar vacia.',
            'archivo.image' => 'El archivo seleccionado no es correcto, asegurese de seleccionar un formato de archivo de imagen compatible (jpeg,bmp,png)',
            'archivo.max' => 'La imagen es demasiado pesada, asegurese de no sobrepasar los 350kb',
        );
        $validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{

			$file="no_img.png";

				$Slider = new detalleslider();

				$Slider->id_dpto = Input::get('departamento');

				$depto=DB::table('deptos')			
					->where('id',$Slider->id_dpto)
					->first();

				if(Input::hasFile('archivo')) {
			       	Input::file('archivo')->move('img/'.$depto->nombre.'','Slider-'.$depto->nombre.'-'.date('j-n-y').'-'.Input::file("archivo")->getClientOriginalName());
			       	$file = $depto->nombre.'/'.'Slider-'.$depto->nombre.'-'.date('j-n-y').'-'.Input::file("archivo")->getClientOriginalName();
		     	}

		     	$Slider->img = $file;

		     	if($Slider->save()){	     			
					Session::flash('message', 'Imagen Agregada Correctamente');
					return Redirect::to('administrador/Slider/Show/'.$depto->nombre.'');
				}
		}
	}

	public function SliderDptoDel($departamento, $id)
	{
		//Elimina una imagen del Slider de un departamento
		$Slider=detalleslider::find($id);

		$Slider->delete();

		File::delete('img/'.$Slider->img);
		Session::flash('mensaje','Imagen eliminada');

		return Redirect::to('administrador/Slider/Show/'.$departamento.'');
	}
	//Fin Slider Departamental


	//Inicio Funciones para Informacion gastronomia, artesanias, etc.
	public function Info($opcion)
	{
		//Muestra los departamentos que tiene informacion del tipo seleccionada
		$depto=DB::table('deptos')
			->get();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('fotocultura')
			->where('id_tipo',$tipo->id)
			->get();

		return View::make('Administrador.Info.show', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion));
	}

	public function InfoDepartamento($opcion,$departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('fotocultura')
			->where('id_tipo',$tipo->id)
			->where('id_depto',$depto->id)
			->paginate(5);

		$Descripcion=DB::table('descripcioncultura')
			->where('id_depto',$depto->id)
			->where('id_tipo',$tipo->id)
			->get();		

		return View::make('Administrador.Info.departamento', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion));
	}

	public function InfoEdit($opcion,$departamento,$id)
	{
		//Muestra la vista para editar la informacion de la foto seleccionada
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$opcion)
			->first();

		$DptosAll=DB::table('deptos')
			->get();

		$TipoCultura=DB::table('tipoinfo')
			->get();

		$Info=DB::table('fotocultura')
			->where('id',$id)
			->where('id_tipo',$tipo->id)
			->where('id_depto',$depto->id)
			->first();

		$Descripcion=DB::table('descripcioncultura')
			->where('id_foto',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Info.edit', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll, 'TipoCultura'=>$TipoCultura));
	}

	public function InfoAdd()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('deptos')
			->get();

		$tipo=DB::table('tipoinfo')
			->get();

		return View::make('Administrador.Info.add', array('depto'=>$depto, 'tipo'=>$tipo));
	}

	public function InfoNew()
	{	
		$reglas= array(
				'archivo'=> 'required|image|max:350',
				'titulo' => 'required|min:8|max:50',
				'texto'=> 'required|min:25|max:650'
			);
		$alertas = array(
            'archivo.required' => 'La imagen no puede estar vacia.',
            'archivo.image' => 'El archivo seleccionado no es correcto, asegurese de seleccionar un formato de archivo de imagen compatible (jpeg,bmp,png)',
            'archivo.max' => 'La imagen es demasiado pesada, asegurese de no sobrepasar los 350kb',
            'titulo.required' => 'El titulo de la imagen no puede estar vacio',
			'titulo.min' => 'El titulo de la imagen, debe tener como minimo :min caracteres',
			'titulo.max' => 'El titulo de la imagen, no debe tener mas de :max caracteres',
			'texto.required' => 'La descripcion de la imagen no puede estar vacia',
			'texto.min' => 'La descripcion de la imagen, debe tener como minimo :min caracteres',
			'texto.max' => 'La descripcion de la imagen, no debe tener mas de :max caracteres',
        );
        $validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{

			//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion			

			$Info = new fotocultura();

			$Info->id_tipo = Input::get('tipo');

			$Info->id_depto = Input::get('departamento');

			$depto=DB::table('deptos')			
				->where('id',$Info->id_depto)
				->first();

			$opcion=DB::table('tipoinfo')			
				->where('id',$Info->id_tipo)
				->first();

			if(Input::hasFile('archivo')) {
		       	Input::file('archivo')->move('img/'.$depto->nombre, $opcion->tipo.'-'.$depto->nombre.'-'.date('j-n-y').'-'.Input::file("archivo")->getClientOriginalName());
		       	$file = $depto->nombre.'/'.$opcion->tipo.'-'.$depto->nombre.'-'.date('j-n-y').'-'.Input::file("archivo")->getClientOriginalName();
	     	} 
	     	
	     	$Info->foto = $file;

	     	if($Info->save()){
	     		$Descripcion= new descripcioncultura();
	     		$Descripcion->id_depto=$Info->id_depto;
				$Descripcion->id_tipo=$Info->id_tipo;
				$Descripcion->id_foto=$Info->id;
				$Descripcion->id_idioma=1;
				$Descripcion->titulo=Input::get('titulo');
				$Descripcion->texto=Input::get('texto');

				if($Descripcion->save()){	     			
						Session::flash('message', 'Informacion Cultura sobre '.$opcion->tipo.' de '.$depto->nombre. ' agregado correctamente');
						return Redirect::to('administrador/Info/Edit/'.$opcion->tipo.'/'.$depto->nombre.'/'.$Info->id);
					}
			}
		}
	}

	public function InfoDel($opcion, $departamento, $info)
	{
		//Elimina primero todas las descripciones y luego la foto
		$descripciones=DB::table('descripcioncultura')
			->where('id_foto',$info)
			->get();

		if(!count($descripciones)==0){
			foreach ($descripciones as $key) {
				$traduccion=descripcioncultura::find($key->id);
 
				$traduccion->delete();
			}
		}
		$foto=fotocultura::find($info);
		File::delete('img/'.$foto->img);
		$foto->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}

	public function InfoUpdate($idioma, $id)
	{
		$reglas= array(
				'titulo'.$id => 'required|min:8|max:50',
				'texto'.$id => 'required|min:25|max:650'
			);
		$alertas = array(
            'titulo'.$id.'.required' => 'El titulo de la imagen no puede estar vacio',
			'titulo'.$id.'.min' => 'El titulo de la imagen, debe tener como minimo :min caracteres',
			'titulo'.$id.'.max' => 'El titulo de la imagen, no debe tener mas de :max caracteres',
			'texto'.$id.'.required' => 'La descripcion de la imagen no puede estar vacia',
			'texto'.$id.'.min' => 'La descripcion de la imagen, debe tener como minimo :min caracteres',
			'texto'.$id.'.max' => 'La descripcion de la imagen, no debe tener mas de :max caracteres',
        );
        $validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){
			Session::flash('alerta', 'No se ha podido actualizar la traduccion en '.$idioma);
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{
			//Actualiza la descripcion de una foto		

			$Descripcion = descripcioncultura::find($id);		

			$Descripcion->titulo=Input::get('titulo'.$id);

			$Descripcion->texto=Input::get('texto'.$id);

			if($Descripcion->save()){	     			
					Session::flash('message', 'Traduccion en '.$idioma.' actualizada correctamente');
					return Redirect::back();
				}
		}

	}

	public function InfoUpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen

		$reglas= array(
				'titulo' => 'required|min:8|max:50',
				'texto'=> 'required|min:25|max:650'
			);
		$alertas = array(
            'titulo.required' => 'El titulo de la imagen no puede estar vacio',
			'titulo.min' => 'El titulo de la imagen, debe tener como minimo :min caracteres',
			'titulo.max' => 'El titulo de la imagen, no debe tener mas de :max caracteres',
			'texto.required' => 'La descripcion de la imagen no puede estar vacia',
			'texto.min' => 'La descripcion de la imagen, debe tener como minimo :min caracteres',
			'texto.max' => 'La descripcion de la imagen, no debe tener mas de :max caracteres',
        );
        $validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{

			$General=fotocultura::find($id);
			$General->id_tipo=Input::get('tipo');
			$General->id_depto=Input::get('departamento');
			$Descripciones=DB::table('descripcioncultura')
				->where('id_foto',$id)
				->get();

			if(!count($Descripciones)==0){
				foreach ($Descripciones as $key) {
					if($key->id_idioma==1){
						$traduccion=descripcioncultura::find($key->id);
						$traduccion->id_depto=Input::get('departamento');
						$traduccion->id_tipo=Input::get('tipo');
						$traduccion->titulo=Input::get('titulo');
						$traduccion->texto=Input::get('texto');
						$traduccion->save();
					}
					else{
						$traduccion=descripcioncultura::find($key->id);
						$traduccion->id_depto=Input::get('departamento');
						$traduccion->id_tipo=Input::get('tipo');
						$traduccion->save();
					}
				}
			}
			$info=DB::table('tipoinfo')
				->where('id',$General->id_tipo)
				->first();

			$depto=DB::table('deptos')
				->where('id',$General->id_depto)
				->first();

			if($General->save()){
				Session::flash('message','Informacion general actualizada correctamente');
				return Redirect::to('administrador/Info/Edit/'.$info->tipo.'/'.$depto->nombre.'/'.$id);
			}

		}

	}

	public function InfoTraduccion($idioma, $id)
	{
		$lenguaje=DB::table('idioma')
					->where('id',$idioma)
					->first();

		$reglas= array(
				'titulo'.$idioma => 'required|min:8|max:50',
				'texto'.$idioma => 'required|min:25|max:650'
			);
		$alertas = array(
            'titulo'.$idioma.'.required' => 'El titulo de la imagen no puede estar vacio',
			'titulo'.$idioma.'.min' => 'El titulo de la imagen, debe tener como minimo :min caracteres',
			'titulo'.$idioma.'.max' => 'El titulo de la imagen, no debe tener mas de :max caracteres',
			'texto'.$idioma.'.required' => 'La descripcion de la imagen no puede estar vacia',
			'texto'.$idioma.'.min' => 'La descripcion de la imagen, debe tener como minimo :min caracteres',
			'texto'.$idioma.'.max' => 'La descripcion de la imagen, no debe tener mas de :max caracteres',
        );
        $validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){
			Session::flash('alerta', 'No se ha podido agregar la traduccion en '.$lenguaje->nombre);
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}
		
		else{
			//Añade una descripcion o traduccion
			$foto= fotocultura::find($id);
			$Descripcion= new descripcioncultura();
			$Descripcion->id_foto=$id;
			$Descripcion->id_idioma=$idioma;
			$Descripcion->id_depto=$foto->id_depto;
			$Descripcion->id_tipo=$foto->id_tipo;
			$Descripcion->titulo=Input::get('titulo'.$idioma);
			$Descripcion->texto=Input::get('texto'.$idioma);

			if($Descripcion->save()){	     			
					Session::flash('message', 'Traduccion en '.$lenguaje->nombre.' agregada correctamente');
					return Redirect::back();
				}
		}
	}
	//Fin funciones de gastronomia, artesanias, etc

	public function Youtube(){

		$departamentos=DB::table('deptos')
			->paginate(6);
		return View::make('Administrador.Youtube.show', array('departamentos'=>$departamentos));
	}

	public function YoutubeUpdate(){
		$Video=deptos::find(Input::get('departamento'));
		$Video->youtube=Input::get('video');
		if($Video->save()){
			Session::flash('message','Video de '.$Video->nombre.' actualizado');
			return Redirect::back();
		}
	}

	public function SEO(){

		$departamentos=DB::table('deptos')
			->get();
		return View::make('Administrador.SEO.update', array('departamentos'=>$departamentos));
	}

	public function SEOUpdate(){
		$SEO=deptos::find(Input::get('departamento'));
		$SEO->keywords=Input::get('keywords');
		$SEO->descripcion=Input::get('descripcion');
		if($SEO->save()){
			Session::flash('message','Etiquetas de '.$SEO->nombre.' actualizadas');
			return Redirect::back();
		}
	}

}
