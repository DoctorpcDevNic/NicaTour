<?php

class AdminController extends \BaseController {

	//Inicio Funciones Slider Principal
	public function SliderDpto()	
	{
		//Muestra todos los departamentos que tienen imagen en el Slider departamental
		$depto=DB::table('dpto')->get();

		$Slider=DB::table('detalleslider')->get();

		$conteo=1;

		return View::make('Administrador.SliderDpto.show', array('depto'=>$depto, 'Slider'=>$Slider));
	}

	public function SliderDptoShow($departamento)
	{
		//Muestra todas las imagenes del departamento seleccionado
		$depto=DB::table('dpto')
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
		$depto=DB::table('dpto')
			->get();

		return View::make('Administrador.SliderDpto.add', array('depto'=>$depto));
	}

	public function SliderDptoNew()
	{		
		//Añadde  una imagen al Slider principal departamental
			$file="no_img.png";

			$Slider = new detalleslider();

			$Slider->id_dpto = Input::get('departamento');

			$depto=DB::table('dpto')			
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
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->get();

		return View::make('Administrador.Info.show', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion));
	}

	public function InfoDepartamento($opcion,$departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->where('id_dpto',$depto->id)
			->paginate(5);

		$Descripcion=DB::table('descripcion_infodetalle')
			->get();		

		return View::make('Administrador.Info.departamento', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion));
	}

	public function InfoEdit($opcion,$departamento,$id)
	{
		//Muestra la vista para editar la informacion de la foto seleccionada
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

		$DptosAll=DB::table('dpto')
			->get();

		$TipoCultura=DB::table('info')
			->get();

		$Info=DB::table('info_detalle')
			->where('id',$id)
			->where('id_info',$tipo->id)
			->where('id_dpto',$depto->id)
			->first();

		$Descripcion=DB::table('descripcion_infodetalle')
			->where('id_infodetalle',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Info.edit', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll, 'TipoCultura'=>$TipoCultura));
	}

	public function InfoAdd()
	{
		//Muestra la vista para agregar una imagen
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->get();

		return View::make('Administrador.Info.add', array('depto'=>$depto, 'tipo'=>$tipo));
	}

	public function InfoNew()
	{		
		//Agrega una imagen de una opcion y departamento y luego redirije para editar su descripcion
			$file="no_img.png";

			$Info = new info();

			$Info->id_info = Input::get('tipo');

			$Info->id_dpto = Input::get('departamento');

			$depto=DB::table('dpto')			
				->where('id',$Info->id_dpto)
				->first();

			$opcion=DB::table('info')			
				->where('id',$Info->id_info)
				->first();

			if(Input::hasFile('archivo')) {
		       	Input::file('archivo')->move('img/'.$depto->nombre.'', Input::file("archivo")->getClientOriginalName());
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
		$descripciones=DB::table('descripcion_infodetalle')
			->where('id_infodetalle',$info)
			->get();

		if(!count($descripciones)==0){
			foreach ($descripciones as $key) {
				$traduccion=descripcion::find($key->id);
 
				$traduccion->delete();
			}
		}
		$foto=info::find($info);
		File::delete('img/'.$foto->img);
		$foto->delete();
		Session::flash('message', 'Informacion Eliminada');
		return Redirect::back();
	}

	public function InfoUpdate($opcion, $departamento, $id)
	{
		//Actualiza la descripcion de una foto

		$Descripcion = descripcion::find($id);

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
		$General=info::find($id);
		$General->id_info=Input::get('tipo');
		$General->id_dpto=Input::get('departamento');
		$info=DB::table('info')
			->where('id',$General->id_info)
			->first();

		$depto=DB::table('dpto')
			->where('id',$General->id_dpto)
			->first();

		if($General->save()){
			Session::flash('message','Informacion general actualizada');
			return Redirect::to('administrador/Info/Edit/'.$info->tipo.'/'.$depto->nombre.'/'.$id);
		}
	}

	public function InfoTraduccion($idioma, $id)
	{
		//Añade una descripcion o traduccion
		$Descripcion= new descripcion();
		$Descripcion->id_infodetalle=$id;
		$Descripcion->id_idioma=$idioma;
		$Descripcion->titulo=Input::get('titulo');
		$Descripcion->texto=Input::get('texto');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Traduccion Agregada');
				return Redirect::back();
			}
	}
	//Fin funciones de gastronomia, artesanias, etc


	//Inicio funciones de locales
	public function Locales($local)
	{
		//Muestra los departamentos que tienen alguna informacion del tipo seleccionada
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->where('tipo',$local)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->get();

		return View::make('Administrador.Locales.show', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local));
	}

	public function LocalesDpto($local,$departamento)
	{
		//Muestra toda la informacion seleccionada del departamento seleeccionado
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('info')
			->where('tipo',$local)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->where('id_dpto',$depto->id)
			->paginate(5);

		$Descripcion=DB::table('locales')
			->get();		

		return View::make('Administrador.Locales.departamento', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local, 'Descripcion'=>$Descripcion));
	}

	public function LocalesEdit($local,$departamento,$id)
	{
		//Muestra la vista para editar la informacion de la foto seleccionada
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$DptosAll=DB::table('dpto')
			->get();

		$Localidades=DB::table('info')
			->get();

		$tipo=DB::table('info')
			->where('tipo',$local)
			->first();

		$Info=DB::table('info_detalle')
			->where('id',$id)
			->where('id_info',$tipo->id)
			->where('id_dpto',$depto->id)
			->first();

		$Descripcion=DB::table('locales')
			->where('id_infodetalle',$id)
			->get();

		$idioma=DB::table('idioma')
			->get();

		return View::make('Administrador.Locales.edit', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id, 'DptosAll'=>$DptosAll, 'Localidades'=>$Localidades));
	}
	


}
