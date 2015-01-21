<?php

class HotelesAdmin extends \BaseController {

public function ViewDepto()
	{
		//Muestra los departamentos que tienen alguna informacion del tipo seleccionada
		$depto=DB::table('deptos')
			->get();

		$Hotels=DB::table('hoteles')
			->get();

		return View::make('Administrador.Hoteles.show', array('depto'=>$depto, 'Hotels'=>$Hotels));
	}

	public function Depto($departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$Hotels=DB::table('hoteles')
			->where('id_depto',$depto->id)
			->paginate(5);		

		return View::make('Administrador.Hoteles.departamento', array('depto'=>$depto, 'Hotels'=>$Hotels));

	}

	public function Add()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('deptos')
			->get();

		return View::make('Administrador.Hoteles.add', array('depto'=>$depto));
	}

	public function HotelsNew()
	{
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$Hotels = new hoteles();

			$Hotels->id_depto = Input::get('departamento');

			$Hotels->municipio = Input::get('municipio');

			$Hotels->nombre = Input::get('nombre');

			$Hotels->telefono = Input::get('telefono');

			$Hotels->direccion = Input::get('direccion');

			$depto=DB::table('deptos')			
				->where('id',$Hotels->id_depto)
				->first();

	     	if($Hotels->save()){	     			
				Session::flash('message', 'Restaurante agregado correctamente');
				
				return Redirect::to('administrador/Hoteles/Edit/'.$depto->nombre.'/'.$Hotels->id);
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

		$Hotels=hoteles::find($id);

		$Descripcion=DB::table('traduccionhoteles')
			->where('id_hotel',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Hoteles.edit', array('depto'=>$depto, 'Hotels'=>$Hotels, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll));
	}

	public function UpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen
		$General=hoteles::find($id);
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
		$General=hoteles::find($id);

		$Descripcion= new traduccionhoteles();
		$Descripcion->id_hotel=$id;
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

		$TraducRest = traduccionhoteles::find($id);

		$TraducRest->nombre=Input::get('nombre');

		$TraducRest->direccion=Input::get('direccion');

		if($TraducRest->save()){	     			
				Session::flash('message', 'Traduccion Actualizada');
				return Redirect::back();
			}
	}

	public function HotelDel($id)
	{
		//Elimina primero todas las descripciones y luego la foto
		$traducciones=DB::table('traduccionhoteles')
			->where('id_hotel',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$traduccion=traduccionhoteles::find($key->id);
 
				$traduccion->delete();
			}
		}
		$Hotels=hoteles::find($id);
		$Hotels->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}


}
