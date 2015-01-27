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
		$reglas= array(
				'municipio'=> 'required',
				'fecha' => 'required|date',
				'nombre' => 'required|min:5',
				'direccion' => 'required|min:15|max:255'
			);
		$alertas = array(
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        );

		$validador = Validator::make(Input::all(), $reglas, $alertas);

		if($validador->fails()){

			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{

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
		$reglas= array(
				'municipio'=> 'required',
				'fecha' => 'required|date',
				'nombre' => 'required|min:5',
				'direccion' => 'required|min:15|max:255'
			);
		$alertas = array(
            'required' => 'El campo :attribute no puede estar vacio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
            'max' => 'El campo :attribute no puede tener más de :max carácteres.',
        );

        $validador = Validator::make(Input::all(), $reglas, $alertas);

        if($validador->fails()){

			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{

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
		
	}

	public function Traduccion($idioma, $id)
	{
		$lang=DB::table('idioma')->where('id',$idioma)->first();

		$reglas= array(				
				'nombre'.$idioma => 'required|min:5',
				'direccion'.$idioma => 'required|min:15|max:255'
			);
		$alertas = array(
            'nombre'.$idioma.'.required' => 'La traduccion en '. $lang->nombre.' del nombre del evento, no puede estar vacio.',
            'direccion'.$idioma.'.required' => 'La traduccion en '. $lang->nombre.' de la direccion del evento, no puede estar vacio.',
            'nombre'.$idioma.'.min' => 'El nombre del evento debe tener al menos :min carácteres',
            'direccion'.$idioma.'.max' => 'La direccion del evento no debe tener más de :max carácteres.',
            'direccion'.$idioma.'.min' => 'La direccion del evento debe tener más de :min carácteres.',
        );

        $validador = Validator::make(Input::all(), $reglas, $alertas);

        if($validador->fails()){
        	Session::flash('newtrad', 'No se ha podido agregar la traduccion en '.$lang->nombre.' , confirmar los datos');
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}

		else{
			//Añade una descripcion o traduccion
			$General=calendario::find($id);

			$Descripcion= new traduccioneventos();
			$Descripcion->id_evento=$id;
			$Descripcion->id_idioma=$idioma;
			$Descripcion->id_depto=$General->id_depto;
			$Descripcion->municipio=$General->municipio;
			$Descripcion->fecha=$General->fecha;
			$Descripcion->nombre=Input::get('nombre'.$idioma);
			$Descripcion->direccion=Input::get('direccion'.$idioma);

			if($Descripcion->save()){	     			
					Session::flash('message', 'Traduccion en '.$lang->nombre.' agregada correctamente');
					return Redirect::back();
				}
		}
	}

	public function Update($id)
	{
		$TraducRest = traduccioneventos::find($id);

		$lang=DB::table('idioma')->where('id',$TraducRest->id_idioma)->first();

		$reglas= array(				
				'nombre'.$id => 'required|min:5',
				'direccion'.$id => 'required|min:15|max:255'
			);
		$alertas = array(
            'nombre'.$id.'.required' => 'La traduccion en '. $lang->nombre.' del nombre del evento, no puede estar vacio.',
            'direccion'.$id.'.required' => 'La traduccion en '. $lang->nombre.' de la direccion del evento, no puede estar vacio.',
            'nombre'.$id.'.min' => 'El nombre del evento debe tener al menos :min carácteres',
            'direccion'.$id.'.max' => 'La direccion del evento no debe tener más de :max carácteres.',
            'direccion'.$id.'.min' => 'La direccion del evento debe tener más de :min carácteres.',
        );

        $validador = Validator::make(Input::all(), $reglas, $alertas);

        if($validador->fails()){
        	Session::flash('updatetrad', 'No se puede actualizar la traduccion en '.$lang->nombre.' , confirmar los datos');
			return Redirect::back()
							->withErrors($validador)
			                ->withInput();
		}
		//Actualiza la descripcion
		else{

			$TraducRest->nombre=Input::get('nombre'.$id);

			$TraducRest->direccion=Input::get('direccion'.$id);

			if($TraducRest->save()){	     			
					Session::flash('message', 'Traduccion en '.$lang->nombre.' actualizada correctamente');
					return Redirect::back();
				}
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
