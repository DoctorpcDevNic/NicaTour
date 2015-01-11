<?php 
class DepartamentosController extends BaseController {

	public function view ($dpto){		

		$idioma=DB::table('idioma')->where('iniciales','es')->first();
		
		$departamento = DB::table('deptos')->where('nombre',$dpto)->first();
		//Obtengo el departamento con todos los idiomas disponibles
		

		$SliderDpto=DB::table('detalleslider')->where('id_dpto',$departamento->id)->get();

		$clima=Clima::find($departamento->id);
		
		return View::make('lenguajes.es.departamentos.departamento', array('SliderImg'=>$SliderDpto,'depto'=>$departamento,'clima'=>$clima));
	}

	public function dptoinfo ($dpto, $opcion){

		$idioma=DB::table('idioma')
			->where('iniciales','es')
			->first();

		$departamento = DB::table('deptos')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$Tipo=DB::table('tipoinfo')
			->where('tipo',$opcion)	
			->first();

		$DetalleInfo=DB::table('fotocultura')
			->where('id_depto',$departamento->id)
			->where('id_tipo',$Tipo->id)
			->get();				

		$Descripcion=DB::table('descripcioncultura')
				->where('id_idioma',$idioma->id)
				->where('id_depto',$departamento->id)
				->get();

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$departamento->id)
			->get();
		//SlidetDpto contiene las imagenes del Slider principal de los departamentos
		               		
       return View::make('lenguajes.es.departamentos.info', array('SliderImg'=>$SliderDpto,'info_detalle'=>$DetalleInfo,'dpto'=>$departamento,'Descripcion'=>$Descripcion,'opcion'=>$opcion));
    }

    public function dptlocal ($dpto, $localdpto){
		
		$departamento = DB::table('deptos')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$departamento->id)
			->get();

		$Tipo=DB::table('tipoinfo')
			->where('tipo',$localdpto)	
			->first();

		$DetalleInfo=DB::table('restauranteshoteles')
			->where('id_depto',$departamento->id)
			->where('id_tipo',$Tipo->id)
			->paginate(12);
		
       return View::make('lenguajes.es.departamentos.local', array('DetalleInfo'=>$DetalleInfo,'localdpto'=>$localdpto, 'dpto'=>$dpto, 'SliderDpto'=>$SliderDpto));
    }

    public function Gasview($depto){

    	$departamento = DB::table('deptos')
    		->where('nombre',$depto)
    		->first();

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$departamento->id)
			->get();

		$Gasolineras=DB::table('gasolineras')
			->where('id_depto',$departamento->id)
			->get();

		return View::make('lenguajes.es.departamentos.gasolineras', array('departamento'=>$departamento, 'SliderDpto'=>$SliderDpto, 'Gasolineras'=>$Gasolineras));

    }

}	
?>