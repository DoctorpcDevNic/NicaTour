<?php
 
class LocalesAdmin extends \BaseController {

	//Inicio funciones de locales
	public function ViewDepto($local)
	{
		//Muestra los departamentos que tienen alguna informacion del tipo seleccionada
		$depto=DB::table('deptos')
			->get();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$local)
			->first();

		$Info=DB::table('restauranteshoteles')
			->where('id_tipo',$tipo->id)
			->get();

		return View::make('Administrador.Locales.show', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local));
	}

	public function LocalesDpto($local,$departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$local)
			->first();

		$Info=DB::table('restauranteshoteles')
			->where('id_tipo',$tipo->id)
			->where('id_depto',$depto->id)
			->paginate(5);		

		return View::make('Administrador.Locales.departamento', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local));
	}

	public function LocalesEdit($local,$departamento,$id)
	{
		//Muestra la vista para editar la informacion de la foto seleccionada
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();

		$DptosAll=DB::table('deptos')
			->get();

		$Localidades=DB::table('tipoinfo')
			->get();

		$tipo=DB::table('tipoinfo')
			->where('tipo',$local)
			->first();

		$Info=restauranteshoteles::find($id);

		$Descripcion=DB::table('traduccionlocales')
			->where('id_local',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Locales.edit', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll, 'Localidades'=>$Localidades));
	}

	public function LocalesAdd()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('deptos')
			->get();

		return View::make('Administrador.Locales.add', array('depto'=>$depto));
	}

	public function LocalesNew()
	{		
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$Info = new restauranteshoteles();

			$Info->id_tipo = Input::get('tipo');

			$Info->id_depto = Input::get('departamento');

			$Info->nombre = Input::get('nombre');

			$Info->telefono = Input::get('telefono');

			$Info->direccion = Input::get('direccion');

			$depto=DB::table('deptos')			
				->where('id',$Info->id_depto)
				->first();

			$opcion=DB::table('tipoinfo')			
				->where('id',$Info->id_tipo)
				->first();

	     	if($Info->save()){	     			
				Session::flash('message', 'Local agregado correctamente');
				
				return Redirect::to('administrador/Locales/Edit/'.$opcion->tipo.'/'.$depto->nombre.'/'.$Info->id);
			}
	}

	public function LocalesDel($info)
	{
		//Elimina primero todas las descripciones y luego la foto
		$descripciones=DB::table('traduccionlocales')
			->where('id_local',$info)
			->get();

		if(!count($descripciones)==0){
			foreach ($descripciones as $key) {
				$traduccion=traduccionlocales::find($key->id);
 
				$traduccion->delete();
			}
		}
		$local=restauranteshoteles::find($info);
		$local->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}

	public function LocalesUpdate($id)
	{
		//Actualiza la descripcion de una foto

		$local = traduccionlocales::find($id);

		$local->nombre=Input::get('nombre');

		$local->direccion=Input::get('direccion');

		if($local->save()){	     			
				Session::flash('message', 'Descripcion Actualizada');
				return Redirect::back();
			}

	}

	public function LocalesUpdateGeneral($id)
	{
		//Actualiza la informacion general (departamento y tipo) de la imagen
		$General=restauranteshoteles::find($id);
		$General->id_tipo=Input::get('tipo');
		$General->id_depto=Input::get('departamento');
		$General->nombre=Input::get('nombre');
		$General->telefono=Input::get('telefono');
		$General->direccion=Input::get('direccion');

		$traducciones=DB::table('traduccionlocales')
			->where('id_local',$id)
			->get();

		if(!count($traducciones)==0){
			foreach ($traducciones as $key) {
				$actualizar=traduccionlocales::find($key->id);
				$actualizar->id_tipo=Input::get('tipo');
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

	public function LocalesTraduccion($idioma, $id)
	{
		//Añade una descripcion o traduccion
		$General=restauranteshoteles::find($id);

		$Descripcion= new traduccionlocales();
		$Descripcion->id_local=$id;
		$Descripcion->id_idioma=$idioma;
		$Descripcion->id_tipo=$General->id_tipo;
		$Descripcion->id_depto=$General->id_depto;
		$Descripcion->nombre=Input::get('nombre');
		$Descripcion->telefono=$General->telefono;
		$Descripcion->direccion=Input::get('direccion');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Traduccion Agregada');
				return Redirect::back();
			}
	}


}
