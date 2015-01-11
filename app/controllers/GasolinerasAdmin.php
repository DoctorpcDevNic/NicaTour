<?php

class GasolinerasAdmin extends \BaseController {

	public function GasView(){
		$departamentos=DB::table('deptos')
			->paginate(4);
		$Gasolineras=gasolineras::all();

		return View::make('Administrador.Gasolineras.show', array('departamentos'=>$departamentos, 'Gasolineras'=>$Gasolineras));
	}

	public function GasAdd(){
		$deptos=DB::table('deptos')
			->get();

		return View::make('Administrador.Gasolineras.add', array('deptos'=>$deptos));
	}

	public function GasNew(){
		$depto=DB::table('deptos')
			->where('id',Input::get('departamento'))
			->first();
		$Gasolinera = new gasolineras();
		$Gasolinera->id_depto=Input::get('departamento');
		$Gasolinera->nombre=Input::get('nombre');
		$Gasolinera->latitud=Input::get('latitud');
		$Gasolinera->longitud=Input::get('longitud');
		if($Gasolinera->save()){			
			return Redirect::to('administrador/Gasolineras/Edit/'.$depto->nombre);
		}
	}

	public function GasEdit($departamento){
		$depto=DB::table('deptos')
			->where('nombre',$departamento)
			->first();
		$Gasolineras=DB::table('gasolineras')
			->where('id_depto',$depto->id)
			->paginate(5);

		return View::make('Administrador.Gasolineras.departamento', array('Gasolineras'=>$Gasolineras, 'depto'=>$depto));
	}


}
