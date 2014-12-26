<?php 
class DepartamentosController extends BaseController {

	public function view ($dpto){		

		$idioma=DB::table('idioma')->where('iniciales','es')->first();
		
		$departamento = DB::table('dpto')->where('nombre',$dpto)->first();
		//Obtengo el departamento con todos los idiomas disponibles
		

		$SliderDpto=DB::table('detalleslider')->where('id_dpto',$departamento->id)->get();

		$clima=DB::table('infoclima')->where('id_dpto',$departamento->id)->first();
		
		return View::make('lenguajes.es.departamentos.departamento', array('SliderImg'=>$SliderDpto,'dpto'=>$dpto,'clima'=>$clima));
	}

	public function dptoinfo ($dpto, $opcion){

		$idioma=DB::table('idioma')
			->where('iniciales','es')
			->first();

		$departamento = DB::table('dpto')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$Tipo=DB::table('info')
			->where('tipo',$opcion)	
			->first();

		$DetalleInfo=DB::table('info_detalle')
			->where('id_dpto',$departamento->id)
			->where('id_info',$Tipo->id)
			->get();				

		$Descripcion=DB::table('descripcion_infodetalle')
				->where('id_idioma',$idioma->id)
				->get();

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$departamento->id)
			->get();
		//SlidetDpto contiene las imagenes del Slider principal de los departamentos
		               		
       return View::make('lenguajes.es.departamentos.info', array('SliderImg'=>$SliderDpto,'info_detalle'=>$DetalleInfo,'dpto'=>$departamento,'Descripcion'=>$Descripcion,'opcion'=>$opcion));
    }

    public function dptlocal ($dpto, $localdpto){

    	//Obtiene los Restauranntes, Hoteles, Tours Operadoras, Traslados, etc.

    	$idioma=DB::table('idioma')
    		->where('iniciales','es')
    		->first();
		
		$departamento = DB::table('dpto')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$Tipo=DB::table('info')
			->where('tipo',$localdpto)	
			->first();

		$DetalleInfo=DB::table('info_detalle')
			->where('id_dpto',$departamento->id)
			->where('id_info',$Tipo->id)
			->paginate(2);
		

		$Descripcion=DB::table('locales')
				->where('id_idioma',$idioma->id)
				->get();	             
		
       return View::make('lenguajes.es.departamentos.local', array('Descripcion'=>$Descripcion,'DetalleInfo'=>$DetalleInfo,'localdpto'=>$localdpto));
    }

}	
?>