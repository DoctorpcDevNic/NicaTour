<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$depto=DB::table('dpto')->get();

		$Slider=DB::table('detalleslider')->get();

		$conteo=1;

		return View::make('SliderDpto.show', array('depto'=>$depto, 'Slider'=>$Slider));
	}

	public function Slider($departamento)
	{
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$Slider=DB::table('detalleslider')
			->where('id_dpto',$depto->id)
			->paginate(6);

		$conteo=1;

		return View::make('SliderDpto.edit', array('depto'=>$depto, 'Slider'=>$Slider));
	}

	public function SliderAdd()
	{
		$depto=DB::table('dpto')
			->get();

		return View::make('SliderDpto.add', array('depto'=>$depto));
	}

	public function SliderNew()
	{		
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

	public function SliderDel($departamento, $id)
	{
		$Slider=detalleslider::find($id);

		$Slider->delete();

		File::delete('img/'.$Slider->img);
		Session::flash('mensaje','Imagen eliminada');

		return Redirect::to('administrador/Slider/Show/'.$departamento.'');
	}
	

	public function Info($opcion)
	{
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->get();

		return View::make('Info.show', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion));
	}

	public function InfoDepartamento($opcion,$departamento)
	{
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->where('id_dpto',$depto->id)
			->get();

		$Descripcion=DB::table('descripcion_infodetalle')
			->get();		

		return View::make('Info.departamento', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion));
	}

	public function InfoEdit($opcion,$departamento,$id)
	{
		$depto=DB::table('dpto')
			->where('nombre',$departamento)
			->first();

		$tipo=DB::table('info')
			->where('tipo',$opcion)
			->first();

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

		return View::make('Info.edit', array('depto'=>$depto, 'Info'=>$Info, 'opcion'=>$opcion, 'Descripcion'=>$Descripcion, 'idioma'=>$idioma, 'id_info'=>$id));
	}

	public function InfoAdd()
	{
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->get();

		return View::make('Info.add', array('depto'=>$depto, 'tipo'=>$tipo));
	}

	public function InfoNew()
	{		
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

	public function InfoDel($opcion, $departamento, $info){
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

	public function InfoUpdate($opcion, $departamento, $id){

		$Descripcion = descripcion::find($id);

		$Descripcion->titulo=Input::get('titulo');

		$Descripcion->texto=Input::get('texto');

		if($Descripcion->save()){	     			
				Session::flash('message', 'Descripcion Actualizada');
				return Redirect::back();
			}

	}

	public function InfoTraduccion($idioma, $id){
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

	public function Locales($local)
	{
		$depto=DB::table('dpto')
			->get();

		$tipo=DB::table('info')
			->where('tipo',$local)
			->first();

		$Info=DB::table('info_detalle')
			->where('id_info',$tipo->id)
			->get();

		$conteo=1;

		return View::make('Locales.show', array('depto'=>$depto, 'Info'=>$Info, 'local'=>$local));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
