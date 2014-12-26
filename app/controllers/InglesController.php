<?php 
class InglesController extends BaseController {

	public function view ($dpto){		

		$idioma=DB::table('idioma')->where('iniciales','en')->first();
		
		$departamento = DB::table('dpto')->where('nombre',$dpto)->first();
		//Obtengo el departamento con todos los idiomas disponibles
		

		$SliderDpto=DB::table('detalleslider')->where('id_dpto',$departamento->id)->get();

		$clima=DB::table('infoclima')->where('id_dpto',$departamento->id)->first();
		
		return View::make('lenguajes.en.view.departamento', array('SliderImg'=>$SliderDpto,'dpto'=>$dpto,'clima'=>$clima));
	}

	public function dptoinfo ($dpto, $opcion){

		switch ($opcion) {
			case 'Gastronomy':
				$opcion_tipo='Gastronomia';
				break;

			case 'Colonial Treasures':
				$opcion_tipo='Tesoros Coloniales';
				break;

			case 'Dances':
				$opcion_tipo='Danza';
				break;

			case 'Crafts':
				$opcion_tipo='Artesania';
				break;

			default:
				# code...
				break;
		}

		$idioma=DB::table('idioma')
			->where('iniciales','en')
			->first();

		$departamento = DB::table('dpto')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$Tipo=DB::table('info')
			->where('tipo',$opcion_tipo)	
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
		               		
       return View::make('lenguajes.en.view.info', array('SliderImg'=>$SliderDpto,'info_detalle'=>$DetalleInfo,'dpto'=>$dpto,'Descripcion'=>$Descripcion,'opcion'=>$opcion));
    }

    public function dptlocal ($dpto, $localdpto){

    	//Obtiene los Restauranntes, Hoteles, Tours Operadoras, Traslados, etc.
    	switch ($localdpto) {
			case 'Restaurants':
				$opcion_tipo='Restaurantes';
				break;

			case 'Hotels':
				$opcion_tipo='Hoteles';
				break;

			case 'Tourist Operators':
				$opcion_tipo='Tours Operadoras';
				break;

			case 'Transport':
				$opcion_tipo='Traslado';
				break;

			case 'Gas Stations':
				$opcion_tipo='Gasolineras';
				break;

			default:
				# code...
				break;
		}


    	$idioma=DB::table('idioma')
    		->where('iniciales','en')
    		->first();
		
		$departamento = DB::table('dpto')
			->where('nombre',$dpto)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$Tipo=DB::table('info')
			->where('tipo',$opcion_tipo)	
			->first();

		$DetalleInfo=DB::table('info_detalle')
			->where('id_dpto',$departamento->id)
			->where('id_info',$Tipo->id)
			->paginate(5);
		
		$Descripcion=DB::table('locales')
				->where('id_idioma',$idioma->id)
				->get();
		
       return View::make('lenguajes.en.view.local', array('Descripcion'=>$Descripcion,'DetalleInfo'=>$DetalleInfo,'localdpto'=>$localdpto));
    }

}	
?>