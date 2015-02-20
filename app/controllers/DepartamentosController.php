<?php 
class DepartamentosController extends BaseController {

	public function view ($dpto){		

		$idioma=DB::table('idioma')->where('iniciales','es')->first();
		
		$departamento = DB::table('deptos')->where('nombre',$dpto)->first();
		//Obtengo el departamento con todos los idiomas disponibles
		

		$SliderDpto=DB::table('detalleslider')->where('id_dpto',$departamento->id)->get();
		
		/*$direccion=isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
				    ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
				    : $_SERVER['REMOTE_ADDR'];
		$localizacion = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$direccion));

		if(!isset($_COOKIE['PaginaVisitada'.$dpto])){

			$mensaje="Aun no has visitado la pagina";
			$pagina=DB::table('paginas')
				->where('tipo','index')
				->where('departamento',$dpto)
				->first();

			$visita=new contador();
			$visita->id_pag=$pagina->id;
			if(!empty($localizacion['geoplugin_countryName'])){
				$visita->pais=$localizacion['geoplugin_countryName'];
			}
			else{
				$visita->pais="IP Privada";
			}
			$visita->fecha=date('d/m/Y');
			$visita->save();
			$mensaje+=" ".$direccion.", Pais: ".$localizacion['geoplugin_countryName'].", Ciudad: ".$localizacion['geoplugin_countryName']." ".date('d/m/Y');

		}
		
		setcookie("PaginaVisitada".$dpto,1, time() + 120);
		*/
		return View::make('lenguajes.es.departamentos.departamento', array('SliderImg'=>$SliderDpto,'depto'=>$departamento));
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

    public function DeptoHoteles($departamento)
    {
    	$depto = DB::table('deptos')
			->where('nombre',$departamento)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$depto->id)
			->get();


		$Hoteles=DB::table('hoteles')
			->where('id_depto',$depto->id)
			->paginate(12);
		
       return View::make('lenguajes.es.departamentos.hoteles', array('Hoteles'=>$Hoteles,'depto'=>$depto, 'SliderDpto'=>$SliderDpto));
    }

     public function DeptoRest($departamento)
    {
    	$depto = DB::table('deptos')
			->where('nombre',$departamento)
			->first();
		//Obtengo el departamento con todos los idiomas disponibles

		$SliderDpto=DB::table('detalleslider')
			->where('id_dpto',$depto->id)
			->get();


		$Rest=DB::table('restaurantes')
			->where('id_depto',$depto->id)
			->paginate(12);
		
       return View::make('lenguajes.es.departamentos.restaurantes', array('Rest'=>$Rest,'depto'=>$depto, 'SliderDpto'=>$SliderDpto));
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
    public function BuscarHotel(){

		$resultado =Input::get('nombre');
		$deptonombre=Input::get('deptonombre');
		$datos=DB::table('hoteles')
				->where('nombre','like','%'.$resultado.'%')
				->where('id_depto',Input::get('depto'))
				->get();
	
		return Response::json( array(
			'resultado' => $resultado, 
			'sms' => "Resultados para", 
			'datos' => $datos,
			'deptonombre'=>$deptonombre,
			));
	}
	public function BuscarRestaurant(){

		$resultado =Input::get('nombre');
		$deptonombre=Input::get('deptonombre');
		$datos=DB::table('restaurantes')
				->where('nombre','like','%'.$resultado.'%')
				->where('id_depto',Input::get('depto'))
				->get();
	
		return Response::json( array(
			'resultado' => $resultado, 
			'sms' => "Resultados para", 
			'datos' => $datos,
			'deptonombre'=>$deptonombre,
			));
	}

}	
?>