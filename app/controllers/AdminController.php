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
		//Añadde  una imagen al Slider principal departamental
			$file="no_img.png";

			$Slider = new detalleslider();

			$Slider->id_dpto = Input::get('departamento');

			$depto=DB::table('deptos')			
				->where('id',$Slider->id_dpto)
				->first();

			if(Input::hasFile('archivo')) {
		       	Input::file('archivo')->move('img/'.$depto->nombre.'', Input::file("archivo")->getClientOriginalName());
		       	$file = $depto->nombre.'/'.Input::file("archivo")->getClientOriginalName();
	     	}

	     	$Slider->img = $file;

	     	if($Slider->save()){	     			
				Session::flash('message', 'Imagen Agregada Correctamente');
				return Redirect::to('administrador/Slider/Show/'.$depto->nombre.'');
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
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$file="no_img.png";

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
		       	Input::file('archivo')->move('img/'.$depto->nombre, Input::file("archivo")->getClientOriginalName());
		       	$file = $depto->nombre.'/'.Input::file("archivo")->getClientOriginalName();
	     	} 
	     	
	     	$Info->foto = $file;

	     	if($Info->save()){	     			
				Session::flash('message', 'Imagen Agregada Correctamente');
				
				return Redirect::to('administrador/Info/Edit/'.$opcion->tipo.'/'.$depto->nombre.'/'.$Info->id);
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

	public function InfoUpdate($opcion, $departamento, $id)
	{
		//Actualiza la descripcion de una foto		

		$Descripcion = descripcioncultura::find($id);		

		$Descripcion->titulo=Input::get('titulo');

		$Descripcion->texto=Input::get('texto');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Descripcion Actualizada');
				return Redirect::back();
			}

	}

	public function InfoUpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen
		$General=fotocultura::find($id);
		$General->id_tipo=Input::get('tipo');
		$General->id_depto=Input::get('departamento');
		$Descripciones=DB::table('descripcioncultura')
			->where('id_foto',$id)
			->get();

		if(!count($Descripciones)==0){
			foreach ($Descripciones as $key) {
				$traduccion=descripcioncultura::find($key->id);
				$traduccion->id_depto=Input::get('departamento');
				$traduccion->id_tipo=Input::get('tipo');
				$traduccion->save();
			}
		}
		$info=DB::table('tipoinfo')
			->where('id',$General->id_tipo)
			->first();

		$depto=DB::table('deptos')
			->where('id',$General->id_depto)
			->first();

		if($General->save()){
			Session::flash('message','Informacion general actualizada');
			return Redirect::to('administrador/Info/Edit/'.$info->tipo.'/'.$depto->nombre.'/'.$id);
		}
	}

	public function InfoTraduccion($idioma, $id)
	{
		//Añade una descripcion o traduccion
		$foto= fotocultura::find($id);
		$Descripcion= new descripcioncultura();
		$Descripcion->id_foto=$id;
		$Descripcion->id_idioma=$idioma;
		$Descripcion->id_depto=$foto->id_depto;
		$Descripcion->id_tipo=$foto->id_tipo;
		$Descripcion->titulo=Input::get('titulo');
		$Descripcion->texto=Input::get('texto');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Traduccion Agregada');
				return Redirect::back();
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
			Session::flash('message','Video de actualizado');
			return Redirect::back();
		}
	}

}
