<?php

class CalendarioAdmin extends \BaseController {

	
public function ViewDepto()
	{
		//Muestra los departamentos que tienen alguna informacion del tipo seleccionada
		$depto=DB::table('deptos')
			->get();

		$Eventos=DB::table('calendario')
			->get();

		return View::make('Administrador.Calendario.show', array('depto'=>$depto, 'Eventos'=>$Eventos));
	}

	public function Depto($departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$Eventos=DB::table('calendario')
			->where('id_depto',$depto->id)
			->paginate(5);		

		return View::make('Administrador.Calendario.departamento', array('depto'=>$depto, 'Eventos'=>$Eventos));

	}

	public function Add()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('deptos')
			->get();

		return View::make('Administrador.Calendario.add', array('depto'=>$depto));
	}

	public function EventoNew()
	{
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$Evento = new calendario();

			$Evento->id_depto = Input::get('departamento');

			$Evento->municipio = Input::get('municipio');

			$fecha= new DateTime(Input::get('fecha'));

			$Evento->fecha = $fecha->format('Y-m-d');

			$Evento->nombre = Input::get('nombre');

			$Evento->direccion = Input::get('direccion');

			$depto=DB::table('deptos')			
				->where('id',$Evento->id_depto)
				->first();

	     	if($Evento->save()){	     			
				Session::flash('message', 'Evento agregado al calendario correctamente');
				
				return Redirect::to('administrador/Calendario/Edit/'.$depto->nombre.'/'.$Evento->id);
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

		$Eventos=calendario::find($id);

		$Descripcion=DB::table('traduccioneventos')
			->where('id_evento',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Calendario.edit', array('depto'=>$depto, 'Eventos'=>$Eventos, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll));
	}

	public function UpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen
		$General=calendario::find($id);
		$General->id_depto=Input::get('departamento');
		$General->municipio=Input::get('municipio');
		$General->fecha=Input::get('fecha');
		$General->nombre=Input::get('nombre');
		$General->direccion=Input::get('direccion');

		$traducciones=DB::table('traduccioneventos')
			->where('id_evento',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$actualizar=traduccioneventos::find($key->id);
				$actualizar->municipio=Input::get('municipio');
				$actualizar->id_depto=Input::get('departamento');
				$actualizar->fecha=Input::get('fecha');
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
		$General=calendario::find($id);

		$Descripcion= new traduccioneventos();
		$Descripcion->id_evento=$id;
		$Descripcion->id_idioma=$idioma;
		$Descripcion->id_depto=$General->id_depto;
		$Descripcion->municipio=$General->municipio;
		$Descripcion->fecha=$General->fecha;
		$Descripcion->nombre=Input::get('nombre');
		$Descripcion->direccion=Input::get('direccion');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Traduccion Agregada');
				return Redirect::back();
			}
	}

	public function Update($id)
	{
		//Actualiza la descripcion de una foto

		$TraducRest = traduccioneventos::find($id);

		$TraducRest->nombre=Input::get('nombre');

		$TraducRest->direccion=Input::get('direccion');

		if($TraducRest->save()){	     			
				Session::flash('message', 'Traduccion Actualizada');
				return Redirect::back();
			}
	}

	public function EventoDel($id)
	{
		//Elimina primero todas las descripciones y luego la foto
		$traducciones=DB::table('traduccioneventos')
			->where('id_evento',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$traduccion=traduccioneventos::find($key->id);
 
				$traduccion->delete();
			}
		}
		$Eventos=calendario::find($id);
		$Eventos->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}

}
