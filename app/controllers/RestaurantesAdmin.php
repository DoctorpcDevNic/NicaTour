<?php

class RestaurantesAdmin extends \BaseController {

	public function ViewDepto()
	{
		//Muestra los departamentos que tienen alguna informacion del tipo seleccionada
		$depto=DB::table('deptos')
			->get();

		$Rest=DB::table('restaurantes')
			->get();

		return View::make('Administrador.Restaurantes.show', array('depto'=>$depto, 'Rest'=>$Rest));
	}

	public function Depto($departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$Rest=DB::table('restaurantes')
			->where('id_depto',$depto->id)
			->paginate(5);		

		return View::make('Administrador.Restaurantes.departamento', array('depto'=>$depto, 'Rest'=>$Rest));

	}

	public function Add()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('deptos')
			->get();

		return View::make('Administrador.Restaurantes.add', array('depto'=>$depto));
	}

	public function RestNew()
	{
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$Rest = new restaurantes();

			$Rest->id_depto = Input::get('departamento');

			$Rest->municipio = Input::get('municipio');

			$Rest->nombre = Input::get('nombre');

			$Rest->telefono = Input::get('telefono');

			$Rest->direccion = Input::get('direccion');

			$depto=DB::table('deptos')			
				->where('id',$Rest->id_depto)
				->first();

	     	if($Rest->save()){	     			
				Session::flash('message', 'Restaurante agregado correctamente');
				
				return Redirect::to('administrador/Restaurantes/Edit/'.$depto->nombre.'/'.$Rest->id);
			}
	}

	public function Edit($departamento, $id)
	{
		//Muestra la vista para editar la informacion de la foto seleccionada
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$DptosAll=DB::table('deptos')
			->get();

		$Rest=restaurantes::find($id);

		$Descripcion=DB::table('traduccionrestaurantes')
			->where('id_rest',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Restaurantes.edit', array('depto'=>$depto, 'Rest'=>$Rest, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll));
	}

	public function UpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen
		$General=restaurantes::find($id);
		$General->id_depto=Input::get('departamento');
		$General->municipio=Input::get('municipio');
		$General->nombre=Input::get('nombre');
		$General->telefono=Input::get('telefono');
		$General->direccion=Input::get('direccion');

		$traducciones=DB::table('traduccionrestaurantes')
			->where('id_rest',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$actualizar=traduccionrestaurantes::find($key->id);
				$actualizar->municipio=Input::get('municipio');
				$actualizar->id_depto=Input::get('departamento');
				$actualizar->telefono=Input::get('telefono');
				$actualizar->save();
			}
		}

		if($General->save()){
			Session::flash('message','Informacion general actualizada');
			return Redirect::back();
		}
	}

	public function Traduccion($idioma, $id)
	{
		//Añade una descripcion o traduccion
		$General=restaurantes::find($id);

		$Descripcion= new traduccionrestaurantes();
		$Descripcion->id_rest=$id;
		$Descripcion->id_idioma=$idioma;
		$Descripcion->id_depto=$General->id_depto;
		$Descripcion->municipio=$General->municipio;
		$Descripcion->nombre=Input::get('nombre');
		$Descripcion->telefono=$General->telefono;
		$Descripcion->direccion=Input::get('direccion');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Traduccion Agregada');
				return Redirect::back();
			}
	}

	public function Update($id)
	{
		//Actualiza la descripcion de una foto

		$TraducRest = traduccionrestaurantes::find($id);

		$TraducRest->nombre=Input::get('nombre');

		$TraducRest->direccion=Input::get('direccion');

		if($TraducRest->save()){	     			
				Session::flash('message', 'Traduccion Actualizada');
				return Redirect::back();
			}
	}

	public function RestDel($id)
	{
		//Elimina primero todas las descripciones y luego la foto
		$traducciones=DB::table('traduccionrestaurantes')
			->where('id_rest',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$traduccion=traduccionrestaurantes::find($key->id);
 
				$traduccion->delete();
			}
		}
		$Rest=restaurantes::find($id);
		$Rest->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}

	public function Buscar(){

		$resultado =Input::get('nombre');
		$deptonombre=Input::get('deptonombre');
		$editar= URL::to('/administrador/Hoteles/Edit');
		$eliminar= URL::to('/administrador/Hoteles/Del');
		$datos=DB::table('restaurantes')
				->where('nombre','like','%'.$resultado.'%')
				->where('id_depto',Input::get('depto'))
				->get();
	
		return Response::json( array(
			'resultado' => $resultado, 
			'sms' => "Resultados para", 
			'datos' => $datos,
			'urleditar'=> $editar,
			'urldel'=> $eliminar,
			'deptonombre'=>$deptonombre,
			));
	}


}
